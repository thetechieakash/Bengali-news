<?= $this->extend('layouts/AdminLayout.php') ?>

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
                                <th>Comments</th>
                                <th>Post Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sl = 0; ?>
                            <?php foreach ($news as $post): ?>
                                <?php $sl++; ?>
                                <tr id="post-row-<?= $post['id'] ?>">
                                    <td><?= $sl ?>.</td>
                                    <td>
                                        <a href="<?= $post['status'] == 1 ? base_url('news/' . $post['slug'])  : base_url('admin/news-preview/' . $post['slug']) ?>"
                                            target="_blank" title="Post name">
                                            <?= mb_strimwidth($post['headline'], 0, 30, "...") ?>
                                        </a>
                                        <div class="mt-2">
                                            <span class="badge badge-outline-primary rounded" title="Total Views"><?= $post['views'] ?> <i class="fa fa-eye"></i></span>
                                            <span class="badge badge-outline-primary rounded" title="Total Comments"><?= $post['total_comments'] ?> <i class="fa fa-comment-o"></i></span>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if ($post['approved_comments'] > 0): ?>
                                            <a href="javascript:void(0)"
                                                class="approved-comments"
                                                data-id="<?= $post['id'] ?>">
                                                <span class="badge badge-success">
                                                    Approved (<?= $post['approved_comments'] ?>)
                                                </span>
                                            </a>
                                        <?php endif; ?>

                                        <?php if ($post['pending_comments'] > 0): ?>
                                            <a href="javascript:void(0)"
                                                class="pending-comments"
                                                data-id="<?= $post['id'] ?>">
                                                <span class="badge badge-warning">
                                                    Pending (<?= $post['pending_comments'] ?>)
                                                </span>
                                            </a>
                                        <?php endif; ?>

                                        <?php if ($post['approved_comments'] == 0 && $post['pending_comments'] == 0): ?>
                                            <span class="badge badge-outline-danger">
                                                No Comments
                                            </span>
                                        <?php endif; ?>
                                    </td>

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
<?= $this->include('admin/Components/Modals/CommentModal.php'); ?>
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