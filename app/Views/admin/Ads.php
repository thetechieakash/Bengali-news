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
<?= $this->endSection() ?>

<?= $this->section('script') ?>

<!-- Page js start -->
<?= $this->include('admin/Js/Ads.js.php'); ?>
<!-- Page js ends  -->

<?= $this->endSection() ?>