<?= $this->extend('layouts\AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>

<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php $permissions = [
    'User' => [
        'user.manage' => 'user manage',
        'user.create' => 'user create',
        'user.update' => 'user update',
        'user.delete' => 'user delete',
    ],
    'Category' => [
        'category.manage' => 'category manage',
        'category.create' => 'category create',
        'category.update' => 'category update',
        'category.delete' => 'category delete',
    ],
    'Tags' => [
        'tags.manage' => 'tags manage',
        'tags.create' => 'tags create',
        'tags.update' => 'tags update',
        'tags.delete' => 'tags delete',
    ],
    'News' => [
        'news.manage' => 'news manage',
        'news.create' => 'news create',
        'news.update' => 'news update',
        'news.delete' => 'news delete',
    ],
    'Comments' => [
        'comments.manage' => 'comments manage',
        'comments.create' => 'comments create',
        'comments.update' => 'comments update',
        'comments.delete' => 'comments delete',
    ],
    'Ads' => [
        'ads.manage' => 'ads manage',
        'ads.create' => 'ads create',
        'ads.update' => 'ads update',
        'ads.delete' => 'ads delete',
    ],
] ?>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Assign Roles</h4>
                <form>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="form-check">
                                    <label class="form-check-label" title="Complete control of the site">
                                        <input type="checkbox" class="form-check-input">
                                        Super admin
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" title="Day to day administrators of the site">
                                        <!-- checked -->
                                        <input type="checkbox" class="form-check-input">
                                        Admin
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" title="Site programmers">
                                        <!-- checked -->
                                        <input type="checkbox" class="form-check-input">
                                        Developer
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label" title="General users of the site">
                                        <!-- checked -->
                                        <input type="checkbox" class="form-check-input">
                                        User
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Assign Permissions</h4>
                <form>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="row">
                                    <?php foreach ($permissions as $title => $permission): ?>
                                        <div class="col-md-3">
                                            <p class="card-description"><?= $title ?></p>
                                            <?php foreach ($permission as $key => $val): ?>
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="<?= $key ?>">
                                                        <?= $val ?>
                                                    </label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<?= $this->endSection() ?>

<?= $this->section('script') ?>

<?= $this->endSection() ?>