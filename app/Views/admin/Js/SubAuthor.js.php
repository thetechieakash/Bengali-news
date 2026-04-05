<script>
    $(document).ready(function() {
        $('#author-listing').DataTable();
        $('#picture').dropify({
            messages: {
                'default': 'Drag your profile picture here or click to browse',
                'replace': 'Click to replace the profile picture',
                'remove': 'Remove',
                'error': 'Sorry, file is too large'
            }
        });

        const authorform = $('#authorform');

        authorform.on('submit', function(e) {
            e.preventDefault();

            if (!$('#name').val().trim()) {
                showDangerToast('Name is required');
                return;
            }

            if (!$('#email').val().trim()) {
                showDangerToast('Email address is required');
                return;
            }

            let formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: "<?= base_url('admin/author-create') ?>",
                data: formData,
                processData: false, //  REQUIRED
                contentType: false, //  REQUIRED
                cache: false,
                dataType: "json",

                success: function(res) {
                    if (res.success) {

                        authorform[0].reset();

                        let drEvent = $('#picture').dropify();
                        drEvent = drEvent.data('dropify');
                        drEvent.resetPreview();
                        drEvent.clearElement();

                        showSuccessToast(res.message);

                        setTimeout(() => {
                            location.reload();
                        }, 800);

                    } else {
                        showDangerToast(res.message);
                    }
                },

                error: function(e) {
                    showDangerToast('Something went wrong! Try again later.');
                    console.error('Author ajax error', e);
                }
            });
        });
        // Open edit modal
        // Initialize Dropify for edit modal
        $(document).on('click', '.editBtn', function() {

            let id = $(this).data('id');
            let name = $(this).data('name');
            let email = $(this).data('email');
            let image = $(this).data('image');

            $('#edit_id').val(id);
            $('#edit_name').val(name);
            $('#edit_email').val(email);

            // Destroy old instance if exists
            if ($('#edit_picture').hasClass('dropify')) {
                let dr = $('#edit_picture').dropify();
                dr = dr.data('dropify');
                dr.resetPreview();
                dr.clearElement();
                dr.destroy();
            }

            // Set default image dynamically
            let defaultImg = image ? "<?= base_url() ?>" + image : 'https://placehold.co/70x70';
            $('#edit_picture').attr('data-default-file', defaultImg);

            // Re-initialize Dropify
            $('#edit_picture').dropify({
                messages: {
                    'default': 'Drag your profile picture here or click to browse',
                    'replace': 'Click to replace the profile picture',
                    'remove': 'Remove',
                    'error': 'Sorry, file is too large'
                }
            });

            $('#editAuthorModal').modal('show');
        });


        // Handle edit form submit
        $('#editAuthorForm').on('submit', function(e) {
            e.preventDefault();

            let id = $('#edit_id').val();
            let formData = new FormData(this);

            $.ajax({
                url: "<?= base_url('admin/author-update') ?>/" + id,
                type: "POST",
                data: formData,
                processData: false, // must for FormData
                contentType: false, // must for FormData
                cache: false,
                dataType: "json",
                beforeSend: function() {
                    $('#editAuthorForm button[type="submit"]').prop('disabled', true).text('Updating...');
                },
                success: function(res) {
                    if (res.success) {
                        showSuccessToast(res.message);

                        // Close modal
                        $('#editAuthorModal').modal('hide');

                        setTimeout(() => location.reload(), 800);
                    } else {
                        showDangerToast(res.message || 'Update failed');
                    }
                },
                error: function(err) {
                    console.error('Edit author ajax error', err);
                    showDangerToast('Something went wrong! Try again later.');
                },
                complete: function() {
                    $('#editAuthorForm button[type="submit"]').prop('disabled', false).text('Update');
                }
            });

        });

        $(document).on('click', '.deleteBtn', function() {

            let id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This author will be deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?= base_url('admin/author-delete') ?>/" + id,
                        type: "POST",
                        dataType: "json",

                        success: function(res) {
                            if (res.success) {
                                showSuccessToast(res.message);
                                setTimeout(() => location.reload(), 700);
                            } else {
                                showDangerToast(res.message);
                            }
                        }
                    });

                }

            });

        });

    });
</script>