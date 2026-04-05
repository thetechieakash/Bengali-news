<script>
    $(function() {

        const BASE_URL = '<?= base_url() ?>';

        /* -----------------------------------------------
         * Server-side DataTable
         * --------------------------------------------- */
        const table = $('#tag-listing').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,

            ajax: {
                url: BASE_URL + 'admin/api/tags-list',
                type: 'GET',
            },

            columns: [{
                    data: 'sl',
                    orderable: false
                },
                {
                    data: 'name',
                    orderable: true
                },
                {
                    data: null,
                    orderable: false,
                    render: function(data) {
                        return `
                        <div class="dropdown">
                            <button class="btn btn-success btn-sm dropdown-toggle"
                                data-bs-toggle="dropdown">Modify</button>
                            <div class="dropdown-menu">
                                <button class="dropdown-item editBtn"
                                    data-id="${data.id}"
                                    data-name="${data.name}">Edit</button>
                                <button class="dropdown-item deleteBtn"
                                    data-id="${data.id}">Delete</button>
                            </div>
                        </div>
                    `;
                    }
                }
            ],

            order: [
                [1, 'asc']
            ],

            language: {
                emptyTable: 'No tags found',
                zeroRecords: 'No matching tags found',
                processing: 'Loading...',
            }
        });

        /* -----------------------------------------------
         * ADD TAG
         * --------------------------------------------- */
        $('#tagForm').on('submit', function(e) {
            e.preventDefault();

            const name = $('#tagName').val().trim();
            if (!name) {
                showDangerToast('Tag name is required');
                return;
            }

            $.ajax({
                url: BASE_URL + 'admin/tag/create',
                type: 'POST',
                data: {
                    tag: name,
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                },
                success(res) {
                    if (res.success) {
                        showSuccessToast(res.message);
                        $('#tagName').val('');
                        table.ajax.reload(null, false);
                    } else {
                        showDangerToast(res.message || 'Failed to create tag');
                    }
                },
                error() {
                    showDangerToast('Something went wrong');
                }
            });
        });

        /* -----------------------------------------------
         * EDIT TAG — open modal
         * --------------------------------------------- */
        $('#tag-listing').on('click', '.editBtn', function() {
            $('#editTagId').val($(this).data('id'));
            $('#editTagName').val($(this).data('name'));
            $('#editTagModal').modal('show');
        });

        $('#saveEditBtn').on('click', function() {
            const id = $('#editTagId').val();
            const name = $('#editTagName').val().trim();

            if (!name) {
                showDangerToast('Tag name is required');
                return;
            }

            $(this).prop('disabled', true);

            $.ajax({
                url: BASE_URL + 'admin/tag/update',
                type: 'POST',
                data: {
                    id: id,
                    tag: name,
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                },
                success(res) {
                    if (res.success) {
                        showSuccessToast(res.message);
                        $('#editTagModal').modal('hide');
                        table.ajax.reload(null, false);
                    } else {
                        showDangerToast(res.message || 'Update failed');
                    }
                },
                error() {
                    showDangerToast('Something went wrong');
                },
                complete() {
                    $('#saveEditBtn').prop('disabled', false);
                }
            });
        });

        /* -----------------------------------------------
         * DELETE TAG
         * --------------------------------------------- */
        $('#tag-listing').on('click', '.deleteBtn', function() {
            const id = $(this).data('id');

            Swal.fire({
                title: 'Delete Tag?',
                text: 'This tag will be permanently deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete',
                confirmButtonColor: '#dc3545',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (!result.isConfirmed) return;

                $.ajax({
                    url: BASE_URL + 'admin/tag/delete',
                    type: 'POST',
                    data: {
                        id: id,
                        <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                    },
                    success(res) {
                        if (res.success) {
                            showSuccessToast(res.message);
                            table.ajax.reload(null, false);
                        } else {
                            showDangerToast(res.message || 'Delete failed');
                        }
                    },
                    error() {
                        showDangerToast('Something went wrong');
                    }
                });
            });
        });

    });
</script>