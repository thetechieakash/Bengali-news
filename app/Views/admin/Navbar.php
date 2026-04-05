<?= $this->extend('layouts/AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>

<?= $this->section('plugin') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card mt-3">
    <div class="card-body">

        <h4 class="mb-3">Drag & Sort Navbar Categories</h4>

        <!-- CSRF -->
        <input type="hidden" id="csrf_name" value="<?= csrf_token() ?>">
        <input type="hidden" id="csrf_hash" value="<?= csrf_hash() ?>">

        <ul id="sortableList" class="list-group">
            <?php foreach ($navbar as $item): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center"
                    data-id="<?= $item['id'] ?>">

                    <span>
                        <i class="fa fa-bars me-2 handle" style="cursor: move;"></i>
                        <?= esc($item['cat']) ?>
                    </span>

                    <span class="badge bg-primary"><?= esc($item['slug']) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>

        <button id="saveOrder" class="btn btn-success mt-3">
            Save Order
        </button>

    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('jsLib') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url() ?>assets/vendors/sortablejs/sortable.min.js"></script>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Page js start -->
<?= $this->include('admin/Js/Navbar.js.php'); ?>
<!-- Page js ends  -->
<?= $this->endSection() ?>