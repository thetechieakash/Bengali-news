<script>
    const selectedSubCatIds = <?= json_encode($post['subcategory_ids'] ?? []) ?>;
    const preloadedSubCats = <?= json_encode($post['subcategories'] ?? []) ?>;
    const selectedChildCatIds = <?= json_encode($post['childcategories_ids'] ?? []) ?>;
    const preloadedChildCats = <?= json_encode($post['childcategories'] ?? []) ?>;
    $(function() {
        // CKEDITOR config
        CKEDITOR.replace('editor', {
            height: '400px',
        });

        // GLightbox init 
        const lightbox = GLightbox();

        // sub author 
        $('#subauthor').select2({
            templateResult: formatAuthor,
            templateSelection: formatAuthor,
            allowClear: true,
            placeholder: "Select Sub Author",
            escapeMarkup: function(markup) {
                return markup;
            }
        });

        function formatAuthor(option) {
            if (!option.id) return option.text;

            let img = $(option.element).data('image');

            return `
        <div style="display:flex; align-items:center;">
            <img src="${img}" 
                 style="width:35px;height:35px;border-radius:50%;margin-right:10px;object-fit:cover;">
            <div>
                ${option.text}
            </div>
        </div>
    `;
        }

        /* ----------------------------------------------------
         * Thumbnail toggle
         * -------------------------------------------------- */
        let mediaPage = 1;
        let mediaLoading = false;
        let mediaHasMore = true;
        let mediaSearch = '';

        function initLazyLoading() {

            const images = document.querySelectorAll('.lazy-media');

            const observer = new IntersectionObserver((entries, observer) => {

                entries.forEach(entry => {

                    if (entry.isIntersecting) {

                        const img = entry.target;
                        img.src = img.dataset.src;

                        observer.unobserve(img);
                    }

                });

            }, {
                rootMargin: '100px'
            });

            images.forEach(img => observer.observe(img));
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

                    const selectedIndex = images.findIndex(img => img.file_path === selectedPath);

                    if (selectedIndex !== -1) {
                        const selectedItem = images.splice(selectedIndex, 1)[0];
                        images.unshift(selectedItem);
                    }
                }
                if (!images.length && mediaPage === 1) {
                    $('#media-container').html('<p>No media found</p>');
                    mediaHasMore = false;
                    return;
                }

                let html = '';

                images.forEach(function(image) {

                    const fullSrc = "<?= base_url() ?>" + image.file_path;

                    html += `
        <div class="col-3 col-md-2 mb-3">
            <div class="position-relative media-wrapper" style="cursor:pointer;">
                
                <img src="https://placehold.co/300x200?text=Loading..."
                    data-src="${fullSrc}"
                    data-path="${image.file_path}"
                    class="img-fluid rounded lazy-media"
                    style="height:100px;object-fit:cover;">

                <div class="media-check position-absolute top-0 end-0 m-1 d-none">
                    <div class="bg-success rounded-circle d-flex align-items-center justify-content-center"
                        style="width:22px;height:22px;">
                        <i class="fa fa-check text-white" style="font-size:12px;"></i>
                    </div>
                </div>

            </div>
        </div>
    `;
                });

                if (mediaPage === 1) {

                    $('#media-container').html(`
        <div class="row" id="media-grid">
            ${html}
        </div>
    `);

                } else {

                    $('#media-grid').append(html);

                }

                initLazyLoading();

                mediaPage++;
                mediaLoading = false;

                if (!res.next_page) {
                    mediaHasMore = false;
                }

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

                    const imgHtml = `
                <img src="${src}" style="width:200px;height:150px;object-fit:cover"><br>
                <a href="javascript:void(0)" id="changeMediaxx" class="btn btn-dark btn-sm mt-3">Change</a>
            `;

                    $("#previewImage").html(imgHtml).show();
                    $('#thumbnail-media-wrapper').hide();
                }
            });
        }

        $('#media-container').on('scroll', function() {

            let container = $(this)[0];

            if (container.scrollTop + container.clientHeight >= container.scrollHeight - 50) {

                loadMediaImages();
            }
        });

        function toggleThumbnailInput(type) {
            if (type === 'link') {
                $('#thumbnail-link-wrapper').show();
                $('#thumbnail-upload-wrapper').hide();
                $('#thumbnail-media-wrapper').hide();
            } else if (type === 'image') {
                $('#thumbnail-link-wrapper').hide();
                $('#thumbnail-upload-wrapper').show();
                $('#thumbnail-media-wrapper').hide();
            } else if (type === 'media') {
                $('#thumbnail-link-wrapper').hide();
                $('#thumbnail-upload-wrapper').hide();
                $('#thumbnail-media-wrapper').show();
                if ($('#media-container').children().length === 0) {
                    loadMediaImages();
                }
                applyPreselectedMedia();
            }
        }


        toggleThumbnailInput($('input[name="thumbnail_type"]:checked').val());

        $('.thumb-type').on('change', function() {
            $('#thumbnail_removed').val('0');
            toggleThumbnailInput(this.value);
        });

        let selectedMedia = '';

        $(document).on('click', '.media-wrapper', function() {

            const img = $(this).find('img');
            const check = $(this).find('.media-check');
            const path = img.data('path');
            const src = img.attr('src') || img.data('src');

            if ($(this).hasClass('selected')) {

                $(this).removeClass('selected');
                check.addClass('d-none');

                $('#selected_media').val('');
                selectedMedia = '';

            } else {

                $('.media-wrapper').removeClass('selected');
                $('.media-check').addClass('d-none');

                $(this).addClass('selected');
                check.removeClass('d-none');

                selectedMedia = path;
                $('#selected_media').val(path);

                const imgHtml = `
            <img src="${src}" style="width:200px;height:150px;object-fit:cover"><br>
            <a href="javascript:void(0)" id="changeMediaxx" class="btn btn-dark btn-sm mt-3">Change</a>
        `;
                $("#previewImage").html(imgHtml).show();
                $('#thumbnail-media-wrapper').hide();
            }
        });
        $(document).on('click', '#changeMediaxx', function() {
            $("#previewImage").hide();
            $('#thumbnail-media-wrapper').show();
            $('#media-container').scrollTop(0);
        });

        /* ----------------------------------------------------
         * Select2
         * -------------------------------------------------- */
        $('#tags').select2({
            theme: 'bootstrap',
            placeholder: 'Select tags',
        });

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
            let subCats = [];

            preloadedSubCats.forEach(sub => {
                subCategoryCache[sub.cat_id] ??= [];
                subCategoryCache[sub.cat_id].push(sub);
                subCats.push(sub);
            });

            renderSubCategories(subCats);
        }


        function resetSubCategories() {
            $('#subcategories')
                .empty()
                .prop('disabled', true)
                .trigger('change');
        }

        $('#categories').on('change', function() {

            const selectedCats = $(this).val() || [];

            /* ---------------------------------------
             * Remove invalid subcategories immediately
             * ------------------------------------- */
            const validSubIds = [];

            selectedCats.forEach(catId => {
                if (subCategoryCache[catId]) {
                    subCategoryCache[catId].forEach(sub => {
                        validSubIds.push(String(sub.id));
                    });
                }
            });

            const currentSelected = $('#subcategories').val() || [];
            const filtered = currentSelected.filter(id =>
                validSubIds.includes(String(id))
            );

            $('#subcategories').val(filtered).trigger('change');

            /* ---------------------------------------
             * No category selected → reset
             * ------------------------------------- */
            if (!selectedCats.length) {
                resetSubCategories();
                return;
            }

            /* ---------------------------------------
             * Loading state
             * ------------------------------------- */
            $('#subcategories')
                .html('<option>Loading...</option>')
                .prop('disabled', true)
                .trigger('change');

            let subCats = [];

            /* ---------------------------------------
             * Load cached subcategories first
             * ------------------------------------- */
            selectedCats.forEach(id => {
                if (subCategoryCache[id]) {
                    subCats = subCats.concat(subCategoryCache[id]);
                }
            });

            const missing = selectedCats.filter(id => !subCategoryCache[id]);

            /* ---------------------------------------
             * All cached → render immediately
             * ------------------------------------- */
            if (!missing.length) {
                renderSubCategories(subCats);
                return;
            }

            /* ---------------------------------------
             * Fetch missing subcategories
             * ------------------------------------- */
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
         * Child-category loader with cache
         * -------------------------------------------------- */
        const childCategoryCache = {};

        $('#childcategories').select2({
            theme: 'bootstrap',
            placeholder: 'Select child categories'
        });
        if (preloadedChildCats.length) {

            let childCats = [];

            preloadedChildCats.forEach(child => {

                childCategoryCache[child.sub_cat_id] ??= [];
                childCategoryCache[child.sub_cat_id].push(child);

                childCats.push(child);

            });

            renderChildCategories(childCats);
        }
        $('#subcategories').on('change', function() {

            const subIds = $(this).val() || [];

            if (!subIds.length) {
                $('#childcategories').empty().prop('disabled', true).trigger('change');
                return;
            }

            $('#childcategories')
                .html('<option>Loading...</option>')
                .prop('disabled', true)
                .trigger('change');

            let childCats = [];

            subIds.forEach(id => {
                if (childCategoryCache[id]) {
                    childCats = childCats.concat(childCategoryCache[id]);
                }
            });

            const missing = subIds.filter(id => !childCategoryCache[id]);

            if (!missing.length) {
                renderChildCategories(childCats);
                return;
            }

            $.post("<?= base_url('admin/child-categories/by-subcategories') ?>", {
                subcategory_ids: missing
            }).done(function(res) {

                res.forEach(child => {
                    childCategoryCache[child.sub_cat_id] ??= [];
                    childCategoryCache[child.sub_cat_id].push(child);
                });

                subIds.forEach(id => {
                    if (childCategoryCache[id]) {
                        childCats = childCats.concat(childCategoryCache[id]);
                    }
                });

                renderChildCategories(childCats);

            }).fail(function() {
                showDangerToast('Failed to load child categories');
            });
        });

        function renderChildCategories(childCats) {

            const childSelect = $('#childcategories');

            childSelect.empty();

            const unique = Object.values(
                childCats.reduce((acc, cur) => {
                    acc[cur.id] = cur;
                    return acc;
                }, {})
            );

            unique.forEach(child => {

                childSelect.append(
                    new Option(
                        child.child_cat_name,
                        child.id,
                        false,
                        selectedChildCatIds.includes(String(child.id)) ||
                        selectedChildCatIds.includes(child.id)
                    )
                );

            });

            childSelect.prop('disabled', false).trigger('change');
        }
        /* ----------------------------------------------------
         * Dropify
         * -------------------------------------------------- */
        const dropifyInstance = $('#thumbnail_image').dropify().data('dropify');
        $('#thumbnail_image').on('dropify.afterClear', function() {
            document.getElementById('thumbnail_removed').value = '1';
        });

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

            Swal.fire({
                title: 'Publish this post?',
                theme: 'bootstrap-4',
                html: `
                        <h6 class="mb-0">
                            The <strong>post date will be updated</strong><br>
                            to the <strong>current date & time</strong>.
                        </h6>
                    `,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, publish',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#1F3BB3',
                cancelButtonColor: '#73777a',
                reverseButtons: true,
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    submitPost(1); // SAVE + PUBLISH
                }
            });
        });
        $(document).on('click', '#preview', function(e) {
            e.preventDefault()
        });
    });
</script>