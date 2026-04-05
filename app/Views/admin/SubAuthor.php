<?= $this->extend('layouts/AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/dropify/dist/css/dropify.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/dropify/dist/css/dropify.min.css">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-body">
                <h4 class="card-title">Add Guest Author</h4>
                <form class="forms-sample" id="authorform" action="<?= base_url('admin/author-create') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <input type="file"
                                    class="picture"
                                    id="picture"
                                    name="profile_image"
                                    accept="image/*" required>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" value="" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-white me-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php if (!empty($authors)): ?>
                    <h4 class="card-title">All Authors</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="author-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th>SL #</th>
                                            <th>Picture</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sl = 0; ?>
                                        <?php foreach ($authors as $author): ?>
                                            <?php $sl++; ?>
                                            <tr>
                                                <td class="serial-no"><?= $sl ?>.</td>
                                                <td>
                                                    <?php if (!empty($author['profile_image'])): ?>
                                                        <img src="<?= base_url($author['profile_image']) ?>"
                                                            style="width:50px;height:50px;object-fit:cover;border-radius:50%;">
                                                    <?php else: ?>
                                                        <img src="https://placehold.co/50x50"
                                                            style="border-radius:50%;">
                                                    <?php endif; ?>
                                                </td>

                                                <td><?= esc($author['name']) ?></td>
                                                <td><?= esc($author['email']) ?></td>

                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Modify
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <button class="dropdown-item editBtn" data-id="<?= $author['id'] ?>"
                                                                data-name="<?= esc($author['name']) ?>"
                                                                data-email="<?= esc($author['email']) ?>"
                                                                data-image="<?= esc($author['profile_image']) ?>">Edit</button>
                                                            <button class="dropdown-item deleteBtn" data-id="<?= $author['id'] ?>">Delete</button>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning mb-0" role="alert">
                        Authors are empty!
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- Page modals start  -->
<!-- Edit Author Modal -->
<div class="modal fade" id="editAuthorModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editAuthorForm" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title">Edit Sub Author</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group ">
                                <input type="file"
                                    class="picture"
                                    id="edit_picture"
                                    name="profile_image"
                                    accept="image/*">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="edit_name">Name</label>
                                <input type="text" class="form-control" id="edit_name" name="name" placeholder="Full Name" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_email">Email</label>
                                <input type="email" class="form-control" id="edit_email" name="email" placeholder="Email Address" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Page modals ends  -->

<?= $this->endSection() ?>

<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="<?= base_url() ?>assets/vendors/dropify/dist/js/dropify.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Page js start -->
<?= $this->include('admin/Js/SubAuthor.js.php'); ?>
<!-- Page js ends  -->
<?= $this->endSection() ?>