<?= $this->extend('layouts\AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>

<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="news-listing" class="table">
                        <thead>
                            <tr>
                                <th>SL #</th>
                                <th>Post</th>
                                <th>Post Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sl = 0; ?>
                            <?php foreach ($news as $post): ?>
                                <?php $sl++; ?>
                                <tr>
                                    <td><?= $sl ?>.</td>
                                    <td><a href=""><?= mb_strimwidth($post['headline'], 0, 50, "...") ?></a> </td>
                                    <?php $formattedDate = (new DateTime($post['updated_at']))->format('d M, Y h:i A'); ?>
                                    <td><?= $formattedDate ?></td>

                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="toggle-switch mb-0">
                                                <input type="checkbox" name="activestatus"
                                                    class="toggle-status"
                                                    data-id="<?= $post['id'] ?>"
                                                    <?= $post['status'] == 1 ? 'checked' : '' ?>>
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownAction" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Modify
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownAction">
                                                <button class="dropdown-item editBtn"
                                                    data-id="<?= $post['id'] ?>">Edit</button>
                                                <button class="dropdown-item deleteBtn"
                                                    data-id="<?= $post['id'] ?>">Delete</button>
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
    </div>
</div>
<!-- Page modals start  -->
<!-- Page modals ends  -->

<?= $this->endSection() ?>

<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<?= $this->include('admin/Js/AllNews.js.php'); ?>

<?= $this->endSection() ?>