<script>
    $(document).ready(function() {
        // Data table config
        $('#users-listing').DataTable();

        // asign values
        $(document).on('click', '.editBtn', function() {
            let id = $(this).data('id');
            let username = $(this).data('username');
            let email = $(this).data('email');

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
            if (!confirm('Are you sure you want to update user?')) {
                return;
            }
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

        $('#users-listing').on('click', '.deletebtn', function() {
            let id = $(this).data('id');

            if (!confirm('Are you sure you want to delete?')) return;

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

        $('#users-listing').on('click', '.authorizationBtn', function() {
            let id = $(this).data('id');
            location.href = `<?= base_url('admin/user/authorization/') ?>${id}`

        });
        $('#users-listing').on('click', '.restorebtn', function() {
            let id = $(this).data('id');
            if (!confirm('Are you sure you want restore this user?')) return;
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