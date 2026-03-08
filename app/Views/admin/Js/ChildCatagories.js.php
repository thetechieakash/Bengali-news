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

        $('#child-cat-listing').DataTable();

        $('.select2').select2({
            theme: 'bootstrap',
            placeholder: 'Select sub category',
        });

        $('#category_id').on('change', async function() {
            const categoryId = $(this).val();
            // Reset subcategory dropdown
            $('#subcategory_id')
                .html('<option value="">Loading...</option>')
                .prop('disabled', true);
            if (!categoryId) {
                $('#subcategory_id')
                    .html('<option value="">Select Sub Category</option>')
                    .prop('disabled', true)
                    .trigger('change');
                return;
            }
            try {
                const response = await fetch("<?= base_url('admin/sub-categories/by-categories') ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                        "X-CSRF-TOKEN": "<?= csrf_hash() ?>"
                    },
                    body: new URLSearchParams({
                        "category_ids[]": categoryId
                    })
                });
                const subCategories = await response.json();
                let options = '<option value="">Select Sub Category</option>';
                subCategories.forEach(sub => {
                    options += `<option value="${sub.id}">${sub.sub_cat_name}</option>`;
                });
                $('#subcategory_id')
                    .html(options)
                    .prop('disabled', false)
                    .trigger('change');
            } catch (error) {
                console.error('Subcategory load error:', error);
                $('#subcategory_id')
                    .html('<option value="">Failed to load</option>')
                    .prop('disabled', true);
            }
        });

        $('#childCatform').on('submit', async function(e) {
            e.preventDefault();
            const childCatName = $('#child_cat_name').val().trim();
            const childCatSlug = $('#child_cat_slug').val().trim();
            if (!$('#category_id').val()) {
                showDangerToast('Category required');
                return;
            }
            if (!$('#subcategory_id').val()) {
                showDangerToast('Sub category required');
                return;
            }
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
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                    },
                    body: JSON.stringify({
                        category_id: $('#category_id').val(),
                        sub_cat_id: $('#subcategory_id').val(),
                        child_cat_name: childCatName,
                        child_cat_slug: childCatSlug
                    })
                });

                const resp = await response.json();

                if (resp.success) {
                    showSuccessToast(resp.message);

                    $('#childCatform')[0].reset();
                    $('#subcategory_id').val(null).trigger('change');
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
                console.error('Child category ajax error:', error);
                showDangerToast('Something went wrong, try again later');
            }
        });

        let currentEditSubCatId = null;
        $(document).on('click', '.editBtn', function() {

            const id = $(this).data('id');
            const categoryId = $(this).data('category-id');
            const subCatId = $(this).data('subcat-id');
            const name = $(this).data('name');
            const slug = $(this).data('slug');

            currentEditSubCatId = subCatId; // store for later

            $('#edit_child_id').val(id);
            $('#edit_child_cat_name').val(name);
            $('#edit_child_cat_slug').val(slug);

            $('#editChildCatModal').modal('show');

            $('#edit_category_id').select2({
                theme: 'bootstrap',
                dropdownParent: $('#editChildCatModal'),
                placeholder: 'Select Sub Category'
            });
            $('#edit_category_id').val(categoryId).trigger('change');

            $('#edit_subcategory_id').select2({
                theme: 'bootstrap',
                dropdownParent: $('#editChildCatModal'),
                placeholder: 'Select Sub Category'
            });
        });
        $('#edit_category_id').on('change', async function() {
            const categoryId = $(this).val();

            $('#edit_subcategory_id')
                .html('<option value="">Loading...</option>')
                .prop('disabled', true);

            if (!categoryId) return;


            const response = await fetch("<?= base_url('admin/sub-categories/by-categories') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                    "X-CSRF-TOKEN": "<?= csrf_hash() ?>"
                },
                body: new URLSearchParams({
                    "category_ids[]": categoryId
                })
            });

            const subCategories = await response.json();

            let options = '<option value="">Select Sub Category</option>';

            subCategories.forEach(sub => {
                options += `<option value="${sub.id}">${sub.sub_cat_name}</option>`;
            });

            $('#edit_subcategory_id')
                .html(options)
                .prop('disabled', false);

            // SELECT CORRECT SUBCATEGORY HERE
            if (currentEditSubCatId) {
                $('#edit_subcategory_id')
                    .val(currentEditSubCatId)
                    .trigger('change');

                currentEditSubCatId = null;
            }
        });
        $('#updateChildCatBtn').on('click', async function() {

            const data = {
                id: $('#edit_child_id').val(),
                category_id: $('#edit_category_id').val(),
                sub_cat_id: $('#edit_subcategory_id').val(),
                child_cat_name: $('#edit_child_cat_name').val().trim(),
                child_cat_slug: $('#edit_child_cat_slug').val().trim(),
            };
            try {
                const response = await fetch("<?= base_url('admin/child-categories/update') ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                    },
                    body: JSON.stringify(data)
                });

                const resp = await response.json();

                if (resp.success) {
                    showSuccessToast(resp.message);
                    $('#editChildCatModal').modal('hide');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    if (resp.errors) {
                        Object.values(resp.errors).forEach(err => showDangerToast(err));
                    } else {
                        showDangerToast(resp.message);
                    }
                }

            } catch (error) {
                showDangerToast('Update failed');
            }
        });

        $(document).on('click', '.deletebtn', async function() {

            const id = $(this).data('id');

            const confirmed = await Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!"
            });

            if (!confirmed.isConfirmed) return;

            try {
                const response = await fetch("<?= base_url('admin/child-categories/delete') ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: id
                    })
                });

                const resp = await response.json();

                if (resp.success) {
                    showSuccessToast(resp.message);
                    setTimeout(() => location.reload(), 800);
                } else {
                    showDangerToast(resp.message);
                }

            } catch (error) {
                showDangerToast('Delete failed');
            }
        });
    });
</script>