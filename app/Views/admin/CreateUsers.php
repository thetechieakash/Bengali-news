<?= $this->extend('layouts\AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row w-100 mx-0">
    <div class="col-md-6 mx-auto">
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
                            <input type="password" class="form-control form-control-lg" name="password" placeholder="Password">
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
<script>
    $(document).ready(function() {
        $("#createUser").submit(function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const btn = $(this).find('button[type="submit"]').prop('disabled', true);

            $.ajax({
                url: "<?= base_url('admin/users/create') ?>",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success(res) {
                    if (res.success) {
                        showSuccessToast(res.message);
                        $("#createUser")[0].reset();
                        console.log(res);

                        setTimeout(() => window.location.href = res.redirect, 1000);
                    } else {
                        if (res.errors) {
                            Object.values(res.errors).forEach(err => {
                                showDangerToast(err);
                            });
                        } else {
                            showDangerToast(res.message);
                        }
                    }
                },
                error(e) {
                    showDangerToast('Something went wrong');
                    console.log("User create ajax error", e);
                    
                },
                complete() {
                    btn.prop('disabled', false);
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>