<?= $this->extend('layouts/AdminLayout.php') ?>

<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('plugin') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/select2/select2.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-body">
                <?php if (!empty($messages)): ?>
                    <h4 class="card-title">All Messages</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="messages-listing" class="table">
                                    <thead>
                                        <tr>
                                            <th>SL #</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Message</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $sl = 0; ?>
                                        <?php foreach ($messages as $message): ?>
                                            <?php $sl++; ?>
                                            <tr>
                                                <td><?= $sl ?>.</td>
                                                <td><?= $message['name'] ?></td>
                                                <td><?= $message['email'] ?></td>
                                                <td><?= $message['phone'] ?></td>
                                                <td>
                                                    <button class="btn btn-success btn-sm viewBtn"
                                                        data-subject="<?= esc($message['subject']) ?>"
                                                        data-message="<?= esc($message['message']) ?>">View</button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm deletebtn" data-id="<?= $message['id'] ?>">Delete</button>
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
                        Messages are empty!
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- Page modals start  -->
<!-- View Message Modal -->
<div class="modal fade" id="viewMessageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Message Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label><strong>Subject</strong></label>
                    <p id="modalSubject"></p>
                </div>
                <div class="form-group">
                    <label><strong>Message</strong></label>
                    <p id="modalMessage"></p>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- Page modals ends  -->

<?= $this->endSection() ?>

<?= $this->section('jsLib') ?>
<script src="<?= base_url() ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!-- Page js start -->
<!-- Page js ends  -->
<script>
    $(document).ready(function() {

        $('#messages-listing').DataTable();

        /* -----------------------------
           VIEW MESSAGE MODAL
        ------------------------------*/
        $(document).on('click', '.viewBtn', function() {

            let subject = $(this).data('subject');
            let message = $(this).data('message');

            $('#modalSubject').text(subject);
            $('#modalMessage').text(message);

            $('#viewMessageModal').modal('show');

        });


        /* -----------------------------
           DELETE MESSAGE
        ------------------------------*/
        $(document).on('click', '.deletebtn', function() {

            let id = $(this).data('id');
            let row = $(this).closest('tr');

            Swal.fire({
                title: 'Are you sure?',
                text: "This message will be deleted permanently!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?= base_url('admin/messages/delete/') ?>" + id,
                        type: "POST",
                        data: {
                            "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
                        },
                        dataType: "json",

                        success: function(res) {
                            if (res.success) {
                                showSuccessToast(res.message);
                                row.remove();
                            } else {
                                showDangerToast(res.message);
                            }
                        },
                        error: function() {
                            showDangerToast('Server error');
                        }
                    });
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>