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
                    <h4>Add Privacy & Policy</h4>
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
<!-- Page js start -->
<?= $this->include('admin/Js/PrivacyPolicy.js.php'); ?>
<!-- Page js ends  -->
<?= $this->endSection() ?>