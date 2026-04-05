<?= $this->extend('layouts/AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>

<?= $this->section('plugin') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-body">

        <div class="mb-3 d-flex gap-2">
            <a href="<?= base_url('admin/create-news') ?>" class="btn btn-danger btn-icon-text"><i class="ti-upload btn-icon-prepend"></i> Create news</a>

            <?php if ($status == 1): ?>
                <a href="<?= base_url('admin/draft-news') ?>" class="btn btn-warning">Draft news</a>
            <?php else: ?>
                <a href="<?= base_url('admin/published-news') ?>" class="btn btn-secondary">Published news</a>
            <?php endif; ?>
        </div>

        <div class="table-responsive">
            <table id="news-listing" class="table">
                <thead>
                    <tr>
                        <th>SL #</th>
                        <th>Post</th>
                        <?php if ($isSuperAdmin): ?>
                            <th>Author</th>
                        <?php endif; ?>
                        <th>Comments</th>
                        <th>Post Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
</div>

<?= $this->include('admin/Components/Modals/CommentModal.php'); ?>

<?= $this->endSection() ?>

<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Page js start -->
<?= $this->include('admin/Js/NewsList.js.php'); ?>
<!-- Page js ends  -->
<?= $this->endSection() ?>