<?= $this->extend('layouts/AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/select2/select2.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card" id="addcatcard">
            <div class="card-body">
                <h4 class="card-title">Add child catagories</h4>
                <form class="forms-sample" id="childCatform" action="<?= base_url('admin/child-categories') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Category</label>
                                <select class="form-control select2" id="category_id" name="category_id">
                                    <option value="">Select Category</option>
                                    <?php foreach ($allCats as $cat): ?>
                                        <option value="<?= $cat['id'] ?>">
                                            <?= esc($cat['cat']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Sub Category</label>
                                <select class="form-control select2" id="subcategory_id" name="sub_cat_id" disabled>
                                    <option value="">Select Sub Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="child_cat_name">Child Category Name</label>
                                <input type="text" class="form-control" id="child_cat_name" name="child_cat_name" placeholder="Child Category Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="child_cat_slug">Child Category Slug</label>
                                <input type="text" class="form-control" id="child_cat_slug" name="child_cat_slug" placeholder="Sub Category Slug">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-white me-2" id="addChildCatBtn">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-body">
                <?php if (!empty($allChildCats)): ?>
                    <h4 class="card-title">All Catagories</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="child-cat-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th>SL #</th>
                                            <th>Sub Category Name</th>
                                            <th>Child Category Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sl = 0; ?>
                                        <?php foreach ($allChildCats as $childCat): ?>
                                            <?php $sl++; ?>
                                            <tr>
                                                <td><?= $sl ?>.</td>
                                                <td><?= esc($childCat['sub_cat_name']) ?></td>
                                                <td><?= esc($childCat['child_cat_name']) ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Modify
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <button class="dropdown-item editBtn"
                                                                data-id="<?= $childCat['id'] ?>"
                                                                data-category-id="<?= $childCat['category_id'] ?>"
                                                                data-subcat-id="<?= $childCat['sub_cat_id'] ?>"
                                                                data-name="<?= $childCat['child_cat_name'] ?>"
                                                                data-slug="<?= $childCat['child_cat_slug'] ?>">Edit</button>
                                                            <button class="dropdown-item deletebtn" data-id="<?= $childCat['id'] ?>"
                                                                data-cat-id="<?= $childCat['sub_cat_id'] ?>">Delete</button>
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
                        Child Catagories are empty!
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- Page modals start  -->
<?= $this->include('admin/Components/Modals/ChildCatEditModal.php'); ?>
<!-- Page modals ends  -->

<?= $this->endSection() ?>

<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url() ?>assets/vendors/select2/select2.min.js"></script>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Page js start -->
<?= $this->include('admin/Js/ChildCatagories.js.php'); ?>
<!-- Page js ends  -->
<?= $this->endSection() ?>