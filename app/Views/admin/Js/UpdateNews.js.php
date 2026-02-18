<script>
    const selectedSubCatIds = <?= json_encode($post['subcategory_ids'] ?? []) ?>;
    const preloadedSubCats = <?= json_encode($post['subcategories'] ?? []) ?>;
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

        function initLazyLoading() {

            const images = document.querySelectorAll('.lazy-media');

            const observer = new IntersectionObserver((entries, observer) => {

                entries.forEach(entry => {

                    if (entry.isIntersecting) {

                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy-media');

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

            $.get("<?= base_url('admin/api/get-media') ?>?page=" + mediaPage, function(res) {

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

                let html = mediaPage === 1 ? '<div class="row" id="media-grid">' : '';

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
                    html += '</div>';
                    $('#media-container').html(html);
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
                loadMediaImages();
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
            }
        });

        function applyPreselectedMedia() {

            const preselected = $('#selected_media').val();

            if (!preselected) return;

            $('.media-wrapper').each(function() {

                const img = $(this).find('img');

                if (img.data('path') === preselected) {

                    $(this).addClass('selected');
                    $(this).find('.media-check').removeClass('d-none');
                }
            });
        }


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