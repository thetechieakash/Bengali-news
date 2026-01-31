<?= $this->extend('layouts\AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4">
        <div class="card" id="addcatcard">
            <div class="card-body">
                <h4 class="card-title">Add catagories</h4>
                <!-- <p class="card-description">
                    Basic form layout
                </p> -->
                <form class="forms-sample" id="catform" action="<?= base_url('admin/catagories') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" name="category" id="category" placeholder="Category Name">
                    </div>
                    <div class="form-group">
                        <div class="d-flex align-items-center gap-2">
                            <label class="toggle-switch mb-0">
                                <input type="checkbox" name="status">
                                <span class="slider"></span>
                            </label>
                            <span>In navbar?</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-white me-2">Submit</button>
                </form>

            </div>
        </div>
        <div class="card d-none" id="addsubcatcard">
            <div class="card-body">
                <h4 class="card-title">Add Sub Catagories</h4>
                <!-- <p class="card-description">
                    Basic form layout
                </p> -->
                <form class="forms-sample" id="catform" action="<?= base_url('admin/sub-catagories') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" name="category" id="category" placeholder="Category Name">
                    </div>
                    <div class="form-group">
                        <div class="d-flex align-items-center gap-2">
                            <label class="toggle-switch mb-0">
                                <input type="checkbox" name="status">
                                <span class="slider"></span>
                            </label>
                            <span>In navbar?</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-white me-2">Submit</button>
                </form>

            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <?php if (!empty($cats)): ?>
                    <h4 class="card-title">All Catagories</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="cat-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th>SL #</th>
                                            <th>Category name</th>
                                            <th>Active in Navbar</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sl = 0; ?>
                                        <?php foreach ($cats as $cat): ?>
                                            <?php $sl++; ?>
                                            <tr>
                                                <td class="serial-no"><?= $sl ?>.</td>
                                                <td><?= $cat['cat'] ?></td>
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
                                                                data-name="<?= $cat['cat'] ?>"
                                                                data-slug="<?= $cat['slug'] ?>"
                                                                data-status="<?= $cat['status'] ?>"
                                                                data-navbar="<?= $cat['is_active'] ?>">Edit</button>
                                                            <button class="dropdown-item deletebtn" data-id="<?= $cat['id'] ?>">Delete</button>

                                                            <div class="dropdown-divider"></div>
                                                            <button class="dropdown-item addSubCat"
                                                                data-id="<?= $cat['id'] ?>"
                                                                data-name="<?= $cat['cat'] ?>"
                                                                data-slug="<?= $cat['slug'] ?>">Add Sub Category</button>
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
<?= $this->include('admin/Components/Modals/CatEditModal.php'); ?>
<!-- Page modals ends  -->

<?= $this->endSection() ?>

<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Page js start -->
<?= $this->include('admin/Js/Catagories.js.php'); ?>
<!-- Page js ends  -->

<?= $this->endSection() ?>