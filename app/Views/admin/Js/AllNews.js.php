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


        $('.toggle-status').click(async function() {

            let id = $(this).data('id');
            let value = $(this).is(':checked') ? 1 : 0;

            if (!confirm('Are you sure you want to update status?')) {
                e.preventDefault();
                return
            };
            try {
                const sendData = await fetch('<?= base_url('admin/category/update-status') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id,
                        value
                    })
                });
                const data = await sendData.json();

                if (data.success) {
                    showSuccessToast(data.message);
                } else {
                    showDangerToast(data.message);
                }

            } catch (error) {
                console.error('Active ajax error', error);
                showDangerToast('Something went wrong, try again later');
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