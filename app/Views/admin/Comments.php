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
                                <th>Guest</th>
                                <th>Score </th>
                                <th>Date </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
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