<?= $this->extend('layouts/AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/dropify/dist/css/dropify.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/dropify/dist/css/dropify.min.css">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add media</h4>
                <form class="forms-sample" id="mediaform" action="<?= base_url('admin/upload-media') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <input type="file"
                            class="dropify"
                            id="media"
                            name="media[]"
                            accept="image/*" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary text-white me-2">Upload</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card mt-3">
            <div class="card-body">
                <h4 class="card-title">All media</h4>
                <div class="all-media" style="max-height: 500px;overflow-y: auto; overflow-x: hidden;">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page modals start  -->
<!-- Page modals ends  -->

<?= $this->endSection() ?>

<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/vendors/dropify/dist/js/dropify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Page js start -->
<script>
    $(document).ready(function() {
        $('#media').dropify();
        let currentPage = 1;
        let loading = false;
        let nextPage = 1;

        function loadMedia(page = 1) {

            if (loading || (!nextPage && page !== 1)) return;

            loading = true;

            $.get("<?= base_url('admin/api/get-media') ?>", {
                page: page
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
                        <div class="col-3 col-md-2 mb-3 media-item">
                            <div class="position-relative">
                                <img src="https://placehold.co/300x200?text=Loading..."
                                    data-src="<?= base_url() ?>${item.file_path}"
                                    class="img-fluid rounded lazy-media"
                                    style="height:120px;object-fit:cover;">

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

            let formData = new FormData(this);

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
                        showSuccessToast(res.message);

                        $('#media').val('');

                        currentPage = 1;
                        nextPage = 1;
                        loading = false;

                        loadMedia(1);

                    } else {
                        showDangerToast(res.error || res.message);
                    }
                },
                error: function() {
                    showDangerToast('Upload failed.');
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
    });
</script>
<!-- Page js ends  -->

<?= $this->endSection() ?>