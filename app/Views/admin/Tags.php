<?= $this->extend('layouts/AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-4">
        <div class="card" id="addtagcard">
            <div class="card-body">
                <h4 class="card-title">Add Tags</h4>
                <form class="forms-sample" id="tagform" action="<?= base_url('admin/tag/create') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <input type="text" class="form-control" name="tag" id="tag" placeholder="Tag Name">
                    </div>
                    <button type="submit" class="btn btn-primary text-white me-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <?php if (!empty($tags)): ?>
                    <h4 class="card-title">All Tags</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="tag-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th>SL #</th>
                                            <th>Tag Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sl = 0; ?>
                                        <?php foreach ($tags as $tag): ?>
                                            <?php $sl++; ?>
                                            <tr>
                                                <td><?= $sl ?></td>
                                                <td><?= $tag['name'] ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownAction" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Modify
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownAction">
                                                            <button class="dropdown-item editBtn" data-id="<?= $tag['id'] ?>">Edit</button>
                                                            <button class="dropdown-item deletebtn" data-id="<?= $tag['id'] ?>">Delete</button>
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
                        Tags are empty!
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Page js start -->
<?= $this->include('admin/Js/Tags.js.php'); ?>
<!-- Page js ends  -->

<?= $this->endSection() ?>