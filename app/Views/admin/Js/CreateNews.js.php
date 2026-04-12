<script>
    $(function() {

        const GLightboxInstance = GLightbox();

        /* ----------------------------------------------------
         * Tom Select — shared config factory
         * -------------------------------------------------- */
        function makeTomConfig(overrides = {}) {
            return Object.assign({
                plugins: ['remove_button'],
                closeAfterSelect: false,
                hideSelected: true,
                allowEmptyClearAll: true,
            }, overrides);
        }

        /* ----------------------------------------------------
         * Sub Author
         * -------------------------------------------------- */
        new TomSelect('#subauthor', makeTomConfig({
            closeAfterSelect: true,
            maxItems: 1,
            placeholder: 'Select Guest Author',
            render: {
                option: function(data) {
                    const img = data.image || 'https://placehold.co/50x50';
                    return `<div style="display:flex;align-items:center;">
                    <img src="${img}" style="width:35px;height:35px;border-radius:50%;margin-right:10px;object-fit:cover;">
                    <span>${data.text}</span>
                </div>`;
                },
                item: function(data) {
                    const img = data.image || 'https://placehold.co/50x50';
                    return `<div style="display:flex;align-items:center;gap:6px;">
                    <img src="${img}" style="width:22px;height:22px;border-radius:50%;object-fit:cover;">
                    <span>${data.text}</span>
                </div>`;
                }
            },
            onInitialize: function() {
                Object.values(this.options).forEach(opt => {
                    const el = document.querySelector(`#subauthor option[value="${opt.value}"]`);
                    if (el) opt.image = el.dataset.image;
                });
            }
        }));

        /* ----------------------------------------------------
         * Tags
         * -------------------------------------------------- */
        new TomSelect('#tags', makeTomConfig({
            placeholder: 'Select tags',
        }));

        /* ----------------------------------------------------
         * Categories
         * -------------------------------------------------- */
        const categoriesTS = new TomSelect('#categories', makeTomConfig({
            placeholder: 'Select categories',
            onChange: function() {
                const val = categoriesTS.getValue();
                handleCategoryChange(Array.isArray(val) ? val : (val ? [val] : []));
            }
        }));

        /* ----------------------------------------------------
         * Sub Categories (disabled until category selected)
         * -------------------------------------------------- */
        const subcategoriesTS = new TomSelect('#subcategories', makeTomConfig({
            placeholder: 'Select sub categories',
            onChange: function() {
                const val = subcategoriesTS.getValue();
                handleSubCategoryChange(Array.isArray(val) ? val : (val ? [val] : []));
            }
        }));
        subcategoriesTS.disable();

        /* ----------------------------------------------------
         * Child Categories (disabled until subcategory selected)
         * -------------------------------------------------- */
        const childcategoriesTS = new TomSelect('#childcategories', makeTomConfig({
            placeholder: 'Select child categories',
        }));
        childcategoriesTS.disable();

        /* ----------------------------------------------------
         * Sub-category loader
         * -------------------------------------------------- */
        const subCategoryCache = {};

        function resetSubCategories() {
            subcategoriesTS.clear();
            subcategoriesTS.clearOptions();
            subcategoriesTS.disable();
            resetChildCategories();
        }

        function handleCategoryChange(selectedCats) {
            if (!selectedCats.length) {
                resetSubCategories();
                return;
            }

            let subCats = [];
            selectedCats.forEach(id => {
                if (subCategoryCache[id]) subCats = subCats.concat(subCategoryCache[id]);
            });

            const missing = selectedCats.filter(id => !subCategoryCache[id]);

            if (!missing.length) {
                renderSubCategories(subCats);
                return;
            }

            subcategoriesTS.clear();
            subcategoriesTS.clearOptions();
            subcategoriesTS.disable();

            $.post("<?= base_url('admin/sub-categories/by-categories') ?>", {
                category_ids: missing
            }).done(function(res) {
                res.forEach(sub => {
                    subCategoryCache[sub.cat_id] ??= [];
                    if (!subCategoryCache[sub.cat_id].find(s => s.id == sub.id))
                        subCategoryCache[sub.cat_id].push(sub);
                });
                selectedCats.forEach(id => {
                    if (subCategoryCache[id]) subCats = subCats.concat(subCategoryCache[id]);
                });
                renderSubCategories(subCats);
            }).fail(function() {
                showDangerToast('Failed to load sub categories');
                resetSubCategories();
            });
        }

        function renderSubCategories(subCats) {
            subcategoriesTS.clear();
            subcategoriesTS.clearOptions();

            const unique = Object.values(
                subCats.reduce((acc, cur) => {
                    acc[cur.id] = cur;
                    return acc;
                }, {})
            );
            unique.forEach(sub => {
                subcategoriesTS.addOption({
                    value: String(sub.id),
                    text: sub.sub_cat_name
                });
            });

            subcategoriesTS.refreshOptions(false);
            subcategoriesTS.enable();
        }

        /* ----------------------------------------------------
         * Child-category loader
         * -------------------------------------------------- */
        const childCategoryCache = {};

        function resetChildCategories() {
            childcategoriesTS.clear();
            childcategoriesTS.clearOptions();
            childcategoriesTS.disable();
        }

        function handleSubCategoryChange(selectedSubs) {
            if (!selectedSubs.length) {
                resetChildCategories();
                return;
            }

            let childCats = [];
            selectedSubs.forEach(id => {
                if (childCategoryCache[id]) childCats = childCats.concat(childCategoryCache[id]);
            });

            const missing = selectedSubs.filter(id => !childCategoryCache[id]);

            if (!missing.length) {
                renderChildCategories(childCats);
                return;
            }

            childcategoriesTS.clear();
            childcategoriesTS.clearOptions();
            childcategoriesTS.disable();

            $.post("<?= base_url('admin/child-categories/by-subcategories') ?>", {
                subcategory_ids: missing
            }).done(function(res) {
                res.forEach(child => {
                    childCategoryCache[child.sub_cat_id] ??= [];
                    if (!childCategoryCache[child.sub_cat_id].find(c => c.id == child.id))
                        childCategoryCache[child.sub_cat_id].push(child);
                });
                selectedSubs.forEach(id => {
                    if (childCategoryCache[id]) childCats = childCats.concat(childCategoryCache[id]);
                });
                renderChildCategories(childCats);
            }).fail(function() {
                showDangerToast('Failed to load child categories');
                resetChildCategories();
            });
        }

        function renderChildCategories(childCats) {
            childcategoriesTS.clear();
            childcategoriesTS.clearOptions();

            const unique = Object.values(
                childCats.reduce((acc, cur) => {
                    acc[cur.id] = cur;
                    return acc;
                }, {})
            );
            unique.forEach(child => {
                childcategoriesTS.addOption({
                    value: String(child.id),
                    text: child.child_cat_name
                });
            });

            childcategoriesTS.refreshOptions(false);
            childcategoriesTS.enable();
        }

        /* ----------------------------------------------------
         * Thumbnail toggle
         * -------------------------------------------------- */
        let mediaPage = 1,
            mediaLoading = false,
            mediaHasMore = true,
            mediaSearch = '';

        function loadMediaImages() {
            if (mediaLoading || !mediaHasMore) return;
            mediaLoading = true;
            $('#media-container').append('<div class="text-center loading-media p-2">Loading...</div>');

            $.get("<?= base_url('admin/api/get-media') ?>", {
                page: mediaPage,
                search: mediaSearch
            }, function(res) {
                $('.loading-media').remove();

                if (!res.data.length) {
                    mediaHasMore = false;
                    $('#media-container').append('<div class="text-center text-muted p-2">No images found</div>');
                    return;
                }

                let html = '<div class="row">';
                res.data.forEach(function(item) {
                    html += `
                    <div class="col-6 col-md-3 mb-3">
                        <div class="position-relative media-wrapper" style="cursor:pointer;">
                            <img src="<?= base_url() ?>${item.file_path}"
                                class="img-fluid rounded media-item w-100"
                                data-src="<?= base_url() ?>${item.file_path}"
                                style="height:100px;object-fit:cover;">
                            <div class="media-check position-absolute top-0 end-0 m-1 d-none">
                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                                    style="width:22px;height:22px;">
                                    <i class="fa fa-check text-white" style="font-size:12px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>`;
                });
                html += '</div>';

                $('#media-container').append(html);
                mediaPage++;
                mediaLoading = false;
                if (!res.next_page) mediaHasMore = false;
            }).fail(function() {
                $('.loading-media').remove();
                mediaLoading = false;
                showDangerToast('Failed to load media');
            });
        }

        let searchTimer;
        $('#mediaSearch').on('keyup', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                mediaSearch = $(this).val().trim();
                mediaPage = 1;
                mediaHasMore = true;
                $('#media-container').html('');
                loadMediaImages();
            }, 300);
        });

        function toggleThumbnailInput(type) {
            $('#selected_media').val('');
            $('#thumbnail-link-wrapper, #thumbnail-upload-wrapper, #thumbnail-media-wrapper, #previewImage').hide();

            if (type === 'link') {
                $('#thumbnail-link-wrapper').show();
            } else if (type === 'image') {
                $('#thumbnail-upload-wrapper').show();
            } else if (type === 'media') {
                $('#thumbnail-media-wrapper').show();
                if ($('#media-container').children().length === 0) loadMediaImages();
            }
        }

        $('#media-container').on('scroll', function() {
            if ($(this).scrollTop() + $(this).innerHeight() >= this.scrollHeight - 50) loadMediaImages();
        });

        const initialType = $('input[name="thumbnail_type"]:checked').val() || 'link';
        toggleThumbnailInput(initialType);

        $('.thumb-type').on('change', function() {
            toggleThumbnailInput(this.value);
        });

        $(document).on('click', '.media-wrapper', function() {
            const src = $(this).find('.media-item').data('src');

            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected').find('.media-check').addClass('d-none');
                $('#selected_media').val('');
            } else {
                $('.media-wrapper').removeClass('selected').find('.media-check').addClass('d-none');
                $(this).addClass('selected').find('.media-check').removeClass('d-none');
                $('#selected_media').val(src);
                $('#previewImage').html(`
                <img src="${src}" style="max-width:200px;height:150px;object-fit:cover;" class="img-fluid"><br>
                <a href="javascript:void(0)" id="changeMediaxx" class="btn btn-dark btn-sm mt-3">Change</a>
            `).show();
                $('#thumbnail-media-wrapper').hide();
            }
        });

        $(document).on('click', '#changeMediaxx', function() {
            $('#previewImage').hide();
            $('#thumbnail-media-wrapper').show();
        });

        /* ----------------------------------------------------
         * Dropify
         * -------------------------------------------------- */
        $('#thumbnail_image').dropify();

        /* ----------------------------------------------------
         * Submit handler
         * -------------------------------------------------- */
        $('#newsForm').on('submit', function(e) {
            e.preventDefault();
            const submitBtn = $(this).find('button[type="submit"]');
            const originalText = submitBtn.html();
            const thumbType = $('input[name="thumbnail_type"]:checked').val();
            submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Saving...');

            if (!$('#headline').val().trim()) {
                showDangerToast('Headline is required');
                submitBtn.prop('disabled', false).html(originalText);
                return;
            }

            if (!categoriesTS.getValue().length) {
                showDangerToast('Please select at least one category');
                submitBtn.prop('disabled', false).html(originalText);
                return;
            }

            if (thumbType === 'image') {
                if (!$('#thumbnail_image')[0].files.length) {
                    showDangerToast('Thumbnail image is required');
                    submitBtn.prop('disabled', false).html(originalText);
                    return;
                }
            }

            if (thumbType === 'media') {
                if (!$('#selected_media').val()) {
                    showDangerToast('Please select media image');
                    submitBtn.prop('disabled', false).html(originalText);
                    return;
                }
            }
            //  CKEditor 5 — use window.ckEditorInstance
            if (!window.ckEditorInstance) {
                showDangerToast('Editor not ready, please wait');
                submitBtn.prop('disabled', false).html(originalText);
                return;
            }

            const editorData = window.ckEditorInstance.getData();
            if (!editorData.replace(/<[^>]*>/g, '').trim()) {
                showDangerToast('Description is required');
                submitBtn.prop('disabled', false).html(originalText);
                return;
            }

            //  Sync editor content to hidden textarea before FormData
            document.querySelector('#editorOutput').value = editorData;

            $.ajax({
                url: "<?= base_url('admin/news/create') ?>",
                type: 'POST',
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
                },
                error(xhr) {
                    let msg = 'Something went wrong';

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }

                    showDangerToast(msg);
                },
                complete() {
                    submitBtn.prop('disabled', false).html(originalText);
                }
            });
        });

    });
</script>