<?= $this->extend('layouts/AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php

use App\Helpers\StringShort;
?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="comments-listing" class="table">
                        <thead>
                            <tr>
                                <th>SL #</th>
                                <th>Status</th>
                                <th>Comment Preview</th>
                                <th>Reply Preview</th>
                                <th>Guest</th>
                                <th>Date </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sl = 0; ?>
                            <?php foreach ($comments as $comment): ?>
                                <?php $sl++; ?>
                                <tr id="comment-row-<?= $comment['id'] ?>">
                                    <td><?= $sl ?></td>
                                    <td>
                                        <?php if (!empty($comment['deleted_at'])): ?>
                                            <span class="badge bg-danger">Deleted</span>
                                        <?php else: ?>
                                            <?php if ($comment['status'] == 0): ?>
                                                <span class="badge bg-warning">Pending</span>
                                            <?php elseif ($comment['status'] == 1): ?>
                                                <span class="badge bg-success">Approved</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Rejected</span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= StringShort::truncate($comment['comment'], 20) ?>
                                        <div class="mt-2">
                                            <button class="badge badge-outline-primary rounded viewpost" data-id="<?= $comment['news_post_id'] ?>">View Post</button>
                                            <button class="badge badge-outline-primary rounded viewcomment" data-text="<?= esc($comment['comment']) ?>">View Comment</button>
                                        </div>
                                    </td>
                                    <td>
                                        <?php if (!empty($comment['reply'])): ?>
                                            <?= StringShort::truncate($comment['reply'][0]['comment'], 20) ?>
                                            <div class="mt-2">
                                                <button class="badge badge-outline-primary rounded viewcomment" data-text="<?= esc($comment['reply'][0]['comment']) ?>">View</button>
                                            </div>
                                        <?php else: ?>
                                            <span class="badge badge-outline-danger">No Reply</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <p><strong><?= esc($comment['guest_name']) ?></strong></p>
                                        <p><small><?= esc($comment['guest_email']) ?></small></p>
                                        <?php
                                        $score = (float) $comment['recaptcha_score'];
                                        $class = $score >= 0.7 ? 'text-success' : ($score >= 0.4 ? 'text-warning' : 'text-danger');
                                        ?>
                                        <p><small>
                                                Recaptcha Score : <span class="<?= $class ?>"> <?= number_format($score, 2) ?> </span>
                                            </small></p>
                                    </td>
                                    <td>
                                        <p><?= date('d M Y', strtotime($comment['created_at'])) ?>
                                            <small><?= date('H:i', strtotime($comment['created_at'])) ?></small>
                                        </p>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownAction" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Modify
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownAction">
                                                <?php if ($comment['status'] == 0): ?>
                                                    <button class="dropdown-item approveBtn" data-id="<?= $comment['id'] ?>">Approve</button>
                                                <?php endif; ?>

                                                <?php if ($comment['status'] == 1): ?>
                                                    <button class="dropdown-item unpublishBtn" data-id="<?= $comment['id'] ?>">Unpublish</button>
                                                    <button class="dropdown-item replyBtn"
                                                        data-id="<?= $comment['id'] ?>"
                                                        data-reply="<?= !empty($comment['reply']) ? esc($comment['reply'][0]['comment'], 'attr') : '' ?>">
                                                        <?= !empty($comment['reply']) ? 'Edit Reply' : 'Reply' ?>
                                                    </button>
                                                <?php endif; ?>

                                                <div class="dropdown-divider"></div>
                                                <button class="dropdown-item text-danger deleteBtn" data-id="<?= $comment['id'] ?>">Delete</button>
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
<?= $this->include('admin/Components/Modals/ReplyModal.php'); ?>

<!-- Page modals ends  -->

<?= $this->endSection() ?>

<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Page js start -->
<?= $this->include('admin/Js/Comments.js.php'); ?>
<!-- Page js ends  -->

<?= $this->endSection() ?>