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

        // Toggle functions

        $('#news-listing').on('change', '.toggle-status', async function() {
            const checkbox = $(this);
            const previousState = !checkbox.prop('checked');

            const id = checkbox.data('id');
            const value = checkbox.is(':checked') ? 1 : 0;

            if (!confirm('Are you sure you want to update status?')) {
                checkbox.prop('checked', previousState);
                return;
            }

            // Optional: disable checkbox while processing
            checkbox.prop('disabled', true);

            try {
                const response = await fetch('<?= base_url('admin/news/update-status') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        id,
                        value
                    })
                });

                const data = await response.json();

                if (!data.success) {
                    checkbox.prop('checked', previousState); // rollback
                    showDangerToast(data.message);
                } else {
                    showSuccessToast(data.message);
                }

            } catch (err) {
                checkbox.prop('checked', previousState); // rollback
                showDangerToast('Something went wrong, try again later');
                console.error(err);
            } finally {
                checkbox.prop('disabled', false);
            }
        });



        // Post delete function 

        $(document).on('click', '.deleteBtn', function() {
            const id = $(this).data('id');

            if (!confirm('Are you sure you want to delete this news post?')) {
                return;
            }

            $.ajax({
                url: "<?= base_url('admin/news/delete') ?>/" + id,
                type: "POST",
                dataType: "json",
                success: function(res) {
                    if (res.success) {
                        showSuccessToast(res.message);
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        showDangerToast(res.message || 'Delete failed')
                    }
                },
                error: function(err) {
                    showDangerToast('Something went wrong');
                    console.error('Delete post', err);

                }
            });
        });

    });
</script>