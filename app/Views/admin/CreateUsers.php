<?= $this->extend('layouts/AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row w-100 mx-0">
    <div class="col-md-8 mx-auto">
        <div class="auth-form-light text-left py-4 px-4 px-sm-5">
            <div class="card">
                <div class="card-body">
                    <h4>Add User</h4>

                    <form class="pt-3" id="createUser">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" name="username"
                                placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-lg" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <select class="form-select form-select-lg" name="role" placeholder="Email" placeholder="Select role">
                                <option selected>Select Role</option>
                                <option value="superadmin">Super Admin</option>
                                <option value="admin">Admin</option>
                                <option value="author">Author</option>
                                <option value="user">user</option>
                            </select>
                        </div>
                        <div class="form-group position-relative">
                            <input type="password"
                                class="form-control form-control-lg pr-5"
                                id="password"
                                name="password"
                                placeholder="Password">

                            <span class="password-toggle" id="togglePassword">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                        <div class="mt-3 d-grid gap-2">
                            <button class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('jsLib') ?>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Page js start -->
<?= $this->include('admin/Js/CreateUsers.js.php'); ?>
<!-- Page js ends  -->

<?= $this->endSection() ?>