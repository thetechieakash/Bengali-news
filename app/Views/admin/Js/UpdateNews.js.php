<script>
    const selectedSubCatIds = <?= json_encode($post['subcategory_ids'] ?? []) ?>;
    const preloadedSubCats = <?= json_encode($post['subcategories'] ?? []) ?>;
    $(function() {
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
        const quill = new Quill('#description', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, 3, 4, 5, 6, false]
                    }],
                    [{
                        font: []
                    }],
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{
                        list: 'ordered'
                    }, {
                        list: 'bullet'
                    }],
                    [{
                        script: 'sub'
                    }, {
                        script: 'super'
                    }],
                    [{
                        indent: '-1'
                    }, {
                        indent: '+1'
                    }],
                    [{
                        direction: 'rtl'
                    }],
                    [{
                        size: ['small', false, 'large', 'huge']
                    }],
                    [{
                        color: []
                    }, {
                        background: []
                    }],
                    [{
                        align: []
                    }],
                    ['clean']
                ]
            }
        });

        const existingContent = document.getElementById('description_input').value;
        if (update) {
            quill.root.innerHTML = existingContent;
        }

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


        $(document).on('click', '#update', function(e) {
            e.preventDefault();

            const form = document.getElementById('newsForm');
            const updateBtn = $('#update');

            updateBtn.prop('disabled', true);

            if (!$('#headline').val().trim()) {
                showDangerToast('Headline is required');
                updateBtn.prop('disabled', false);
                return;
            }

            if (!$('#categories').val()?.length) {
                showDangerToast('Please select at least one category');
                updateBtn.prop('disabled', false);
                return;
            }

            if (!quill.getText().trim()) {
                showDangerToast('Description is required');
                updateBtn.prop('disabled', false);
                return;
            }

            $('#description_input').val(quill.root.innerHTML);

            const POST_ID = <?= json_encode($post['id'] ?? null) ?>;

            $.ajax({
                url: `<?= base_url('admin/news/update') ?>/${POST_ID}`,
                type: "POST",
                data: new FormData(form),
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                success: function(res) {
                    if (res.success) {
                        showSuccessToast(res.message);
                        setTimeout(() => {
                            window.location.href = res.redirect;
                        }, 1000);

                    } else {
                        if (typeof res.errors == "object") {
                            Object.values(res.errors).forEach(key => {
                                showDangerToast(key)
                            })
                        } else {
                            showDangerToast(res.message);
                        }
                    }
                    updateBtn.prop('disabled', false);
                    console.log(res);
                },
                error: function(err) {
                    showDangerToast('Something went wrong');
                    console.log('Create news fetch error', err);

                    updateBtn.prop('disabled', false);
                }
            });
        });
    });
</script>