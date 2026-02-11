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
        <div class="card card-rounded">
            <div class="card-body">
                <h2><?= $totalPosts ?></h2>
                <p>Total Posts</p>
            </div>
        </div>
    </div>

    <div class="col-6 col-sm-3 col-lg-2 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h2><?= $publishedPosts ?></h2>
                <p>Published Posts</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-3 col-lg-2 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h2><?= $draftPosts ?> ms</h2>
                <p>Draft Posts</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-3 col-lg-2 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h2><?= $totalComments ?> ms</h2>
                <p>Total Comments</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-3 col-lg-2 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h2><?= $pendingComments ?></h2>
                <p>Pending Comments</p>
            </div>
        </div>
    </div>

    <div class="col-6 col-sm-3 col-lg-2 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h2><?= $queryTime ?> ms</h2>
                <p>DB Query Time</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-3 col-lg-2 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h2><?= $totalCategories ?></h2>
                <p>Total Categories</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-3 col-lg-2 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h2><?= $totalSubCats ?></h2>
                <p>Total SubCats</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-3 col-lg-2 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h2><?= $totalTags ?></h2>
                <p>Total Tags</p>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>
<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/js/dashboard-analytics.js"></script>
<?= $this->endSection() ?>