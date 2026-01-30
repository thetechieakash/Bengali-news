<script>
    $(document).ready(function() {
        // Data table init
        $('#cat-listing').DataTable();

        // Add fucntion
        const catForm = $('#catform');
        if (catForm) {
            catForm.on('submit', async (e) => {
                e.preventDefault();
                try {
                    const formData = new FormData(catForm[0]);
                    const sendData = await fetch('<?= base_url('admin/categories') ?>', {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    })
                    const resp = await sendData.json();

                    if (!resp.success) {
                        if (typeof resp.errors == "object") {
                            Object.values(resp.errors).forEach(key => {
                                showDangerToast(key)
                            })
                            catForm[0].reset();
                        } else {
                            showDangerToast(resp.message);
                        }
                    } else {
                        showSuccessToast(resp.message)
                        catForm[0].reset();
                        setTimeout(() => {
                            location.reload();
                        }, 1000);

                    }
                } catch (error) {
                    console.error('Create category fetch error', error);
                }
            });
        }
        const categoryItems = $('.category-items');

        categoryItems.on('click', function(e) {
            e.preventDefault()
            $('#addcatcard').addClass('d-none');
            $('#addsubcatcard').removeClass('d-none');
        });

        // Open modal function 
        $(document).on('click', '.editBtn', function() {

            let id = $(this).data('id');
            let name = $(this).data('name');
            let slug = $(this).data('slug');
            let status = $(this).data('status');
            let navbar = $(this).data('navbar');

            $('#cat_id').val(id);
            $('#cat_name').val(name).prop("readonly", false);
            $('#cat_slug').val(slug);
            $('#cat_status').val(status);
            $('#cat_navbar').val(navbar);

            $('#editModal').modal('show');

            $('#updateBtn').show();
            $('#addsubcatform').hide();
            $('#addSubCatBtn').hide();
        });

        // Toggle functions

        $('.toggle-is-active').click(async function(e) {
            const element = $(this);

            let isActive = true
            let id = $(this).data('id');
            let value = $(this).is(':checked') ? 1 : 0;

            if (!confirm('Are you sure you want to update ?')) {
                e.preventDefault();
                return
            };
            try {
                const sendData = await fetch('<?= base_url('admin/category/update-active') ?>', {
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

        // Update functions 

        $('#updateBtn').click(async function(e) {
            let id = $('#cat_id').val();
            let slug = $('#cat_slug').val();
            let newCatName = $('#cat_name').val();
            if (!confirm('Are you sure you want to update category?')) {
                e.preventDefault();
                return;
            }
            try {
                const response = await fetch("<?= base_url('admin/category/update') ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id,
                        slug,
                        newCatName
                    }),
                });
                const data = await response.json();
                if (data.success) {
                    showSuccessToast(data.message);
                    $('#editModal').modal('hide');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    showDangerToast(data.message);
                }
            } catch (error) {
                console.error('Update ajax error', error);
                showDangerToast('Something went wrong, try again later');
            }
        })
        let currentCatId = null;
        let currentCatSlug = null;
        // Add sub category functions
        $(document).on('click', '.addSubCat', function(e) {
            e.preventDefault()
            // let id = $(this).data('id');
            // let name = $(this).data('name');
            // let slug = $(this).data('slug');

            // $('#cat_id').val(id);
            // $('#cat_name').val(name).prop("readonly", true);
            // $('#cat_slug').val(slug);
            // $('#editModal').modal('show');

            // $('#updateBtn').hide();
            // $('#addsubcatform').show();
            // $('#addSubCatBtn').show();
            currentCatId = $(this).data('id');
            currentCatSlug = $(this).data('slug');

            $('#cat_id').val(currentCatId);
            $('#cat_name').val($(this).data('name')).prop("readonly", true);
            $('#cat_slug').val(currentCatSlug);

            $('#editModal').modal('show');

            $('#updateBtn').hide();
            $('#addsubcatform').show();
            $('#addSubCatBtn').show();

            // $('#addSubCatBtn').click(async function(e) {
            //     e.preventDefault();
            //     const subCatName = $('#sub_cat_name').val();
            //     const subCatStatus = $('#sub_cat_status').prop('checked');
            //     console.log(subCatStatus);

            //     try {
            //         const sendData = await fetch("<?= base_url('admin/sub-categories') ?>", {
            //             method: 'POST',
            //             headers: {
            //                 'Content-Type': 'application/json'
            //             },
            //             body: JSON.stringify({
            //                 id,
            //                 slug,
            //                 subCatName,
            //                 subCatStatus
            //             })
            //         });

            //         const data = await sendData.json();

            //         if (data.success) {
            //             showSuccessToast(data.message);
            //             $('#editModal').modal('hide');
            //         } else {
            //             showDangerToast(data.message);
            //         }
            //     } catch (error) {
            //         console.error('New sub add ajax error', error);
            //         showDangerToast('Something went wrong, try again later');
            //     }

            // });
        })
        $('#addSubCatBtn').on('click', async function(e) {
            e.preventDefault();

            const subCatName = $('#sub_cat_name').val().trim();
            const subCatStatus = $('#sub_cat_status').prop('checked');

            if (!subCatName) {
                showDangerToast('Sub category name is required');
                return;
            }

            try {
                const sendData = await fetch("<?= base_url('admin/sub-categories') ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: currentCatId,
                        slug: currentCatSlug,
                        subCatName,
                        subCatStatus
                    })
                });

                const resp = await sendData.json();

                if (resp.success) {
                    showSuccessToast(resp.message);
                    $('#editModal').modal('hide');
                    $('#sub_cat_name').val('');
                    $('#sub_cat_status').prop('checked', false);
                } else {
                    if (typeof resp.errors == "object") {
                        Object.values(resp.errors).forEach(key => {
                            showDangerToast(key)
                        })
                    } else {
                        showDangerToast(resp.message);
                    }
                }

            } catch (error) {
                console.error('New sub add ajax error', error);
                showDangerToast('Something went wrong, try again later');
            }
        });

        // category delete function 

        $('.deletebtn').click(async function() {
            let id = $(this).data('id');
            if (!confirm('Are you sure you want to delete?')) return;
            try {
                const sendData = await fetch("<?= base_url('admin/category/delete') ?>", {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        id
                    })
                });

                const data = await sendData.json();

                if (data.success) {
                    showSuccessToast(data.message);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
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