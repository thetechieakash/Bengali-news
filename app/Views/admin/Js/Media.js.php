<script>
    $(document).ready(function() {
        $('#media').dropify();
        let currentPage = 1;
        let loading = false;
        let nextPage = 1;
        let searchQuery = '';
        let searchTimer;

        // Media search 
        $('#mediaSearch').on('keyup', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(function() {
                searchQuery = $('#mediaSearch').val();
                currentPage = 1;
                nextPage = 1;
                loadMedia(1);
            }, 400);
        });

        // Load media 
        function loadMedia(page = 1) {
            if (loading || (!nextPage && page !== 1)) return;
            loading = true;
            $.get("<?= base_url('admin/api/get-media') ?>", {
                page: page,
                search: searchQuery
            }, function(response) {
                const media = response.data;
                nextPage = response.next_page;
                if (!media.length && page === 1) {
                    $('.all-media').html('<p>No media found</p>');
                    loading = false;
                    return;
                }
                let html = '';
                media.forEach(function(item) {
                    html += `
                        <div class="col-3 col-md-2 mb-3 media-item" data-name="${item.file_name.toLowerCase()}">
                            <div class="position-relative media-box">
                                <img src="https://placehold.co/300x200?text=Loading..."
                                    data-src="<?= base_url() ?>${item.file_path}"
                                    data-url="<?= base_url() ?>${item.file_path}"
                                    class="img-fluid rounded lazy-media preview-media"
                                    style="height:120px;object-fit:cover;cursor:pointer;">
                                <div class="copy-link position-absolute bottom-0 start-0 end-0 text-center"
                                    data-url="<?= base_url() ?>${item.file_path}">
                                    Copy Link
                                </div>

                                <div class="delete-media position-absolute top-0 end-0 m-1"
                                    data-id="${item.id}"
                                    style="cursor:pointer;">
                                    
                                    <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center"
                                        style="width:22px;height:22px;">
                                        <i class="fa fa-times text-white" style="font-size:11px;"></i>
                                    </div>

                                </div>
                            </div>
                        </div>
                        `;
                });
                if (page === 1) {
                    $('.all-media').html('<div class="row" id="media-grid">' + html + '</div>');
                } else {
                    $('#media-grid').append(html);
                }
                initLazyLoading();
                loading = false;
            });
        }

        // Lazy Loading 
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

        loadMedia();
        initLazyLoading();

        $('.all-media').on('scroll', function() {
            let container = $(this)[0];
            if (container.scrollTop + container.clientHeight >= container.scrollHeight - 50) {
                if (nextPage && !loading) {
                    loadMedia(nextPage);
                }
            }
        });

        // AJAX upload
        $('#mediaform').on('submit', function(e) {
            e.preventDefault();

            const input = document.getElementById('media');

            if (!input.files.length) {
                showDangerToast('Please select at least one image');
                return;
            }

            let formData = new FormData(this);

            const $btn = $(this).find('button[type="submit"]');

            // Disable + Loader ON
            $btn.prop('disabled', true)
                .html('<span class="spinner-border spinner-border-sm me-2"></span> Uploading...');

            $.ajax({
                url: "<?= base_url('admin/upload-media') ?>",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.success) {
                        let dr = $('#media').data('dropify');
                        dr.clearElement();
                        $('#media').val('');
                        currentPage = 1;
                        nextPage = 1;
                        loading = false;
                        loadMedia(1);
                        showSuccessToast(res.message);
                        //  Partial errors
                        if (res.error && (Array.isArray(res.error) ? res.error.length : true)) {
                            let errors = Array.isArray(res.error) ?
                                res.error :
                                [res.error];
                            Swal.fire({
                                icon: 'warning',
                                title: 'Some files failed',
                                html: errors.join('<br>')
                            });
                        }
                    } else {
                        let errors = [];
                        if (res.message) errors.push(res.message);
                        if (res.error) {
                            if (Array.isArray(res.error)) {
                                errors = errors.concat(res.error);
                            } else {
                                errors.push(res.error);
                            }
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Upload Failed',
                            html: errors.map(err => `<div>• ${err}</div>`).join('')
                        });
                    }
                },

                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Upload Failed',
                        text: 'Server error'
                    });
                },

                complete: function() {
                    // Enable + Restore button
                    $btn.prop('disabled', false)
                        .html('Upload');
                }
            });
        });

        // Delete media
        $(document).on('click', '.delete-media', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Delete this media?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('admin/delete-media') ?>/" + id,
                        type: "DELETE",
                        success: function(res) {

                            if (res.success) {
                                Swal.fire('Deleted!', '', 'success');
                                loadMedia();
                            }
                        }
                    });
                }
            });
        });

        // Copy link 
        $(document).on('click', '.copy-link', function() {
            let url = $(this).data('url');
            navigator.clipboard.writeText(url).then(function() {
                showSuccessToast('Link copied');
            });
        });

        // Image preview 
        $(document).on('click', '.preview-media', function() {
            let url = $(this).data('url');
            $('#previewImage').attr('src', url);
            $('#mediaPreviewModal').modal('show');
        });

    });
</script>