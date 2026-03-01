<?= $this->extend('layouts/AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/select2/select2.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/dropify/dist/css/dropify.css">

<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/dropify/dist/css/dropify.min.css">

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card ">
            <div class="card-body">
                <h4 class="card-title">Create New Ad</h4>
                <form id="adForm" class="ad-form" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <!-- Title -->
                    <div class="mb-3">
                        <label class="form-label">Ad Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <!-- Ad Type -->
                    <div class="mb-3">
                        <label class="form-label">Ad Type</label>
                        <select name="ad_type" id="ad_type" class="form-select select-type create-ad-type" required>
                            <option value="image" selected>Image</option>
                            <option value="script">Script</option>
                        </select>
                    </div>
                    <div class="image-wrapper mb-3">
                        <label class="form-label">Ad Image</label>
                        <input type="file"
                            class="dropify"
                            id="adimage"
                            name="image"
                            accept="image/*">
                    </div>
                    <div class="script-wrapper mb-3 d-none">
                        <label class="form-label">Ad Script</label>
                        <textarea name="script" class="form-control" rows="4"
                            placeholder="Paste ad script here..."></textarea>
                    </div>
                    <div class="url-wrapper mb-3">
                        <label class="form-label">Redirect URL (optional)</label>
                        <input type="url" name="redirect_url" class="form-control" placeholder="https://example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-block">Show On Pages</label>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" name="pages[]" value="home" id="homePage">
                            <label for="homePage">Home Page</label>
                        </div>
                        <div class=" form-check-inline">
                            <input class="form-check-input" type="checkbox" name="pages[]" value="category" id="categoryPage">
                            <label for="categoryPage">Category Page</label>
                        </div>
                        <div class=" form-check-inline">
                            <input class="form-check-input" type="checkbox" name="pages[]" value="sub_category" id="subCategoryPage">
                            <label for="subCategoryPage">Sub Category Page</label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" name="pages[]" value="post" id="postPage">
                            <label for="postPage">Post Page</label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" name="pages[]" value="tag" id="tagPage">
                            <label for="tagPage">Tag Page</label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" name="pages[]" value="search" id="searchPage">
                            <label for="searchPage">Search Page</label>
                        </div>
                    </div>
                    <div class="position-wrapper mb-3">
                        <label class="form-label d-block">Position</label>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" name="position[]" value="block" id="posBlock">
                            <label for="posBlock">Block</label>
                        </div>
                        <div class=" form-check-inline">
                            <input class="form-check-input" type="checkbox" name="position[]" value="top" id="posTop">
                            <label for="posTop">Top</label>
                        </div>
                        <div class=" form-check-inline">
                            <input class="form-check-input" type="checkbox" name="position[]" value="left" id="posLeft">
                            <label for="posLeft">Left Side</label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" name="position[]" value="right" id="posRight">
                            <label for="posRight">Right Side</label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="checkbox" name="position[]" value="bottom" id="posBottom">
                            <label for="posBottom">Bottom</label>
                        </div>
                    </div>
                    <!-- Buttons -->
                    <button type="submit" name="status" value="draft" class="btn btn-secondary">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-body">
                <?php if (!empty($ads)): ?>
                    <h4 class="card-title">All Catagories</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="ads-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th>SL #</th>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>Positions</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sl = 0; ?>
                                        <?php foreach ($ads as $ad): $sl++; ?>
                                            <tr>
                                                <td><?= $sl ?></td>
                                                <td><?= esc($ad['title']) ?></td>
                                                <td><?= ucfirst($ad['ad_type']) ?></td>
                                                <td>
                                                    <?php $postitons = json_decode($ad['position']); ?>
                                                    <?php foreach ($postitons as $postiton): ?>
                                                        <?= ucfirst($postiton . ', ') ?>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td data-order="<?= $ad['status'] ?>">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <label class="toggle-switch mb-0">
                                                            <input type="checkbox" name="activestatus"
                                                                class="toggle-status"
                                                                data-id="<?= $ad['id'] ?>"
                                                                <?= $ad['status'] == 1 ? 'checked' : '' ?>>
                                                            <span class="slider"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-success btn-sm dropdown-toggle"
                                                            type="button"
                                                            data-bs-toggle="dropdown">
                                                            Modify
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <button class="dropdown-item editBtn" data-id="<?= $ad['id'] ?>">Edit</button>
                                                            <button class="dropdown-item deletebtn" data-id="<?= $ad['id'] ?>">Delete</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning mb-0" role="alert">
                        Ads are empty!
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- Page modals start  -->
<?= $this->include('admin/Components/Modals/AdsEditModal.php'); ?>

<!-- Page modals ends  -->

<?= $this->endSection() ?>

<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="<?= base_url() ?>assets/vendors/dropify/dist/js/dropify.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/select2/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url() ?>assets/vendors/dropify/dist/js/dropify.min.js"></script>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Page js start -->
<script>
    $(document).ready(function() {

        $('#ads-listing').DataTable();

        $('.select-type').select2({
            theme: 'bootstrap',
            minimumResultsForSearch: Infinity,
            dropdownParent: $('#editAdsModal')
        });


        $('.dropify').dropify();

        // Toggle fields
        function toggleAdType(form, type) {

            if (type === 'image') {
                form.find('.image-wrapper').removeClass('d-none');
                form.find('.url-wrapper').removeClass('d-none');
                form.find('.position-wrapper').removeClass('d-none');
                form.find('.script-wrapper').addClass('d-none');
            } else {
                form.find('.image-wrapper').addClass('d-none');
                form.find('.url-wrapper').addClass('d-none');
                form.find('.position-wrapper').addClass('d-none');
                form.find('.script-wrapper').removeClass('d-none');
            }
        }

        $(document).on('change', '.select-type', function() {

            let form = $(this).closest('.ad-form');
            let type = $(this).val();

            toggleAdType(form, type);

        });


        let clickedStatus = null;

        $('button[type="submit"]').on('click', function() {
            clickedStatus = $(this).val();
        });

        $('#adForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            formData.append('status', clickedStatus);
            $.ajax({
                url: "<?= base_url('admin/ads/store') ?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    if (res.success) {
                        showSuccessToast(res.message);
                        setTimeout(() => location.reload(), 1000);
                    }
                    if (res.errors) {
                        Object.values(res.errors).forEach(msg => {
                            showDangerToast(msg);
                        })
                    }
                },
                error: function(e) {
                    showDangerToast('Something went wrong');
                    console.error(err);
                }
            });
        });

        $(document).on('change', '.toggle-status', function(e) {
            e.preventDefault();
            let checkbox = $(this);
            let adId = checkbox.data('id');
            let isChecked = checkbox.is(':checked');

            // Revert immediately until confirmed
            checkbox.prop('checked', !isChecked);

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to change this ad status?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?= base_url('admin/ads/toggle-status') ?>",
                        type: "POST",
                        data: {
                            id: adId,
                            <?= csrf_token() ?>: "<?= csrf_hash() ?>"
                        },
                        success: function(res) {

                            if (res.success) {

                                // Now apply the change
                                checkbox.prop('checked', isChecked);
                                showSuccessToast('Status updated successfully');

                            } else {
                                showDangerToast('Status update failed');
                            }

                        },
                        error: function() {
                            showDangerToast('Server error');
                        }
                    });

                }

            });

        });

        $(document).on('click', '.editBtn', function() {

            let adId = $(this).data('id');

            $.get("<?= base_url('admin/ads') ?>/" + adId, function(res) {

                if (!res.success) {
                    showDangerToast('Ad not found');
                    return;
                }

                let ad = res.data;
                let modal = $('#editAdsModal');
                let form = modal.find('#editAdForm');

                form.attr('data-id', ad.id);

                form.find('[name="title"]').val(ad.title);
                form.find('[name="ad_type"]').val(ad.ad_type).trigger('change');
                form.find('[name="redirect_url"]').val(ad.url);
                form.find('[name="script"]').val(ad.script);

                // Pages
                form.find('input[name="pages[]"]').prop('checked', false);
                ad.pages?.forEach(page => {
                    form.find(`input[name="pages[]"][value="${page}"]`).prop('checked', true);
                });

                // Position
                form.find('input[name="position[]"]').prop('checked', false);
                ad.position?.forEach(pos => {
                    form.find(`input[name="position[]"][value="${pos}"]`).prop('checked', true);
                });

                // Toggle correctly
                toggleAdType(form, ad.ad_type);

                // Dropify Reset (clean version)
                let dr = form.find('.dropify').data('dropify');
                if (dr) {
                    dr.resetPreview();
                    dr.clearElement();
                    if (ad.image) {
                        dr.settings.defaultFile = "<?= base_url('uploads/ads/') ?>/" + ad.image;
                        dr.destroy();
                        dr.init();
                    }
                }

                modal.modal('show');

            });

        });

        $('#editAdForm').on('submit', function(e) {
            e.preventDefault();
            let form = this;
            let adId = $(this).data('id');
            let modal = $('#editAdsModal');
            Swal.fire({
                title: 'Update Ad?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, update'
            }).then(result => {

                if (!result.isConfirmed) return;

                let formData = new FormData(form);

                $.ajax({
                    url: "<?= base_url('admin/ads/update') ?>/" + adId,
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {

                        if (res.success) {
                            modal.modal("hide");
                            showSuccessToast(res.message);
                            setTimeout(() => location.reload(), 1200);
                        }

                        if (res.errors) {
                            Object.values(res.errors).forEach(msg => {
                                showDangerToast(msg);
                            });
                        }
                    },
                    error: function(e) {
                        showDangerToast('Server error');
                        console.error('Update error', e);

                    }
                });
            });
        });

        $(document).on('click', '.deletebtn', function() {

            let adId = $(this).data('id');
            let row = $(this).closest('tr');

            Swal.fire({
                title: 'Are you sure?',
                text: "This ad will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?= base_url('admin/ads/delete') ?>",
                        type: "POST",
                        data: {
                            id: adId,
                            <?= csrf_token() ?>: "<?= csrf_hash() ?>"
                        },
                        success: function(res) {

                            if (res.success) {

                                row.fadeOut(500, function() {
                                    $(this).remove();
                                });

                                showSuccessToast(res.message);

                            } else {
                                showDangerToast('Delete failed');
                            }
                        },
                        error: function(e) {
                            showDangerToast('Server error');
                            console.error('Delete error', e);

                        }
                    });
                }
            });
        });
    });
</script>
<!-- Page js ends  -->

<?= $this->endSection() ?>