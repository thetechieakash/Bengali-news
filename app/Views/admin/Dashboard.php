<?= $this->extend('layouts/AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-6 col-sm-3 col-lg-2 grid-margin stretch-card">
        <a class="card card-rounded text-decoration-none" href="<?= base_url('admin/all-news') ?>">
            <div class="card-body">
                <h2><?= $totalPosts ?></h2>
                <p>Total Posts</p>
            </div>
        </a>
    </div>

    <div class="col-6 col-sm-3 col-lg-2 grid-margin stretch-card">
        <a class="card card-rounded text-decoration-none" href="<?= base_url('admin/all-news?sort=published') ?>">
            <div class="card-body">
                <h2><?= $publishedPosts ?></h2>
                <p>Published Posts</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-sm-3 col-lg-2 grid-margin stretch-card">
        <a class="card card-rounded text-decoration-none" href="<?= base_url('admin/all-news?sort=draft') ?>">
            <div class="card-body">
                <h2><?= $draftPosts ?></h2>
                <p>Draft Posts</p>
            </div>
        </a>
    </div>
    <!-- </div>
<div class="row"> -->
    <div class="col-6 col-sm-3 col-lg-2 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h2><?= $totalComments ?></h2>
                <p>Total Comments</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-3 col-lg-2 grid-margin stretch-card">
        <a class="card card-rounded text-decoration-none" href="<?= base_url('admin/pending-comments') ?>">
            <div class="card-body">
                <h2><?= $publishedComments ?></h2>
                <p>Published Comments</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-sm-3 col-lg-2 grid-margin stretch-card">
        <a class="card card-rounded text-decoration-none" href="<?= base_url('admin/pending-comments') ?>">
            <div class="card-body">
                <h2><?= $pendingComments ?></h2>
                <p>Pending Comments</p>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-6 col-sm-3 col-lg-2 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h2><?= $totalCategories ?></h2>
                <p>Total Categories</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-3 col-lg-2 grid-margin stretch-card">
        <a class="card card-rounded text-decoration-none" href="<?= base_url('admin/sub-categories') ?>">
            <div class="card-body">
                <h2><?= $totalSubCats ?></h2>
                <p>Total Sub Categories</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-sm-3 col-lg-2 grid-margin stretch-card">
        <a class="card card-rounded text-decoration-none" href="<?= base_url('admin/tags') ?>">
            <div class="card-body">
                <h2><?= $totalTags ?></h2>
                <p>Total Tags</p>
            </div>
        </a>
    </div>
</div>


<?= $this->endSection() ?>
<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/js/dashboard-analytics.js"></script>
<?= $this->endSection() ?>