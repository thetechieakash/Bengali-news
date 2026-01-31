<script>
    $(function() {
        // CKEDITOR config
        CKEDITOR.replace('editor', {
            height: '400px',
        });

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
        $('#tags').tagsInput({
            width: '100%',
            height: '75%',
            defaultText: 'Add tag',
            removeWithBackspace: true,
            maxChars: 20
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
         * Quill editor
         * -------------------------------------------------- */
        // const quill = new Quill('#description', {
        //     theme: 'snow',
        //     modules: {
        //         toolbar: [
        //             [{
        //                 header: [1, 2, 3, 4, 5, 6, false]
        //             }],
        //             [{
        //                 font: []
        //             }],
        //             ['bold', 'italic', 'underline', 'strike'],
        //             ['blockquote', 'code-block'],
        //             [{
        //                 list: 'ordered'
        //             }, {
        //                 list: 'bullet'
        //             }],
        //             [{
        //                 script: 'sub'
        //             }, {
        //                 script: 'super'
        //             }],
        //             [{
        //                 indent: '-1'
        //             }, {
        //                 indent: '+1'
        //             }],
        //             [{
        //                 direction: 'rtl'
        //             }],
        //             [{
        //                 size: ['small', false, 'large', 'huge']
        //             }],
        //             [{
        //                 color: []
        //             }, {
        //                 background: []
        //             }],
        //             [{
        //                 align: []
        //             }],
        //             ['clean']
        //         ]
        //     }
        // });

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

            $('#tags').importTags('');

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
                error() {
                    showDangerToast('Something went wrong');
                    submitBtn.prop('disabled', false);
                }
            });
        });



    });
</script>