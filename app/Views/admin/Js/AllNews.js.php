<script>
    $(document).ready(function() {
        // Data table config
        $('#news-listing').DataTable();

        // Edit function redirect to edit page
        $(document).on('click', '.editBtn', function() {

            let id = $(this).data('id');
            if (!id) {
                showDangerToast('Invalid post');
                return;
            }
            window.location.href = "<?= base_url('admin/news/update') ?>/" + id;
        });

        /* --------------------------------
         * STATUS TOGGLE (SweetAlert)
         * -------------------------------- */
        $('#news-listing').on('change', '.toggle-status', function() {

            const checkbox = $(this);
            const id = checkbox.data('id');
            const newValue = checkbox.is(':checked') ? 1 : 0;
            const oldValue = newValue === 1 ? 0 : 1;

            // rollback helper
            const rollback = () => checkbox.prop('checked', !!oldValue);

            Swal.fire({
                title: newValue ?
                    'Publish this post?' :
                    'Unpublish this post?',
                html: newValue ?
                    `<small>The post date will be updated to <b>current date & time</b>.</small>` :
                    `<small>The post will be moved back to <b>draft</b>.</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: newValue ? 'Yes, publish' : 'Yes, unpublish',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#1F3BB3',
                cancelButtonColor: '#6c757d',
                reverseButtons: true
            }).then(async (result) => {

                if (!result.isConfirmed) {
                    rollback();
                    return;
                }

                checkbox.prop('disabled', true);

                try {
                    const res = await fetch('<?= base_url('admin/news/update-status') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            id,
                            value: newValue
                        })
                    });

                    const data = await res.json();

                    if (!data.success) {
                        rollback();
                        showDangerToast(data.message || 'Status update failed');
                    } else {
                        showSuccessToast(data.message);
                    }

                } catch (e) {
                    rollback();
                    showDangerToast('Something went wrong');
                    console.error(e);
                } finally {
                    checkbox.prop('disabled', false);
                }
            });
        });

        /* --------------------------------
         * DELETE POST (SweetAlert)
         * -------------------------------- */
        $(document).on('click', '.deleteBtn', function() {

            const id = $(this).data('id');

            Swal.fire({
                title: 'Delete this post?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                reverseButtons: true
            }).then((result) => {

                if (!result.isConfirmed) return;

                $.ajax({
                    url: "<?= base_url('admin/news/delete') ?>/" + id,
                    type: "POST",
                    dataType: "json",
                    success(res) {
                        if (res.success) {
                            showSuccessToast(res.message);
                            setTimeout(() => location.reload(), 800);
                        } else {
                            showDangerToast(res.message || 'Delete failed');
                        }
                    },
                    error(err) {
                        showDangerToast('Something went wrong');
                        console.error('Delete error:', err);
                    }
                });
            });
        });

    });
</script>