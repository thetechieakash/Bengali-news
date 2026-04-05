<script>
    const selectedSubCatIds = <?= json_encode(array_map('strval', $post['subcategory_ids'] ?? [])) ?>;
    const preloadedSubCats = <?= json_encode($post['subcategories'] ?? []) ?>;
    const selectedChildCatIds = <?= json_encode(array_map('strval', $post['childcategory_ids'] ?? [])) ?>;
    const preloadedChildCats = <?= json_encode($post['childcategories'] ?? []) ?>;
</script>

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
         * Sub Categories
         * -------------------------------------------------- */
        const subcategoriesTS = new TomSelect('#subcategories', makeTomConfig({
            placeholder: 'Select sub categories',
            onChange: function() {
                const val = subcategoriesTS.getValue();
                handleSubCategoryChange(Array.isArray(val) ? val : (val ? [val] : []));
            }
        }));

        /* ----------------------------------------------------
         * Child Categories
         * -------------------------------------------------- */
        const childcategoriesTS = new TomSelect('#childcategories', makeTomConfig({
            placeholder: 'Select child categories',
        }));

        /* ----------------------------------------------------
         * Preload subcategories
         * -------------------------------------------------- */
        const subCategoryCache = {};

        if (preloadedSubCats.length) {
            preloadedSubCats.forEach(sub => {
                subCategoryCache[sub.cat_id] ??= [];
                if (!subCategoryCache[sub.cat_id].find(s => s.id == sub.id))
                    subCategoryCache[sub.cat_id].push(sub);
            });
            renderSubCategories(preloadedSubCats);
        } else {
            subcategoriesTS.disable();
        }

        /* ----------------------------------------------------
         * Preload child categories
         * -------------------------------------------------- */
        const childCategoryCache = {};

        if (preloadedChildCats.length) {
            preloadedChildCats.forEach(child => {
                childCategoryCache[child.sub_cat_id] ??= [];
                if (!childCategoryCache[child.sub_cat_id].find(c => c.id == child.id))
                    childCategoryCache[child.sub_cat_id].push(child);
            });
            renderChildCategories(preloadedChildCats);
        } else {
            childcategoriesTS.disable();
        }

        /* ----------------------------------------------------
         * Sub-category logic
         * -------------------------------------------------- */
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

            const validSubIds = [];
            selectedCats.forEach(catId => {
                if (subCategoryCache[catId])
                    subCategoryCache[catId].forEach(sub => validSubIds.push(String(sub.id)));
            });

            const currentSelected = subcategoriesTS.getValue();
            const filtered = (Array.isArray(currentSelected) ? currentSelected : [currentSelected])
                .filter(id => validSubIds.includes(String(id)));

            let subCats = [];
            selectedCats.forEach(id => {
                if (subCategoryCache[id]) subCats = subCats.concat(subCategoryCache[id]);
            });

            const missing = selectedCats.filter(id => !subCategoryCache[id]);

            if (!missing.length) {
                renderSubCategories(subCats, filtered);
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
                renderSubCategories(subCats, filtered);
            }).fail(function() {
                showDangerToast('Failed to load sub categories');
                resetSubCategories();
            });
        }

        function renderSubCategories(subCats, preselectIds = null) {
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

            const toSelect = preselectIds !== null ? preselectIds : selectedSubCatIds;
            toSelect.forEach(id => {
                if (subcategoriesTS.options[String(id)])
                    subcategoriesTS.addItem(String(id), true);
            });
        }

        /* ----------------------------------------------------
         * Child-category logic
         * -------------------------------------------------- */
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

        function renderChildCategories(childCats, preselectIds = null) {
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

            const toSelect = preselectIds !== null ? preselectIds : selectedChildCatIds;
            toSelect.forEach(id => {
                if (childcategoriesTS.options[String(id)])
                    childcategoriesTS.addItem(String(id), true);
            });
        }

        /* ----------------------------------------------------
         * Thumbnail toggle
         * -------------------------------------------------- */
        let mediaPage = 1,
            mediaLoading = false,
            mediaHasMore = true,
            mediaSearch = '';

        function initLazyLoading() {
            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        obs.unobserve(img);
                    }
                });
            }, {
                rootMargin: '100px'
            });
            document.querySelectorAll('.lazy-media').forEach(img => observer.observe(img));
        }

        function loadMediaImages() {
            if (mediaLoading || !mediaHasMore) return;
            mediaLoading = true;

            if (mediaPage === 1) {
                $('#media-container').html('<div class="text-center p-2">Loading...</div>');
            } else {
                $('#media-container').append('<div class="text-center loading-media">Loading...</div>');
            }

            $.get("<?= base_url('admin/api/get-media') ?>", {
                page: mediaPage,
                search: mediaSearch
            }, function(res) {
                $('.loading-media').remove();

                const images = res.data || [];
                const selectedPath = $('#selected_media').val();

                if (mediaPage === 1 && selectedPath) {
                    const idx = images.findIndex(img => img.file_path === selectedPath);
                    if (idx !== -1) images.unshift(images.splice(idx, 1)[0]);
                }

                if (!images.length && mediaPage === 1) {
                    $('#media-container').html('<p class="text-muted p-2">No media found</p>');
                    mediaHasMore = false;
                    return;
                }

                let html = '';
                images.forEach(function(image) {
                    const fullSrc = "<?= base_url() ?>" + image.file_path;
                    html += `
                    <div class="col-6 col-md-3 mb-3">
                        <div class="position-relative media-wrapper" style="cursor:pointer;">
                            <img src="https://placehold.co/300x200?text=Loading..."
                                data-src="${fullSrc}"
                                data-path="${image.file_path}"
                                class="img-fluid rounded lazy-media w-100"
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

                if (mediaPage === 1) {
                    $('#media-container').html(`<div class="row" id="media-grid">${html}</div>`);
                } else {
                    $('#media-grid').append(html);
                }

                initLazyLoading();
                mediaPage++;
                mediaLoading = false;
                if (!res.next_page) mediaHasMore = false;

                applyPreselectedMedia();
            });
        }

        let searchTimer;
        $('#mediaSearch').on('keyup', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                mediaSearch = $(this).val().trim();
                mediaPage = 1;
                mediaHasMore = true;
                mediaLoading = false;
                $('#media-container').html('');
                loadMediaImages();
            }, 300);
        });

        function applyPreselectedMedia() {
            const preselected = $('#selected_media').val();
            if (!preselected) return;

            $('.media-wrapper').each(function() {
                const img = $(this).find('img');
                if (img.data('path') === preselected) {
                    const src = img.data('src');
                    $(this).addClass('selected');
                    $(this).find('.media-check').removeClass('d-none');
                    $('#previewImage').html(`
                    <img src="${src}" style="max-width:200px;height:150px;object-fit:cover;" class="img-fluid"><br>
                    <a href="javascript:void(0)" id="changeMediaxx" class="btn btn-dark btn-sm mt-3">Change</a>
                `).show();
                    $('#thumbnail-media-wrapper').hide();
                }
            });
        }

        $('#media-container').on('scroll', function() {
            const c = this;
            if (c.scrollTop + c.clientHeight >= c.scrollHeight - 50) loadMediaImages();
        });

        function toggleThumbnailInput(type) {
            $('#thumbnail-link-wrapper, #thumbnail-upload-wrapper, #thumbnail-media-wrapper, #previewImage').hide();

            if (type === 'link') {
                $('#thumbnail-link-wrapper').show();
            } else if (type === 'image') {
                $('#thumbnail-upload-wrapper').show();
            } else if (type === 'media') {
                $('#thumbnail-media-wrapper').show();
                if ($('#media-container').children().length === 0) loadMediaImages();
                else applyPreselectedMedia();
            }
        }

        toggleThumbnailInput($('input[name="thumbnail_type"]:checked').val());
        $('.thumb-type').on('change', function() {
            $('#thumbnail_removed').val('0');
            toggleThumbnailInput(this.value);
        });

        $(document).on('click', '.media-wrapper', function() {
            const img = $(this).find('img');
            const path = img.data('path');
            const src = img.attr('src') || img.data('src');

            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected').find('.media-check').addClass('d-none');
                $('#selected_media').val('');
            } else {
                $('.media-wrapper').removeClass('selected').find('.media-check').addClass('d-none');
                $(this).addClass('selected').find('.media-check').removeClass('d-none');
                $('#selected_media').val(path);
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
            $('#media-container').scrollTop(0);
        });

        /* ----------------------------------------------------
         * Dropify
         * -------------------------------------------------- */
        $('#thumbnail_image').dropify();
        $('#thumbnail_image').on('dropify.afterClear', function() {
            $('#thumbnail_removed').val('1');
        });

        /* ----------------------------------------------------
         * Submit handler
         * -------------------------------------------------- */
        function submitPost(status) {
            $('#post_status').val(status);

            const btn = status === 1 ? $('#publish') : $('#update');
            btn.prop('disabled', true);

            if (!window.ckEditorInstance) {
                showDangerToast('Editor not ready, please wait');
                btn.prop('disabled', false);
                return;
            }

            const editorData = window.ckEditorInstance.getData();
            if (!editorData.replace(/<[^>]*>/g, '').trim()) {
                showDangerToast('Description is required');
                btn.prop('disabled', false);
                return;
            }

            // ✅ Sync CKEditor 5 → hidden textarea before FormData
            document.querySelector('#editorOutput').value = editorData;

            $.ajax({
                url: "<?= base_url('admin/news/update/' . $post['id']) ?>",
                type: 'POST',
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
                    btn.prop('disabled', false);
                }
            });
        }

        $(document).on('click', '#update', function(e) {
            e.preventDefault();
            submitPost(0);
        });

        $(document).on('click', '#publish', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Publish this post?',
                html: `<h6 class="mb-0">The <strong>post date will be updated</strong><br>to the <strong>current date & time</strong>.</h6>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, publish',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#1F3BB3',
                cancelButtonColor: '#73777a',
                reverseButtons: true,
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) submitPost(1);
            });
        });

        $(document).on('click', '#preview', function(e) {
            e.preventDefault();
            const slug = "<?= esc($post['slug']) ?>";
            window.open("<?= base_url('admin/news-preview/') ?>" + slug, '_blank');
        });

    });
</script>