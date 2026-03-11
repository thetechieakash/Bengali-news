<?= $this->extend('layouts/AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-body">
        <h2 class="mb-4">Set User Permission</h2>
        <form id="permissionForm">
            <?= csrf_field() ?>
            <div class="row">
                <?php foreach ($modules as $module => $actions): ?>
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-capitalize mb-3">
                                    <?= str_replace('_', ' ', $module) ?>
                                </h5>
                                <?php foreach ($actions as $action):
                                    $permission = $module . '.' . $action;
                                ?>
                                    <div class="form-check">
                                        <label class="form-check-label" for="<?= $module . $action ?>">
                                            <input
                                                type="checkbox"
                                                class="form-check-input"
                                                name="permissions[]"
                                                id="<?= $module . $action ?>"
                                                value="<?= $permission ?>"
                                                <?= in_array($permission, $userPermissions) ? 'checked' : '' ?>>
                                            <?= ucfirst($action) ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type="submit" class="btn btn-primary mt-3">
                Save Permissions
            </button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('jsLib') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {

        $('#permissionForm').submit(function(e) {
            e.preventDefault();
            let form = $(this);
            let formData = form.serialize();
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to update this user permissions?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('admin/user/permission/' . $userId) ?>",
                        type: "POST",
                        data: formData,
                        dataType: "json",
                        success: function(res) {
                            if (res.status === 'success') {
                                showSuccessToast(res.message);
                                setTimeout(() => {
                                    window.location.href = `<?= base_url('admin/all-users') ?>`;
                                }, 800);
                            } else {
                                showDangerToast(res.message);
                            }
                        },

                        error: function(err) {
                            showDangerToast('Something went wrong');
                            console.error("Permission error", err);
                        }
                    });
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>