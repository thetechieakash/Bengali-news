<?= $this->extend('layouts/AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/dropify/dist/css/dropify.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/dropify/dist/css/dropify.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/glightbox/glightbox.min.css" />
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/ckeditor5/ckeditor5/ckeditor5.css" />
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
                        <input type="text" class="form-control" id="headline" name="headline"
                            placeholder="Headline" value="<?= esc($post['headline']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug"
                            placeholder="Slug" value="<?= esc($post['slug']) ?>" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="subauthor">Guest Author</label>
                        <select id="subauthor" name="subauthor">
                            <option value=""></option>
                            <?php foreach ($subAuthor as $author): ?>
                                <option value="<?= $author['id'] ?>"
                                    data-image="<?= !empty($author['profile_image']) ? base_url($author['profile_image']) : 'https://placehold.co/50x50' ?>"
                                    <?= $post['sub_author_id'] == $author['id'] ? 'selected' : '' ?>>
                                    <?= esc($author['name']) ?> (<?= esc($author['email']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="shortdesc">Short Description</label>
                        <textarea class="form-control" id="shortdesc" name="shortdescription"
                            rows="4" style="min-height:10rem;"><?= esc($post['short_description'] ?? '') ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <?php $selectedTagIds = array_column($post['tags'] ?? [], 'id'); ?>
                        <select name="tags[]" id="tags" multiple>
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

        <?php
        $selectedCats      = $post['category_ids'] ?? [];
        $selectedSubCats   = $post['subcategory_ids'] ?? [];
        $selectedChildCats = $post['childcategory_ids'] ?? [];
        ?>
        <div class="col-md-4">
            <div class="card mt-3 mt-md-0">
                <div class="card-body">
                    <h4 class="card-title">Choose Categories <span class="text-danger">*</span></h4>

                    <div class="form-group">
                        <label>Categories <span class="text-danger">*</span></label>
                        <select class="w-100" multiple name="categories[]" id="categories">
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"
                                    <?= in_array($cat['id'], $selectedCats, true) ? 'selected' : '' ?>>
                                    <?= esc($cat['cat']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Sub Categories <span class="text-danger">*</span></label>
                        <select class="w-100" multiple name="subcategories[]" id="subcategories">
                            <?php foreach ($post['subcategories'] as $sub): ?>
                                <option value="<?= $sub['id'] ?>" selected>
                                    <?= esc($sub['sub_cat_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Child Categories</label>
                        <select class="w-100" multiple name="childcategories[]" id="childcategories">
                            <?php foreach ($post['childcategories'] as $child): ?>
                                <option value="<?= $child['id'] ?>" selected>
                                    <?= esc($child['child_cat_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $thumbnail = $post['thumbnail'] ?? null;
        $thumbType = $thumbnail['type'] ?? 'image';
        $thumbUrl  = $thumbnail['thumbnail_url'] ?? '';
        $thumbFullUrl = (!empty($thumbUrl)) ? base_url($thumbUrl) : '';
        ?>
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-body">
                    <h4 class="mb-2">Thumbnail</h4>
                    <input type="hidden" name="thumbnail_removed" id="thumbnail_removed" value="0">

                    <div class="form-group row">
                        <div class="col-sm-4">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input thumb-type"
                                        name="thumbnail_type" value="link"
                                        <?= $thumbType === 'link' ? 'checked' : '' ?>> Link
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input thumb-type"
                                        name="thumbnail_type" value="image"
                                        <?= $thumbType === 'image' ? 'checked' : '' ?>> Image
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input thumb-type"
                                        name="thumbnail_type" value="media"
                                        <?= $thumbType === 'media' ? 'checked' : '' ?>> Gallery
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="thumbnail-link-wrapper">
                        <div class="form-group">
                            <label for="thumbnail_link">URL</label>
                            <input type="text" class="form-control" id="thumbnail_link"
                                name="thumbnail_link" placeholder="https://example.com/image.jpg"
                                value="<?= $thumbType === 'link' ? esc(($thumbUrl)) : '' ?>">
                        </div>
                    </div>

                    <div id="thumbnail-upload-wrapper">
                        <h4>Drop image</h4>
                        <p class="text-muted mb-3">Max upload size: <?= ini_get('upload_max_filesize'); ?></p>
                        <input type="file" class="dropify" id="thumbnail_image"
                            name="thumbnail_image"
                            data-default-file="<?= $thumbType === 'image' ? esc($thumbFullUrl) : '' ?>"
                            accept="image/*">
                    </div>

                    <div id="thumbnail-media-wrapper">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h4 class="mb-0">Choose media</h4>
                            <input type="text" id="mediaSearch" class="form-control w-auto"
                                placeholder="Search media...">
                        </div>
                        <div id="media-container"
                            style="max-height:500px; overflow-y:auto; overflow-x:hidden;"></div>
                    </div>

                    <div id="previewImage" style="display:none; padding:15px; text-align:center;"></div>
                </div>
            </div>
        </div>

        <input type="hidden" name="selected_media" id="selected_media"
            value="<?= $thumbType === 'media' ? esc($thumbUrl) : '' ?>">

        <div class="col-12">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="form-group">
                        <h4 class="mb-2">Description</h4>
                        <div id="editor"><?= $post['description'] ?? '' ?></div>
                        <textarea name="description" id="editorOutput" style="display:none;"></textarea>
                    </div>

                    <input type="hidden" name="status" id="post_status" value="<?= $post['status'] ?>">
                    <div class="mt-3">
                        <button type="button" class="btn btn-primary me-2" id="update">Update</button>
                        <?php if ((int)$post['status'] === 0): ?>
                            <button type="button" class="btn btn-success me-2" id="publish">Publish</button>
                        <?php endif; ?>
                        <button type="button" class="btn btn-secondary me-2" id="preview">Preview</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
<?= $this->endSection() ?>

<?= $this->section('jsLib') ?>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/dropify/dist/js/dropify.min.js"></script>
<script src="<?= base_url() ?>assets/vendors/glightbox/glightbox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?= base_url() ?>assets/js/dropify.js"></script>
<script type="importmap">
    {
    "imports": {
        "ckeditor5": "<?= base_url() ?>assets/vendors/ckeditor5/ckeditor5/ckeditor5.js",
        "ckeditor5/": "<?= base_url() ?>assets/vendors/ckeditor5/ckeditor5/"
    }
}
</script>
<script type="module">
    import {
        ClassicEditor,
        Essentials,
        AutoLink,
        Autoformat,
        BlockQuote,
        Bold,
        Code,
        CodeBlock,
        Alignment,
        FindAndReplace,
        Font,
        GeneralHtmlSupport,
        Heading,
        Highlight,
        HorizontalLine,
        HtmlEmbed,
        Image,
        ImageCaption,
        ImageInsert,
        ImageResize,
        ImageStyle,
        ImageToolbar,
        Indent,
        IndentBlock,
        Italic,
        Link,
        LinkImage,
        List,
        ListProperties,
        MediaEmbed,
        PageBreak,
        Paragraph,
        PasteFromOffice,
        RemoveFormat,
        SourceEditing,
        SpecialCharacters,
        SpecialCharactersEssentials,
        Strikethrough,
        Subscript,
        Superscript,
        Table,
        TableCaption,
        TableCellProperties,
        TableColumnResize,
        TableProperties,
        TableToolbar,
        TextTransformation,
        TodoList,
        Underline,
    } from 'ckeditor5';

    ClassicEditor.create(document.querySelector('#editor'), {
            licenseKey: 'GPL',
            plugins: [
                Essentials, AutoLink, Autoformat, BlockQuote, Bold, Code, CodeBlock,
                Alignment, FindAndReplace, Font, GeneralHtmlSupport, Heading,
                Highlight, HorizontalLine, HtmlEmbed, Image, ImageCaption,
                ImageInsert, ImageResize, ImageStyle, ImageToolbar, Indent,
                IndentBlock, Italic, Link, LinkImage, List, ListProperties,
                MediaEmbed, PageBreak, Paragraph, PasteFromOffice, RemoveFormat,
                SourceEditing, SpecialCharacters, SpecialCharactersEssentials,
                Strikethrough, Subscript, Superscript, Table, TableCaption,
                TableCellProperties, TableColumnResize, TableProperties, TableToolbar,
                TextTransformation, TodoList, Underline,
            ],
            toolbar: {
                items: [
                    'undo', 'redo', '|',
                    'findAndReplace', 'sourceEditing', '|',
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough',
                    'subscript', 'superscript', 'code', 'removeFormat', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'bulletedList', 'numberedList', 'todoList', 'indent', 'outdent', '|',
                    'link', 'insertImage', 'mediaEmbed', 'insertTable',
                    'blockQuote', 'codeBlock', 'htmlEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak',
                ],
                shouldNotGroupWhenFull: true,
            },
            htmlSupport: {
                allow: [{
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }]
            },
            image: {
                toolbar: [
                    'imageStyle:inline', 'imageStyle:wrapText',
                    'imageStyle:breakText', '|',
                    'toggleImageCaption', 'imageTextAlternative', '|', 'resizeImage'
                ],
                resizeOptions: [{
                        name: 'resizeImage:original',
                        value: null,
                        label: 'Original'
                    },
                    {
                        name: 'resizeImage:25',
                        value: '25',
                        label: '25%'
                    },
                    {
                        name: 'resizeImage:50',
                        value: '50',
                        label: '50%'
                    },
                    {
                        name: 'resizeImage:75',
                        value: '75',
                        label: '75%'
                    },
                ],
            },
            table: {
                contentToolbar: [
                    'tableColumn', 'tableRow', 'mergeTableCells',
                    'tableProperties', 'tableCellProperties', 'toggleTableCaption'
                ]
            },
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            link: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
            },
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                ]
            },
        })
        .then(editor => {
            window.ckEditorInstance = editor; //  expose for jQuery submit handler
        })
        .catch(error => {
            console.error('CKEditor5 init error:', error);
        });
</script>
<!-- Page js start -->
<?= $this->include('admin/Js/UpdateNews.js.php'); ?>
<!-- Page js ends  -->
<?= $this->endSection() ?>