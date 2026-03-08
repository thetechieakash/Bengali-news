<script>
    $(function() {
        // CKEDITOR config
        CKEDITOR.replace('editor', {
            height: '400px',
        });

        // GLightbox init 
        const lightbox = GLightbox();
        // sub author 
        $('#subauthor').select2({
            theme: 'bootstrap',
            templateResult: formatAuthor,
            templateSelection: formatAuthor,
            allowClear: true,
            placeholder: "Select Guest Author",
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

        function loadMediaImages() {

            if (mediaLoading || !mediaHasMore) return;

            mediaLoading = true;

            $('#media-container').append('<div class="text-center loading-media">Loading...</div>');

            $.get("<?= base_url('admin/api/get-media') ?>", {
                page: mediaPage,
                search: mediaSearch
            }, function(res) {

                $('.loading-media').remove();

                if (!res.data.length) {
                    mediaHasMore = false;
                    $('#media-container').append('<div class="text-center text-muted">No images found</div>');
                    return;
                }

                let html = '<div class="row">';

                res.data.forEach(function(item) {

                    html += `
                        <div class="col-md-3 col-6 mb-3">
                            <div class="position-relative media-wrapper" style="cursor:pointer;">
                                <img src="<?= base_url() ?>${item.file_path}"
                                    class="img-fluid rounded media-item"
                                    data-src="<?= base_url() ?>${item.file_path}"
                                    style="height:120px;object-fit:cover;">

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

                html += '</div>';

                $('#media-container').append(html);

                mediaPage++;
                mediaLoading = false;

                if (!res.next_page) {
                    mediaHasMore = false;
                }
            });
        }
        let searchTimer;

        $('#mediaSearch').on('keyup', function() {

            clearTimeout(searchTimer);

            searchTimer = setTimeout(() => {

                mediaSearch = $('#mediaSearch').val().trim();
                mediaPage = 1;
                mediaHasMore = true;

                $('#media-container').html('');

                loadMediaImages();

            }, 300);

        });

        function toggleThumbnailInput(type) {
            $("#selected_media").val('');
            if (type === 'link') {
                $('#thumbnail-link-wrapper').show();
                $('#thumbnail-upload-wrapper').hide();
                $('#thumbnail-media-wrapper').hide();
                $("#previewImage").hide();
            } else if (type === 'image') {
                $('#thumbnail-upload-wrapper').show();
                $('#thumbnail-link-wrapper').hide();
                $('#thumbnail-media-wrapper').hide();
                $("#previewImage").hide();
            } else if (type === 'media') {

                $('#thumbnail-media-wrapper').show();
                $('#thumbnail-link-wrapper').hide();
                $('#thumbnail-upload-wrapper').hide();
                $("#previewImage").hide();

                if ($('#media-container').children().length === 0) {
                    loadMediaImages();
                }
            }
        }

        $('#media-container').on('scroll', function() {

            const scrollTop = $(this).scrollTop();
            const scrollHeight = this.scrollHeight;
            const height = $(this).innerHeight();

            if (scrollTop + height >= scrollHeight - 50) {
                loadMediaImages();
            }
        });

        toggleThumbnailInput($('input[name="thumbnail_type"]:checked').val());

        $('.thumb-type').on('change', function() {
            toggleThumbnailInput(this.value);
        });


        let selectedMedia = '';

        $(document).on('click', '.media-wrapper', function() {

            const img = $(this).find('.media-item');
            const check = $(this).find('.media-check');
            const src = img.data('src');

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

                selectedMedia = src;
                $('#selected_media').val(src);
                const imgHtml = `<img src="${src}" style="width: 200px"; height: 150px; object-fit: cover><br>
                <a href="javascript:void(0)" id="changeMediaxx" class="btn btn-dark btn-sm mt-3">Change</a>
            `;
                $("#previewImage").html(imgHtml);
                $("#previewImage").show();
                $('#thumbnail-media-wrapper').hide();
            }
        });

        $(document).on('click', '#changeMediaxx', function() {
            $("#previewImage").hide();
            $('#thumbnail-media-wrapper').show();
        })


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

        $('#childcategories').select2({
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
         * Child-category loader with cache
         * -------------------------------------------------- */

        const childCategoryCache = {};

        $('#subcategories').on('change', function() {

            const selectedSubs = $(this).val() || [];

            if (!selectedSubs.length) {
                resetChildCategories();
                return;
            }

            $('#childcategories')
                .html('<option>Loading...</option>')
                .prop('disabled', true)
                .trigger('change');

            let childCats = [];

            selectedSubs.forEach(id => {
                if (childCategoryCache[id]) {
                    childCats = childCats.concat(childCategoryCache[id]);
                }
            });

            const missing = selectedSubs.filter(id => !childCategoryCache[id]);

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

                selectedSubs.forEach(id => {
                    if (childCategoryCache[id]) {
                        childCats = childCats.concat(childCategoryCache[id]);
                    }
                });

                renderChildCategories(childCats);

            }).fail(function() {
                showDangerToast('Failed to load child categories');
                resetChildCategories();
            });
        });

        function resetChildCategories() {
            $('#childcategories')
                .empty()
                .prop('disabled', true)
                .trigger('change');
        }

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
                childSelect.append(new Option(child.child_cat_name, child.id));
            });

            childSelect.prop('disabled', false).trigger('change');
        }
        /* ----------------------------------------------------
         * Dropify
         * -------------------------------------------------- */
        const dropifyInstance = $('#thumbnail_image').dropify().data('dropify');

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
                },
                error(err) {
                    showDangerToast('Something went wrong');
                    console.error(err);
                },
                complete() {
                    submitBtn.prop('disabled', false);
                }
            });
        });
    });
</script>