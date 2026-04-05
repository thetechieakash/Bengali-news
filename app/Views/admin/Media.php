<?= $this->extend('layouts/AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/dropify/dist/css/dropify.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/dropify/dist/css/dropify.min.css">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Upload Images</h4>
                <form class="forms-sample" id="mediaform" action="<?= base_url('admin/upload-media') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <input type="file"
                            class="dropify"
                            id="media"
                            name="media[]"
                            accept="image/*" multiple>
                    </div>
                    <button type="submit" class="btn btn-primary text-white me-2">Upload</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">All Images</h4>
                    <div class="mb-3">
                        <input type="text"
                            id="mediaSearch"
                            class="form-control"
                            placeholder="Search images...">
                    </div>
                </div>
                <div class="all-media" style="max-height: 500px;overflow-y: auto; overflow-x: hidden;">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page modals start  -->
<div class="modal fade" id="mediaPreviewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Image Preview</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="previewImage"
                    src=""
                    class="img-fluid rounded">
            </div>

        </div>
    </div>
</div>
<!-- Page modals ends  -->

<?= $this->endSection() ?>

<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/vendors/dropify/dist/js/dropify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Page js start -->
<?= $this->include('admin/Js/Media.js.php'); ?>
<!-- Page js ends  -->

<?= $this->endSection() ?>