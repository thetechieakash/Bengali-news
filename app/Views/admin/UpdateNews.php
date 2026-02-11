<?= $this->extend('layouts/AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/select2/select2.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/dropify/dist/css/dropify.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/dropify/dist/css/dropify.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/jquery-tags-input/jquery.tagsinput.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/flatpickr/flatpickr.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/glightbox/glightbox.min.css" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $this->endSection() ?>
<?= $this->section('content') ?>

<form method="post" id="newsForm" action="<?= base_url('admin/news/update/' . $post['id']) ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update post</h4>
                    <div class="form-group">
                        <label for="headline">Headline</label>
                        <input type="text" class="form-control" id="headline" name="headline" placeholder="Headline" value="<?= esc($post['headline'] ?? '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="shortdesc">Short Description</label>
                        <textarea class="form-control" id="shortdesc" name="shortdescription" rows="4" style="min-height: 10rem;"><?= esc($post['short_description'] ?? '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <?php
                        $selectedTagIds = array_column($post['tags'] ?? [], 'id');
                        ?>
                        <select class="form-control"
                            name="tags[]"
                            id="tags"
                            multiple>
                            <?php foreach ($tags as $tag): ?>
                                <option value="<?= $tag['id'] ?>"
                                    <?= in_array($tag['id'], $selectedTagIds, true) ? 'selected' : '' ?>>
                                    <?= esc($tag['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

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
                        <?php
                        $selectedCats    = $post['category_ids'] ?? [];
                        $selectedSubCats = $post['subcategory_ids'] ?? [];
                        ?>
                        <select class="multiple-select w-100"
                            multiple
                            name="categories[]"
                            id="categories">
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"
                                    <?= in_array($cat['id'], $selectedCats, true) ? 'selected' : '' ?>>
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
                    <h4 class="mb-2">Thumbnail</h4>
                    <input type="hidden" name="thumbnail_removed" id="thumbnail_removed" value="0">
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
                    <input type="hidden" name="status" id="post_status" value="<?= $post['status'] ?>">
                    <button type="submit" class="btn btn-primary me-2" id="update">Update</button>
                    <?php if ((int)$post['status'] === 0): ?>
                        <button class="btn btn-success me-2" id="publish">Publish</button>
                    <?php endif; ?>
                    <button class="btn btn-primary me-2" id="preview">Preview</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?= $this->endSection() ?>

<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/vendors/jquery-tags-input/jquery.tagsinput.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/select2/select2.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/dropify/dist/js/dropify.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/flatpickr/flatpickr.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/ckeditor/ckeditor.js"></script>
<script src="<?= base_url() ?>assets/vendors/glightbox/glightbox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>assets/js/dropify.js"></script>

<!-- Page js start -->
<?= $this->include('admin/Js/UpdateNews.js.php'); ?>
<!-- Page js ends  -->
<?= $this->endSection() ?>