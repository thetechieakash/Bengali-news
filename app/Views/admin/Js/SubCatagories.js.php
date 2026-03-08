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
        $('#subCatform').on('submit', async function(e) {
            e.preventDefault();

            const categoryId = $('#category').val();
            const subCatName = $('#sub_cat_name').val().trim();
            const subCatSlug = $('#sub_cat_slug').val().trim();

            if (!categoryId) {
                showDangerToast('Please select a category');
                return;
            }

            if (!subCatName) {
                showDangerToast('Sub category name is required');
                return;
            }

            if (!subCatSlug) {
                showDangerToast('Sub category slug is required');
                return;
            }

            try {
                const response = await fetch("<?= base_url('admin/sub-categories') ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: categoryId,
                        subCatName: subCatName,
                        subCatSlug: subCatSlug
                    })
                });

                const resp = await response.json();

                if (resp.success) {
                    showSuccessToast(resp.message);
                    $('#subCatform')[0].reset();
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    if (typeof resp.errors === "object") {
                        Object.values(resp.errors).forEach(err => {
                            showDangerToast(err);
                        });
                    } else {
                        showDangerToast(resp.message);
                    }
                }

            } catch (error) {
                console.error('Sub category ajax error:', error);
                showDangerToast('Something went wrong, try again later');
            }
        });
        // Open modal function 
        $(document).on('click', '.editBtn', function() {

            let id = $(this).data('id');
            let catId = $(this).data('cat-id');
            let name = $(this).data('name');
            let slug = $(this).data('slug');

            $('#sub_cat_id').val(id);
            $('#cat_id').val(catId);
            $('#newSubCat #sub_cat_name').val(name);
            $('#newSubCat #sub_cat_slug').val(slug);

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

        $(document).on('click', '#updateSubCatBtn', async function(e) {
            e.preventDefault();

            const confirmed = await swalConfirm({
                text: 'Do you want to update this sub category?'
            });

            if (!confirmed) return;

            let subCatId = $('#sub_cat_id').val();
            let catId = $('#cat_id').val();
            let newCatName = $('#newSubCat #sub_cat_name').val();
            let newCatSlug = $('#newSubCat #sub_cat_slug').val();

            try {
                const response = await fetch("<?= base_url('admin/sub-categories/update') ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        subCatId,
                        catId,
                        newCatName,
                        newCatSlug
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

        $(document).on('click', '.addChildCat', async function(e) {
            e.preventDefault();
            const id = $(this).data('id');
            $('#sub_cat_id').val(id)
            $('#createChildCatModal').modal('show');
            
        });
        $('#createChildCatBtn').on('click', async function(e) {
            e.preventDefault();

            const childCatName = $('#child_cat_name').val().trim();
            const childCatSlug = $('#child_cat_slug').val().trim();

            if (!childCatName) {
                showDangerToast('Child category name required');
                return;
            }

            if (!childCatSlug) {
                showDangerToast('Slug required');
                return;
            }

            try {

                const response = await fetch("<?= base_url('admin/child-categories') ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
                        sub_cat_id: $('#sub_cat_id').val(),
                        child_cat_name: childCatName,
                        child_cat_slug: childCatSlug
                    })
                });

                const resp = await response.json();

                if (resp.success) {

                    showSuccessToast(resp.message);

                    $('#childCatUpdate')[0].reset();
                    $('#sub_cat_id').val(null);
                    $('#createChildCatModal').modal('hide');

                } else {

                    if (typeof resp.errors === "object") {
                        Object.values(resp.errors).forEach(err => showDangerToast(err));
                    } else {
                        showDangerToast(resp.message);
                    }

                }

            } catch (error) {

                console.error('Child category ajax error:', error);
                showDangerToast('Something went wrong, try again later');

            }

        });
    });
</script>