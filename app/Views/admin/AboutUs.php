<?= $this->extend('layouts/AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row w-100 mx-0">
    <div class="col-md-12 mx-auto">
        <div class="auth-form-light text-left py-4 px-4 px-sm-5">
            <div class="card">
                <div class="card-body">
                    <h4>Add About Us</h4>

                    <form id="pageForm">

                        <?= csrf_field() ?>

                        <input type="hidden" name="page_name" value="<?= $pageName ?>">

                        <div class="form-group">
                            <textarea name="description" id="editor" class="form-control">
                                <?= esc($content['description'] ?? '') ?>
                            </textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Save Page
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/vendors/ckeditor/ckeditor.js"></script>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $(document).ready(function() {

        CKEDITOR.replace('editor', {
            height: '400px'
        });

        $('#pageForm').on('submit', function(e) {
            e.preventDefault();

            let description = CKEDITOR.instances.editor.getData();
            let formData = new FormData(this);
            formData.set('description', description);
            $.ajax({
                url: "<?= base_url('admin/pages/save') ?>",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend: function() {
                    $('.btn-primary').prop('disabled', true).text('Saving...');
                },
                success: function(res) {
                    if (res.success) {
                        showSuccessToast(res.message);
                    } else {
                        showDangerToast(res.message);
                    }
                },
                complete: function() {
                    $('.btn-primary').prop('disabled', false).text('Save Page');
                },
                error(err) {
                    showDangerToast('Server error');
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>