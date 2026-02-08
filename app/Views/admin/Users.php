<?= $this->extend('layouts\AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>

<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">

<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="users-listing" class="table">
                        <thead>
                            <tr>
                                <th>SL #</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sl = 0; ?>
                            <?php foreach ($users as $user): ?>
                                <?php $sl++; ?>
                                <tr>
                                    <td><?= $sl ?></td>
                                    <td><?= $user->username ?></td>
                                    <td><?= $user->email ?></td>
                                    <td>
                                        <?php
                                        $groups = $user->getGroups();
                                        $role   = $groups[0] ?? 'user';
                                        ?>

                                        <?php if ($role === 'superadmin'): ?>
                                            <span class="badge bg-danger">Super Admin</span>

                                        <?php elseif ($role === 'admin'): ?>
                                            <span class="badge bg-primary">Admin</span>

                                        <?php elseif ($role === 'author'): ?>
                                            <span class="badge bg-info">Author</span>

                                        <?php else: ?>
                                            <span class="badge bg-secondary">User</span>
                                        <?php endif; ?>
                                    </td>
                                    <?php $formattedDate = (new DateTime($user->created_at))->format('d M, Y h:i A'); ?>
                                    <!-- <td><?= $formattedDate ?></td> -->
                                    <td>
                                        <?php if ($user->deleted_at): ?>
                                            <span class="badge bg-danger">Deactivated</span>
                                        <?php else: ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-success btn-sm dropdown-toggle" type="button" id="dropdownAction" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Modify
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownAction">
                                                <?php if ($user->deleted_at): ?>
                                                    <button class="dropdown-item restorebtn" data-id="<?= $user->id ?>">Reactivate</button>
                                                <?php else: ?>
                                                    <button class="dropdown-item editBtn"
                                                        data-id="<?= $user->id ?>"
                                                        data-username="<?= $user->username ?>"
                                                        data-email="<?= $user->email ?>">Edit</button>
                                                    <div class="dropdown-divider"></div>
                                                    <button class="dropdown-item deletebtn" data-id="<?= $user->id ?>">Delete</button>
                                                <?php endif; ?>
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
<?= $this->include('admin/Components/Modals/UpdateUserModal.php'); ?>
<!-- Page modals ends  -->

<?= $this->endSection() ?>

<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<?= $this->include('admin/Js/Users.js.php'); ?>

<?= $this->endSection() ?>