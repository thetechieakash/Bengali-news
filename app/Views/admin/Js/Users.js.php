<script>
    $(document).ready(function() {
        // Data table config
        $('#users-listing').DataTable();

        // Sweetalert2 
        const swalConfirm = async ({
            title = 'Are you sure?',
            text = 'This action cannot be undone',
            icon = 'warning',
            confirmText = 'Yes, continue',
            cancelText = 'Cancel'
        } = {}) => {
            const result = await Swal.fire({
                title,
                text,
                icon,
                showCancelButton: true,
                confirmButtonText: confirmText,
                cancelButtonText: cancelText,
                reverseButtons: true,
                focusCancel: true
            });

            return result.isConfirmed;
        };

        // asign values
        $(document).on('click', '.editBtn', function() {
            let id = $(this).data('id');
            let username = $(this).data('username');
            let email = $(this).data('email');
            $('#role').val($(this).data('role'));

            $('#user_id').val(id);
            $('#username').val(username);
            $('#email').val(email);

            $('#userEditModal').modal('show');
        });

        $('#updateBtn').click(async function(e) {
            e.preventDefault()
            let id = $('#user_id').val();
            const form = document.getElementById('updateUser');
            if (!id) {
                showDangerToast("Invalid user");
                return
            }
            const confirmed = await swalConfirm({
                text: 'Do you want to update this user?'
            });

            if (!confirmed) return;
            const formData = new FormData(form)
            $.ajax({
                url: "<?= base_url('admin/user/update') ?>",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success(res) {
                    if (res.success) {
                        showSuccessToast(res.message);
                    } else {
                        if (res.errors) {
                            Object.values(res.errors).forEach(err => {
                                showDangerToast(err);
                            });
                        } else {
                            showDangerToast(res.message);
                        }
                    }
                },
                error(e) {
                    showDangerToast('Something went wrong');
                    console.log("User create ajax error", e);

                },
                complete() {
                    form.reset();
                    $('#userEditModal').modal('hide');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            });
        })

        $('#users-listing').on('click', '.deletebtn', async function() {
            let id = $(this).data('id');

            const confirmed = await swalConfirm({
                title: 'Delete User?',
                text: 'This user will be permanently deleted!',
                icon: 'error',
                confirmText: 'Yes, delete'
            });

            if (!confirmed) return;

            $.ajax({
                url: "<?= base_url('admin/user/delete') ?>",
                type: "POST",
                data: {
                    user_id: id,
                    <?= csrf_token() ?>: "<?= csrf_hash() ?>"
                },
                success(res) {
                    if (res.success) {
                        showSuccessToast(res.message);
                        setTimeout(() => location.reload(), 800);
                    } else {
                        showDangerToast(res.message || 'Delete failed');
                    }
                },
                error(e) {
                    console.error(e);
                    showDangerToast('Something went wrong');
                }
            });
        });

        $('#users-listing').on('click', '.restorebtn', async function() {
            let id = $(this).data('id');

            const confirmed = await swalConfirm({
                title: 'Restore User?',
                text: 'This user account will be restored',
                icon: 'info',
                confirmText: 'Yes, restore'
            });

            if (!confirmed) return;

            $.post("<?= base_url('admin/user/restore') ?>", {
                user_id: id,
                <?= csrf_token() ?>: "<?= csrf_hash() ?>"
            }, function(res) {
                if (res.success) {
                    showSuccessToast(res.message);
                    setTimeout(() => location.reload(), 800);
                } else {
                    showDangerToast(res.message);
                }
            });
        });
        
    });
</script>