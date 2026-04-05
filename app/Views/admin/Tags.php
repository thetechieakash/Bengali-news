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
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Tag</h4>
                <form id="tagForm">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="tagName">Tag Name</label>
                        <input type="text" class="form-control" id="tagName"
                            placeholder="e.g. দেশ or Politics" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Tag</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">All Tags</h4>
                <div class="table-responsive">
                    <table id="tag-listing" class="table">
                        <thead>
                            <tr>
                                <th>SL #</th>
                                <th>Tag Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
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