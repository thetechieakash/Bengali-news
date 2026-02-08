<script>
    $(document).ready(function() {

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
        $('#sub-cat-listing').on('change', '.toggle-is-active', async function() {
            const checkbox = $(this);
            const previousState = !checkbox.prop('checked');

            const id = checkbox.data('id');
            const value = checkbox.prop('checked') ? 1 : 0;

            const confirmed = await swalConfirm({
                text: 'Do you want to update active status?'
            });

            if (!confirmed) {
                checkbox.prop('checked', previousState);
                return;
            }

            try {
                const res = await fetch('<?= base_url('admin/sub-categories/update-active') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id,
                        value
                    })
                });

                const data = await res.json();

                if (!data.success) {
                    checkbox.prop('checked', previousState);
                    showDangerToast(data.message);
                } else {
                    showSuccessToast(data.message);
                }

            } catch (err) {
                checkbox.prop('checked', previousState);
                showDangerToast('Something went wrong, try again later');
                console.error(err);
            }
        });

        $('#sub-cat-listing').on('change', '.toggle-status', async function() {
            const checkbox = $(this);
            const previousState = !checkbox.prop('checked');

            const id = checkbox.data('id');
            const value = checkbox.prop('checked') ? 1 : 0;

            const confirmed = await swalConfirm({
                text: 'Do you want to update status?'
            });

            if (!confirmed) {
                checkbox.prop('checked', previousState);
                return;
            }

            try {
                const res = await fetch('<?= base_url('admin/sub-categories/update-status') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id,
                        value
                    })
                });

                const data = await res.json();

                if (!data.success) {
                    checkbox.prop('checked', previousState);
                    showDangerToast(data.message);
                } else {
                    showSuccessToast(data.message);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }

            } catch (err) {
                checkbox.prop('checked', previousState);
                showDangerToast('Something went wrong, try again later');
                console.error(err);
            }
        });

        // Update functions 

        $(document).on('click', '.updateSubCatBtn', async function(e) {
            e.preventDefault();

            const confirmed = await swalConfirm({
                text: 'Do you want to update this sub category?'
            });

            if (!confirmed) return;

            let subCatId = $('#sub_cat_id').val();
            let catId = $('#cat_id').val();
            let newCatName = $('#sub_cat_name').val();

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

            const confirmed = await swalConfirm({
                title: 'Delete Sub Category?',
                text: 'This sub category will be permanently deleted!',
                icon: 'error',
                confirmText: 'Yes, delete it'
            });

            if (!confirmed) return;

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