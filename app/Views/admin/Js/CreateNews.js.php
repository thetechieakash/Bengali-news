<script>
    $(function() {
        // CKEDITOR config
        CKEDITOR.replace('editor', {
            height: '400px',
        });

        // Loader 
        const loader = $('#panding-loader');

        // GLightbox init 
        const lightbox = GLightbox();

        /* ----------------------------------------------------
         * Thumbnail toggle
         * -------------------------------------------------- */
        function toggleThumbnailInput(type) {
            if (type === 'link') {
                $('#thumbnail-link-wrapper').show();
                $('#thumbnail-upload-wrapper').hide();
            } else {
                $('#thumbnail-link-wrapper').hide();
                $('#thumbnail-upload-wrapper').show();
            }
        }

        toggleThumbnailInput($('input[name="thumbnail_type"]:checked').val());

        $('.thumb-type').on('change', function() {
            toggleThumbnailInput(this.value);
        });

        /* ----------------------------------------------------
         * Tags input
         * -------------------------------------------------- */
        // $('#tags').tagsInput({
        //     width: '100%',
        //     height: '75%',
        //     defaultText: 'Add tag',
        //     removeWithBackspace: true,
        //     maxChars: 20
        // });


        $('#tags').select2({
            theme: 'bootstrap',
            placeholder: 'Type to add tags',
            minimumInputLength: 2,
            tags: true, // allow creation
            selectOnClose: true, // KEY FIX
            closeOnSelect: true,
            ajax: {
                url: "<?= base_url('admin/tags/search') ?>",
                dataType: 'json',
                delay: 250,
                data(params) {
                    return {
                        q: params.term
                    };
                },
                processResults(data) {
                    return {
                        results: data.map(tag => ({
                            id: tag.id,
                            text: tag.name
                        }))
                    };
                }
            },
            createTag(params) {
                const term = params.term.trim().toLowerCase();
                if (!term) return null;

                const exists = $('#tags option').filter(function() {
                    return $(this).text().toLowerCase() === term;
                }).length;

                if (exists) return null;

                return {
                    id: term,
                    text: term,
                    newTag: true
                };
            }
        });


        /* ----------------------------------------------------
         * Flatpickr
         * -------------------------------------------------- */
        const fp = flatpickr('.datetimepicker', {
            mode: "single",
            dateFormat: "d/m/Y H:i",
            enableTime: true,
            disableMobile: true,
            defaultDate: null,
            minDate: "today",
            maxDate: new Date().fp_incr(30),
            monthSelectorType: "static",
            yearSelectorType: "static",
            allowInput: false
        });

        /* ----------------------------------------------------
         * Select2
         * -------------------------------------------------- */
        $('#categories').select2({
            theme: 'bootstrap',
            placeholder: 'Select categories',
        });

        $('#subcategories').select2({
            theme: 'bootstrap',
            placeholder: 'Select sub categories'
        });

        /* ----------------------------------------------------
         * Sub-category loader with cache
         * -------------------------------------------------- */
        const subCategoryCache = {};

        function resetSubCategories() {
            $('#subcategories')
                .empty()
                .prop('disabled', true)
                .trigger('change');
        }

        $('#categories').on('change', function() {

            const selectedCats = $(this).val() || [];

            if (!selectedCats.length) {
                resetSubCategories();
                return;
            }

            $('#subcategories')
                .html('<option>Loading...</option>')
                .prop('disabled', true)
                .trigger('change');

            let subCats = [];

            selectedCats.forEach(id => {
                if (subCategoryCache[id]) {
                    subCats = subCats.concat(subCategoryCache[id]);
                }
            });

            const missing = selectedCats.filter(id => !subCategoryCache[id]);

            if (!missing.length) {
                renderSubCategories(subCats);
                return;
            }

            $.post("<?= base_url('admin/sub-categories/by-categories') ?>", {
                category_ids: missing
            }).done(function(res) {
                res.forEach(sub => {
                    subCategoryCache[sub.cat_id] ??= [];
                    subCategoryCache[sub.cat_id].push(sub);
                });

                selectedCats.forEach(id => {
                    if (subCategoryCache[id]) {
                        subCats = subCats.concat(subCategoryCache[id]);
                    }
                });

                renderSubCategories(subCats);
            }).fail(function() {
                showDangerToast('Failed to load sub categories');
                resetSubCategories();
            });
        });

        function renderSubCategories(subCats) {
            const subSelect = $('#subcategories');
            subSelect.empty();

            const unique = Object.values(
                subCats.reduce((acc, cur) => {
                    acc[cur.id] = cur;
                    return acc;
                }, {})
            );

            unique.forEach(sub => {
                subSelect.append(new Option(sub.sub_cat_name, sub.id));
            });

            subSelect.prop('disabled', false).trigger('change');
        }


        /* ----------------------------------------------------
         * Dropify
         * -------------------------------------------------- */
        const dropifyInstance = $('#thumbnail_image').dropify().data('dropify');

        /* ----------------------------------------------------
         * Reset form
         * -------------------------------------------------- */
        function resetNewsForm() {

            document.getElementById('newsForm').reset();

            CKEDITOR.instances.editor.setData('');

            $('#tags').val(null).trigger('change');

            $('#categories').val(null).trigger('change');
            resetSubCategories();

            Object.keys(subCategoryCache).forEach(k => delete subCategoryCache[k]);

            fp.clear();

            if (dropifyInstance) {
                dropifyInstance.resetPreview();
                dropifyInstance.clearElement();
            }

            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        /* ----------------------------------------------------
         * Submit handler
         * -------------------------------------------------- */

        const newsForm = $('#newsForm');

        newsForm.on('submit', function(e) {
            e.preventDefault();

            const submitBtn = $(this).find('button[type="submit"]');
            submitBtn.prop('disabled', true);

            if (!$('#headline').val().trim()) {
                showDangerToast('Headline is required');
                submitBtn.prop('disabled', false);
                return;
            }

            if (!$('#categories').val()?.length) {
                showDangerToast('Please select at least one category');
                submitBtn.prop('disabled', false);
                return;
            }

            const editorData = CKEDITOR.instances.editor.getData();
            if (!editorData.replace(/<[^>]*>/g, '').trim()) {
                showDangerToast('Description is required');
                submitBtn.prop('disabled', false);
                return;
            }

            // Sync CKEditor → textarea
            for (let i in CKEDITOR.instances) {
                CKEDITOR.instances[i].updateElement();
            }
            loader.fadeIn(150);

            $.ajax({
                url: "<?= base_url('admin/news/create') ?>",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success(res) {
                    if (res.success) {
                        showSuccessToast(res.message);
                        setTimeout(() => window.location.href = res.redirect, 1000);
                    } else {
                        showDangerToast(res.message);
                    }
                    submitBtn.prop('disabled', false);
                },
                error(err) {
                    showDangerToast('Something went wrong');
                    console.error('Post Create server error', err);
                    submitBtn.prop('disabled', false);
                },
                complete() {
                    loader.fadeOut(150);
                    btn.prop('disabled', false);
                }
            });
        });
    });
</script>