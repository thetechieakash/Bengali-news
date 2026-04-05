<?= $this->extend('layouts/AdminLayout.php') ?>
<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/dropify/dist/css/dropify.min.css">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <!-- Upload PDF -->
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Upload PDF</h4>
                <form id="documentForm" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <input type="file"
                            class="dropify"
                            id="document"
                            name="document[]"
                            accept="application/pdf"
                            multiple>
                    </div>
                    <button type="submit" class="btn btn-primary text-white me-2">
                        Upload
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- All Documents -->
    <div class="col-12">
        <div class="card mt-3">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="card-title">All Documents</h4>
                    <div class="mb-3">
                        <input type="text" id="docSearch" class="form-control" placeholder="Search documents...">
                    </div>
                </div>
                <div class="all-documents"
                    style="max-height:500px;overflow-y:auto;overflow-x:hidden;">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="pdfPreviewModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PDF Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <iframe id="pdfFrame" src="" width="100%" height="600" style="border:none"></iframe>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/vendors/dropify/dist/js/dropify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<!-- Page js start -->
<?= $this->include('admin/Js/Documents.js.php'); ?>
<!-- Page js ends  -->

<?= $this->endSection() ?>