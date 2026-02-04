<script>
    const selectedSubCatIds = <?= json_encode($post['subcategory_ids'] ?? []) ?>;
    const preloadedSubCats = <?= json_encode($post['subcategories'] ?? []) ?>;
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
         * Tags select2
         * -------------------------------------------------- */
        ;
        $('#tags').select2({
            theme: 'bootstrap',
            placeholder: 'Type to add tags',
            multiple: true,
            tags: true,
            minimumInputLength: 1,
            width: '100%',

            ajax: {
                url: "<?= base_url('admin/tags/search') ?>",
                dataType: 'json',
                delay: 300,
                data(params) {
                    return {
                        q: params.term
                    };
                },
                processResults(data) {
                    return {
                        results: data.map(tag => ({
                            id: tag.name,
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

        // preload existing subcategories into cache
        if (preloadedSubCats.length) {
            preloadedSubCats.forEach(sub => {
                subCategoryCache[sub.cat_id] ??= [];
                subCategoryCache[sub.cat_id].push(sub);
            });

            // enable & preselect
            $('#subcategories')
                .prop('disabled', false)
                .val(selectedSubCatIds)
                .trigger('change');
        }

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
                subSelect.append(
                    new Option(sub.sub_cat_name, sub.id, false,
                        selectedSubCatIds.includes(String(sub.id)) ||
                        selectedSubCatIds.includes(sub.id)
                    )
                );
            });


            subSelect.prop('disabled', false).trigger('change');
        }


        /* ----------------------------------------------------
         * Dropify
         * -------------------------------------------------- */
        const dropifyInstance = $('#thumbnail_image').dropify().data('dropify');
        $('#thumbnail_image').on('dropify.afterClear', function() {
            document.getElementById('thumbnail_removed').value = '1';
        });


        // $(document).on('click', '#update', function(e) {
        //     e.preventDefault();
        //     const btn = $(this).prop('disabled', true);

        //     const editorData = CKEDITOR.instances.editor.getData();
        //     if (!editorData.replace(/<[^>]*>/g, '').trim()) {
        //         showDangerToast('Description is required');
        //         btn.prop('disabled', false);
        //         return;
        //     }

        //     // Sync CKEditor → textarea
        //     for (let i in CKEDITOR.instances) {
        //         CKEDITOR.instances[i].updateElement();
        //     }
        //     loader.fadeIn(150);
        //     $.ajax({
        //         url: "<?= base_url('admin/news/update/' . ($post['id'] ?? '')) ?>",
        //         type: "POST",
        //         data: new FormData(document.getElementById('newsForm')),
        //         processData: false,
        //         contentType: false,
        //         success(res) {
        //             if (res.success) {
        //                 showSuccessToast(res.message);
        //                 setTimeout(() => location.href = res.redirect, 1000);
        //             } else {
        //                 showDangerToast(res.message);
        //             }
        //             btn.prop('disabled', false);
        //         },
        //         error(err) {
        //             showDangerToast('Server error. Please try again.');
        //             console.error('Post Delete server error', err);
        //         },

        //         complete() {
        //             loader.fadeOut(150);
        //             btn.prop('disabled', false);
        //         }
        //     });
        // });

        function submitPost(status) {
            $('#post_status').val(status);

            const btn = status === 1 ? $('#publish') : $('#update');
            btn.prop('disabled', true);

            const editorData = CKEDITOR.instances.editor.getData();
            if (!editorData.replace(/<[^>]*>/g, '').trim()) {
                showDangerToast('Description is required');
                btn.prop('disabled', false);
                return;
            }

            for (let i in CKEDITOR.instances) {
                CKEDITOR.instances[i].updateElement();
            }

            loader.fadeIn(150);

            $.ajax({
                url: "<?= base_url('admin/news/update/' . $post['id']) ?>",
                type: "POST",
                data: new FormData(document.getElementById('newsForm')),
                processData: false,
                contentType: false,
                success(res) {
                    if (res.success) {
                        showSuccessToast(res.message);
                        setTimeout(() => location.href = res.redirect, 1000);
                    } else {
                        showDangerToast(res.message);
                    }
                },
                error() {
                    showDangerToast('Server error');
                },
                complete() {
                    loader.fadeOut(150);
                    btn.prop('disabled', false);
                }
            });
        }

        $(document).on('click', '#update', function(e) {
            e.preventDefault();
            submitPost(0); // SAVE ONLY
        });

        $(document).on('click', '#publish', function(e) {
            e.preventDefault();
            submitPost(1); // SAVE + PUBLISH
        });

    });
</script>