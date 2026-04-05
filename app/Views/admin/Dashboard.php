<?= $this->extend('layouts/AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-6 col-sm-4 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h2><?= $totalPosts ?></h2>
                <p>Total News</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-4 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h2><?= $postedBy ?></h2>
                <p>News Posted by You</p>
            </div>
        </div>
    </div>

    <div class="col-6 col-sm-2 grid-margin stretch-card">
        <a class="card card-rounded text-decoration-none" href="<?= base_url('admin/published-news') ?>">
            <div class="card-body">
                <h2><?= $publishedPosts ?></h2>
                <p>Published News</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-sm-2 grid-margin stretch-card">
        <a class="card card-rounded text-decoration-none" href="<?= base_url('admin/draft-news') ?>">
            <div class="card-body">
                <h2><?= $draftPosts ?></h2>
                <p>Draft News</p>
            </div>
        </a>
    </div>
    <!-- </div>
<div class="row"> -->
    <div class="col-6 col-sm-4 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h2><?= $totalComments ?></h2>
                <p>Total Comments</p>
            </div>
        </div>
    </div>
    <div class="col-6 col-sm-4 grid-margin stretch-card">
        <a class="card card-rounded text-decoration-none" href="<?= base_url('admin/approved-comments') ?>">
            <div class="card-body">
                <h2><?= $publishedComments ?></h2>
                <p>Approved Comments</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-sm-4 grid-margin stretch-card">
        <a class="card card-rounded text-decoration-none" href="<?= base_url('admin/pending-comments') ?>">
            <div class="card-body">
                <h2><?= $pendingComments ?></h2>
                <p>Pending Comments</p>
            </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-6 col-sm-3 grid-margin stretch-card">
        <a class="card card-rounded text-decoration-none" href="<?= base_url('admin/categories') ?>">
            <div class="card-body">
                <h2><?= $totalCategories ?></h2>
                <p>Total Categories</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-sm-3 grid-margin stretch-card">
        <a class="card card-rounded text-decoration-none" href="<?= base_url('admin/sub-categories') ?>">
            <div class="card-body">
                <h2><?= $totalSubCats ?></h2>
                <p>Total Sub Categories</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-sm-3 grid-margin stretch-card">
        <a class="card card-rounded text-decoration-none" href="<?= base_url('admin/child-categories') ?>">
            <div class="card-body">
                <h2><?= $totalChildCats ?></h2>
                <p>Total Child Categories</p>
            </div>
        </a>
    </div>
    <div class="col-6 col-sm-3 grid-margin stretch-card">
        <a class="card card-rounded text-decoration-none" href="<?= base_url('admin/tags') ?>">
            <div class="card-body">
                <h2><?= $totalTags ?></h2>
                <p>Total Tags</p>
            </div>
        </a>
    </div>
</div>
<div class="row">
    <div class="col-6 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h2>{elapsed_time} seconds</h2>
                <p>Page rendered</p>
            </div>
        </div>
    </div>
    <div class="col-6 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <h2>{memory_usage} MB</h2>
                <p>Memory Usage</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Website Visits</h4>
                <small>Total : <b><?= $totalVisits ?></b></small>
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/vendors/chart.js/chart.umd.js"></script>
<script src="<?= base_url() ?>assets/js/dashboard-analytics.js"></script>
<script>
    const visitData = <?= json_encode($visits); ?>;

    const labels = visitData.map(item => item.visit_date);
    const totals = visitData.map(item => item.total);

    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Daily Website Visits',
                data: totals,
                borderColor: 'blue',
                fill: false,
                tension: 0.1
            }]
        }
    });
</script>
<?= $this->endSection() ?>