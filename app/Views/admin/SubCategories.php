<?= $this->extend('layouts\AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php if (!empty($subCats)): ?>
                    <h4 class="card-title">All Catagories</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="sub-cat-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th>SL #</th>
                                            <th>Category Name</th>
                                            <th>Sub Category Name</th>
                                            <th>Active in Navbar</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sl = 0; ?>
                                        <?php foreach ($subCats as $cat): ?>
                                            <?php $sl++; ?>
                                            <tr>
                                                <td><?= $sl ?></td>
                                                <td><?= $cat['category_name'] ?></td>
                                                <td><?= $cat['sub_cat_name'] ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <label class="toggle-switch mb-0">
                                                            <input type="checkbox" name="is_active"
                                                                class="toggle-is-active"
                                                                data-id="<?= $cat['id'] ?>"
                                                                <?= $cat['is_active'] == 1 ? 'checked' : '' ?>>
                                                            <span class="slider"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <label class="toggle-switch mb-0">
                                                            <input type="checkbox" name="activestatus"
                                                                class="toggle-status"
                                                                data-id="<?= $cat['id'] ?>"
                                                                <?= $cat['status'] == 1 ? 'checked' : '' ?>>
                                                            <span class="slider"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownAction" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Modify
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownAction">
                                                            <button class="dropdown-item editBtn" data-id="<?= $cat['id'] ?>"
                                                                data-cat-id="<?= $cat['cat_id'] ?>"
                                                                data-name="<?= $cat['sub_cat_name'] ?>"
                                                                data-status="<?= $cat['status'] ?>"
                                                                data-navbar="<?= $cat['is_active'] ?>">Edit</button>
                                                            <button class="dropdown-item deletebtn" data-id="<?= $cat['id'] ?>"
                                                                data-cat-id="<?= $cat['cat_id'] ?>">Delete</button>
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
                        Catagories are empty!
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- Page modals start  -->
<?= $this->include('admin/Components/Modals/SubCatEditModal.php'); ?>
<!-- Page modals ends  -->

<?= $this->endSection() ?>

<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Page js start -->
<?= $this->include('admin/Js/SubCatagories.js.php'); ?>
<!-- Page js ends  -->
<script>
    $(document).ready(function() {
        $('#sub-cat-listing').DataTable();
    });
</script>

<?= $this->endSection() ?>