<?= $this->extend('layouts/AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>

<?= $this->section('plugin') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/select2/select2.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/dropify/dist/css/dropify.min.css">
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="row">

    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Create New Ad</h4>

                <form id="adForm" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label">Ad Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ad Type</label>
                        <select name="ad_type" id="ad_type" class="form-select select-type">
                            <option value="image">Image</option>
                            <option value="script">Script</option>
                        </select>
                    </div>

                    <div class="pages-wrapper mb-3">
                        <label class="form-label d-block">Show On Pages</label>

                        <label class="me-3">
                            <input type="checkbox" name="pages[]" value="home"> Home
                        </label>

                        <label class="me-3">
                            <input type="checkbox" name="pages[]" value="category"> Category
                        </label>

                        <label class="me-3">
                            <input type="checkbox" name="pages[]" value="sub_category"> Sub Category
                        </label>

                        <label class="me-3">
                            <input type="checkbox" name="pages[]" value="child_category"> Child Category
                        </label>

                        <label class="me-3">
                            <input type="checkbox" name="pages[]" value="post"> Post
                        </label>

                        <label class="me-3">
                            <input type="checkbox" name="pages[]" value="tag"> Tag
                        </label>

                        <label class="me-3">
                            <input type="checkbox" name="pages[]" value="search"> Search
                        </label>

                    </div>

                    <div class="position-wrapper mb-3">

                        <label class="form-label d-block">Position</label>

                        <label class="me-3">
                            <input type="checkbox" class="position-check" value="block"> Block
                        </label>

                        <label class="me-3">
                            <input type="checkbox" class="position-check" value="top"> Top
                        </label>

                        <label class="me-3">
                            <input type="checkbox" class="position-check" value="left"> Left
                        </label>

                        <label class="me-3">
                            <input type="checkbox" class="position-check" value="right"> Right
                        </label>

                        <label class="me-3">
                            <input type="checkbox" class="position-check" value="bottom"> Bottom
                        </label>

                    </div>
                    <div class="script-wrapper mb-3 d-none">
                        <label class="form-label">Ad Script</label>
                        <textarea name="script" class="form-control" rows="4" placeholder="Paste ad script here"></textarea>
                    </div>
                    <div id="positionImageContainer"></div>

                    <button type="submit" class="btn btn-primary">
                        Save Ad
                    </button>

                </form>

            </div>
        </div>
    </div>


    <div class="col-12 mt-3">

        <div class="card">
            <div class="card-body">

                <?php if (!empty($ads)): ?>

                    <h4 class="card-title">All Ads</h4>

                    <div class="table-responsive">

                        <table id="ads-listing" class="table">

                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Positions</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php $sl = 1; ?>
                                <?php foreach ($ads as $ad): ?>

                                    <tr>

                                        <td><?= $sl++ ?></td>

                                        <td><?= esc($ad['title']) ?></td>

                                        <td><?= ucfirst($ad['ad_type']) ?></td>

                                        <td>


                                            <span class="badge bg-secondary">
                                                <?= ucfirst($ad['position'] ?? 'N/A') ?>
                                            </span>

                                        </td>

                                        <td data-order="<?= $ad['status'] ?>">

                                            <label class="toggle-switch mb-0">

                                                <input type="checkbox"
                                                    class="toggle-status"
                                                    data-id="<?= $ad['id'] ?>"
                                                    <?= $ad['status'] ? 'checked' : '' ?>>

                                                <span class="slider"></span>

                                            </label>

                                        </td>

                                        <td>

                                            <div class="dropdown">

                                                <button class="btn btn-success btn-sm dropdown-toggle"
                                                    data-bs-toggle="dropdown">

                                                    Modify

                                                </button>

                                                <div class="dropdown-menu">

                                                    <button class="dropdown-item editBtn"
                                                        data-id="<?= $ad['id'] ?>">

                                                        Edit

                                                    </button>

                                                    <button class="dropdown-item deletebtn"
                                                        data-id="<?= $ad['id'] ?>">

                                                        Delete

                                                    </button>

                                                </div>

                                            </div>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            </tbody>

                        </table>

                    </div>

                <?php else: ?>

                    <div class="alert alert-warning">
                        Ads are empty!
                    </div>

                <?php endif; ?>

            </div>
        </div>

    </div>

</div>


<?= $this->include('admin/Components/Modals/AdsEditModal.php'); ?>

<?= $this->endSection() ?>



<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="<?= base_url() ?>assets/vendors/dropify/dist/js/dropify.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/select2/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $this->endSection() ?>



<?= $this->section('script') ?>

<script>
    $(document).ready(function() {

        $('#ads-listing').DataTable();

        $('.select-type').select2({
            theme: 'bootstrap',
            minimumResultsForSearch: Infinity
        });

        const positionSizes = {
            block: "500x500",
            top: "1100x180",
            left: "180x1100",
            right: "180x1100",
            bottom: "1100x180"
        };


        function toggleAdType(type) {

            if (type === "script") {

                $('.script-wrapper').removeClass('d-none');
                $('#positionImageContainer').html('');
                $('.position-wrapper').addClass('d-none');

            } else {

                $('.script-wrapper').addClass('d-none');
                $('.position-wrapper').removeClass('d-none');

            }

        }


        toggleAdType($('#ad_type').val());


        $('#ad_type').on('change', function() {
            toggleAdType($(this).val());
        });



        $(document).on('change', '.position-check', function() {

            let pos = $(this).val();
            let container = $("#positionImageContainer");

            if ($(this).is(':checked')) {

                let size = positionSizes[pos];

                let html = `

                    <div class="card mb-1 position-image border-bottom-1" data-pos="${pos}">
                        <div class="card-body">
                            <label class="form-label">
                            Ad Image for ${pos.toUpperCase()} (${size})
                            </label>

                            <input type="file"
                            name="position_images[${pos}]"
                            class="dropify"
                            accept="image/*">

                            <input type="hidden" name="position[]" value="${pos}">
                            <div class="my-3">
                                <label class="form-label">Redirect Url for ${pos.toUpperCase()}</label>
                                <input type="text" name="${pos}_redirect_url" class="form-control">
                            </div>
                        </div>
                    </div>
                    `;

                container.append(html);

                container.find('.dropify').last().dropify();

            } else {

                container.find('[data-pos="' + pos + '"]').remove();

            }

        });

        $('#adForm').on('submit', function(e) {

            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({

                url: "<?= base_url('admin/ads/store') ?>",

                type: "POST",

                data: formData,

                contentType: false,
                processData: false,

                success: function(res) {

                    if (res.success) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        setTimeout(() => location.reload(), 1500);

                    }

                    if (res.errors) {

                        Object.values(res.errors).forEach(msg => {
                            Swal.fire('Error', msg, 'error');
                        });

                    }

                },

                error: function() {
                    Swal.fire('Error', 'Server error', 'error');
                }

            });

        });

        $(document).on('change', '.toggle-status', function() {

            let checkbox = $(this);
            let adId = checkbox.data('id');
            let isChecked = checkbox.is(':checked');

            checkbox.prop('checked', !isChecked);

            Swal.fire({
                title: 'Change Status?',
                icon: 'warning',
                showCancelButton: true
            }).then(result => {

                if (result.isConfirmed) {

                    $.post("<?= base_url('admin/ads/toggle-status') ?>", {
                        id: adId,
                        <?= csrf_token() ?>: "<?= csrf_hash() ?>"
                    }, function(res) {

                        if (res.success) {
                            checkbox.prop('checked', isChecked);
                        }

                    });

                }

            });

        });

        $(document).on('click', '.deletebtn', function() {

            let adId = $(this).data('id');
            let row = $(this).closest('tr');

            Swal.fire({
                title: 'Delete Ad?',
                icon: 'warning',
                showCancelButton: true
            }).then(result => {

                if (result.isConfirmed) {

                    $.post("<?= base_url('admin/ads/delete') ?>", {
                        id: adId,
                        <?= csrf_token() ?>: "<?= csrf_hash() ?>"
                    }, function(res) {

                        if (res.success) {
                            row.remove();
                        }

                    });

                }

            });

        });

        $(document).on("click", ".editBtn", function() {

            let id = $(this).data("id");

            $.get("<?= base_url('admin/ads') ?>/" + id, function(res) {

                if (!res.success) return;
                console.log(res);

                let ad = res.data;

                $("#editAdId").val(ad.id);

                $("#editAdForm [name=title]").val(ad.title);
                if (ad.ad_type == "image") {

                }
                $("#editAdForm [name=edit-ad-type]").val(ad.ad_type).trigger("change");


                // reset
                $("#editPositionImages").html("");
                $(".edit-position-check").prop("checked", false);


                // pages
                if (ad.pages) {
                    const pages = JSON.parse(ad.pages);
                    pages.forEach(page => {
                        $("#editAdForm input[name='pages[]'][value='" + page + "']").prop("checked", true);
                    });
                }


                // positions
                if (ad.position) {

                    $(".edit-position-check[value='" + ad.position + "']").prop("checked", true);
                    createEditImageInput(ad.position, ad.image ?? null, ad.url ?? null);
                }


                // script
                if (ad.script) {
                    $("#editAdForm textarea[name=script]").val(ad.script);
                }

                $("#editAdsModal").modal("show");

            });

        });

        function createEditImageInput(pos, existing = null, url) {

            let html = `
                <div class="mb-3 edit-pos-image" data-pos="${pos}">

                <label class="form-label">
                Image for ${pos.toUpperCase()} (${positionSizes[pos]})
                </label>

                <input type="file"
                name="position_images[${pos}]"
                class="dropify"
                data-default-file="${existing ? '<?= base_url('') ?>' + existing : ''}"
                accept="image/*">

                <input type="hidden" name="position[]" value="${pos}">
                    <div class="my-3">
                        <label class="form-label">Redirect Url for ${pos.toUpperCase()}</label>
                        <input type="text" name="${pos}_redirect_url" class="form-control" value="${url??''}">
                    </div>

                </div>
                `;

            $("#editPositionImages").append(html);

            $('.dropify').dropify();

        }
        $(".edit-ad-type").on("change", function() {

            let type = $(this).val();

            if (type == "script") {

                $(".script-wrapper").removeClass("d-none");
                $(".position-wrapper,#editPositionImages").addClass("d-none");

            } else {

                $(".script-wrapper").addClass("d-none");
                $(".position-wrapper").removeClass("d-none");

            }

        });

        $("#editAdForm").submit(function(e) {

            e.preventDefault();

            let id = $("#editAdId").val();

            let formData = new FormData(this);

            $.ajax({

                url: "<?= base_url('admin/ads/update/') ?>" + id,
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,

                success: function(res) {
                    if (res.success) {
                        showSuccessToast(res.message);
                        $("#editAdsModal").modal("hide");
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        showDangerToast(res.message);
                    }

                }

            });

        });
    });
</script>

<?= $this->endSection() ?>