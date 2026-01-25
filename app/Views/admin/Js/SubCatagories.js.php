<script>
    $(document).ready(function() {
        // Open modal function 
        $(document).on('click', '.editBtn', function() {

            let id = $(this).data('id');
            let catId = $(this).data('cat-id');
            let name = $(this).data('name');

            $('#sub_cat_id').val(id);
            $('#cat_id').val(catId);
            $('#sub_cat_name').val(name);

            $('#editSubCatModal').modal('show');
        });

        // Toggle functions

        $('.toggle-is-active').click(async function(e) {
            let id = $(this).data('id');
            let value = $(this).prop('checked') ? 1 : 0;

            if (!confirm('Are you sure you want to update ?')) {
                e.preventDefault();
                return
            };
            try {
                const sendData = await fetch('<?= base_url('admin/sub-categories/update-active') ?>', {
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

        $('.toggle-status').click(async function() {
            let id = $(this).data('id');
            let value = $(this).is(':checked') ? 1 : 0;

            if (!confirm('Are you sure you want to update status?')) {
                e.preventDefault();
                return
            };
            try {
                const sendData = await fetch('<?= base_url('admin/sub-categories/update-status') ?>', {
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

        // Update functions 

        $('#updateBtn').click(async function(e) {
            let subCatId = $('#sub_cat_id').val();
            let catId = $('#cat_id').val();
            let newCatName = $('#sub_cat_name').val();
            if (!confirm('Are you sure you want to update sub category?')) {
                e.preventDefault();
                return;
            }
            try {
                const response = await fetch("<?= base_url('admin/sub-categories/update') ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        subCatId,
                        catId,
                        newCatName
                    }),
                });
                const data = await response.json();
                if (data.success) {
                    showSuccessToast(data.message);
                    $('#editSubCatModal').modal('hide');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    showDangerToast(data.message);
                }
            } catch (error) {
                console.error('Update ajax error', error);
                showDangerToast('Something went wrong, try again later');
                $('#editSubCatModal').modal('hide');
            }
        })

        // Sub category delete function 

        $(document).on('click', '.deletebtn', async function() {
            const subCatId = $(this).data('id');
            const catId = $(this).data('cat-id');

            if (!confirm('Are you sure you want to delete this sub category?')) return;

            try {
                const response = await fetch("<?= base_url('admin/sub-categories/delete') ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        subCatId,
                        catId
                    })
                });

                const data = await response.json();

                if (data.success) {
                    showSuccessToast(data.message);
                    setTimeout(() => location.reload(), 800);
                } else {
                    showDangerToast(data.message);
                }

            } catch (error) {
                console.error('Delete ajax error', error);
                showDangerToast('Something went wrong, try again later');
            }
        });

    });
</script>