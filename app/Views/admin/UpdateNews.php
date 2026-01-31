<?= $this->extend('layouts\AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/select2/select2.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/dropify/dropify.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/jquery-tags-input/jquery.tagsinput.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/flatpickr/flatpickr.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/glightbox/glightbox.min.css" />


<?= $this->endSection() ?>
<?= $this->section('content') ?>
<form method="post" id="newsForm" action="<?= base_url('admin/news/update/' . $post['id']) ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update post</h4>
                    <!-- <p class="card-description">Basic form elements</p> -->
                    <div class="form-group">
                        <label for="headline">Headline</label>
                        <input type="text" class="form-control" id="headline" name="headline" placeholder="Headline" value="<?= esc($post['headline'] ?? '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="shortdesc">Short Description</label>
                        <textarea class="form-control" id="shortdesc" name="shortdescription" rows="4"><?= esc($post['short_description'] ?? '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <?php
                        $tags = array_map(fn($t) => $t['name'], $post['tags'] ?? []);
                        ?>
                        <input class="form-control" name="tags" id="tags" value="<?= esc(implode(',', $tags)) ?>" />
                    </div>
                    <div class="form-group">
                        <label for="date">
                            Post Date <small class="text-muted">(leave empty to publish now)</small>
                        </label>
                        <?php
                        $fpDate = '';

                        if (!empty($post['post_date_time'])) {
                            $dt = new DateTime($post['post_date_time']);
                            $fpDate = $dt->format('d/m/Y H:i');
                        }
                        ?>
                        <input class="form-control datetimepicker" type="text" placeholder="Pick a date" name="date" value="<?= esc($fpDate) ?>" ">
                    </div>
                </div>
            </div>
        </div>
        <div class=" col-md-4">
                        <div class="card mt-3 mt-md-0">
                            <div class="card-body">
                                <h4 class="card-title">Choose Categories<span class="text-danger">*</span></h4>
                                <div class="form-group">
                                    <label>Categories<span class="text-danger">*</span></label>
                                    <?php $selectedCats = $post['categories'] ?? []; ?>
                                    <?php $selectedSubCats = $post['subcategories'] ?? []; ?>
                                    <select class="multiple-select w-100"
                                        multiple
                                        name="categories[]"
                                        id="categories">
                                        <?php foreach ($categories as $cat): ?>
                                            <option value="<?= $cat['id'] ?>"
                                                <?= in_array($cat['id'], $selectedCats) ? 'selected' : '' ?>>
                                                <?= esc($cat['cat']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label>Sub Categories<span class="text-danger">*</span></label>
                                    <select class="multiple-select w-100"
                                        multiple
                                        name="subcategories[]"
                                        id="subcategories">
                                        <?php foreach ($post['subcategories'] as $sub): ?>
                                            <option value="<?= $sub['id'] ?>" selected>
                                                <?= esc($sub['sub_cat_name']) ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-body">
                                <h4 class="mb-2"><?= isset($update) ? 'Update' : 'Add' ?> Thumbnail</h4>

                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio"
                                                    class="form-check-input thumb-type"
                                                    name="thumbnail_type"
                                                    id="thumb_link"
                                                    value="link">
                                                Link
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio"
                                                    class="form-check-input thumb-type"
                                                    name="thumbnail_type"
                                                    id="thumb_image"
                                                    value="image"
                                                    checked>
                                                Image
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- LINK INPUT -->
                                <div id="thumbnail-link-wrapper">
                                    <div class="form-group">
                                        <label for="thumbnail_link">URL</label>
                                        <input type="text"
                                            class="form-control"
                                            id="thumbnail_link"
                                            name="thumbnail_link"
                                            placeholder="https://example.com/image.jpg" value="">
                                    </div>
                                </div>

                                <!-- IMAGE UPLOAD -->
                                <div id="thumbnail-upload-wrapper">
                                    <h4>Drop image</h4>
                                    <input type="file"
                                        class="dropify"
                                        id="thumbnail_image"
                                        name="thumbnail_image"
                                        data-default-file="<?= $post['thumbnail']['thumbnail_url'] ?? '' ?>"
                                        accept="image/*">
                                    <input type="hidden" name="thumbnail_removed" id="thumbnail_removed" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="form-group">
                                    <h4 class="mb-2">Description</h4>
                                    <textarea name="description" id="editor" class="form-control"><?= esc($post['description'] ?? '') ?></textarea>
                                </div>
                                <?php if (isset($update)): ?>
                                    <button type="submit" class="btn btn-primary me-2" id="update">Update</button>
                                    <button class="btn btn-primary me-2" id="publish">Publish</button>
                                    <button class="btn btn-primary me-2" id="preview">Preview</button>
                                <?php else: ?>
                                    <button type="submit" class="btn btn-primary me-2">Save</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page modals start  -->
                <!-- Page modals ends  -->
</form>
<?= $this->endSection() ?>

<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/vendors/jquery-tags-input/jquery.tagsinput.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/select2/select2.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/dropify/dropify.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/flatpickr/flatpickr.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/ckeditor/ckeditor.js""></script>
<script src=" <?= base_url() ?>assets/vendors/glightbox/glightbox.min.js"></script>


<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>assets/js/dropify.js"></script>

<!-- Page js start -->
<?= $this->include('admin/Js/UpdateNews.js.php'); ?>
<!-- Page js ends  -->
<?= $this->endSection() ?>