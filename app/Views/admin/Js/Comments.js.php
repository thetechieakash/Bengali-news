<script>
    $(document).ready(function() {

        /* -------------------------------
         * DataTable Init
         * ------------------------------- */
        const table = $('#comments-listing').DataTable();

        /* -------------------------------
         * Reusable comment action handler
         * ------------------------------- */
        function commentAction({
            url,
            id,
            row,
            confirmTitle = 'Are you sure?',
            confirmText = 'This action cannot be undone.',
            confirmButton = 'Yes',
            onSuccess = null
        }) {

            Swal.fire({
                title: confirmTitle,
                text: confirmText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: confirmButton,
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {

                if (!result.isConfirmed) return;

                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id,
                        <?= csrf_token() ?>: "<?= csrf_hash() ?>"
                    },
                    success(res) {
                        if (res.success) {
                            showSuccessToast(res.message);

                            if (typeof onSuccess === 'function') {
                                onSuccess(row);
                            }
                        } else {
                            showDangerToast(res.message || 'Action failed');
                        }
                    },
                    error() {
                        showDangerToast('Server error. Try again.');
                    }
                });

            });
        }

        /* -------------------------------
         * APPROVE COMMENT
         * ------------------------------- */
        $(document).on('click', '.approveBtn', function() {
            const id = $(this).data('id');
            const row = $(this).closest('tr');

            commentAction({
                url: "<?= base_url('admin/comments/approve') ?>",
                id: id,
                row: row,
                confirmTitle: 'Approve comment?',
                confirmText: 'This comment will be visible publicly.',
                confirmButton: 'Approve',
                onSuccess: function(row) {

                    // Status badge
                    row.find('td:eq(1)')
                        .html('<span class="badge bg-success">Approved</span>');

                    // Dropdown actions
                    const menu = row.find('.dropdown-menu');
                    menu.find('.approveBtn').remove();

                    if (!menu.find('.unpublishBtn').length) {
                        menu.prepend(
                            `<button class="dropdown-item unpublishBtn" data-id="${id}">
                                Unpublish
                            </button>`
                        );
                    }
                }
            });
        });

        /* -------------------------------
         * UNPUBLISH COMMENT
         * ------------------------------- */
        $(document).on('click', '.unpublishBtn', function() {
            const id = $(this).data('id');
            const row = $(this).closest('tr');

            commentAction({
                url: "<?= base_url('admin/comments/unpublish') ?>",
                id: id,
                row: row,
                confirmTitle: 'Unpublish comment?',
                confirmText: 'This comment will be hidden from the site.',
                confirmButton: 'Unpublish',
                onSuccess: function(row) {

                    // Status badge
                    row.find('td:eq(1)')
                        .html('<span class="badge bg-warning">Pending</span>');

                    // Dropdown actions
                    const menu = row.find('.dropdown-menu');
                    menu.find('.unpublishBtn').remove();

                    if (!menu.find('.approveBtn').length) {
                        menu.prepend(
                            `<button class="dropdown-item approveBtn" data-id="${id}">
                                Approve
                            </button>`
                        );
                    }
                }
            });
        });

        /* -------------------------------
         * DELETE COMMENT
         * ------------------------------- */
        $(document).on('click', '.deleteBtn', function() {
            const id = $(this).data('id');
            const row = $(this).closest('tr');

            commentAction({
                url: "<?= base_url('admin/comments/delete') ?>",
                id: id,
                row: row,
                confirmTitle: 'Delete comment?',
                confirmText: 'This action cannot be undone.',
                confirmButton: 'Delete',
                onSuccess: function(row) {
                    table
                        .row(row)
                        .remove()
                        .draw(false);
                }
            });
        });

        $(document).on('click', '.viewcomment', function(e) {
            e.preventDefault();
            $('#modaltitle').html('Comment');
            $('#reply').val($(this).data('text')).prop('disabled', true);
            $('#viewModal').modal('show');
        })
        /* -------------------------------
         * OPEN REPLY MODAL
         * ------------------------------- */
        $(document).on('click', '.replyBtn', function() {
            const commentId = $(this).data('id');
            const replyText = $(this).data('reply') || '';

            $('#replyCommentId').val(commentId);
            $('#replyText').val(replyText); // textarea
            $('#replyModal').modal('show');
        });

        /* -------------------------------
         * SUBMIT ADMIN REPLY
         * ------------------------------- */
        $('#submitReply').on('click', function() {

            const commentId = $('#replyCommentId').val();
            const replyText = $('#replyText').val().trim();

            if (!replyText) {
                showDangerToast('Reply cannot be empty');
                return;
            }

            $.ajax({
                url: "<?= base_url('admin/comments/reply') ?>",
                type: 'POST',
                dataType: 'json',
                data: {
                    comment_id: commentId,
                    reply: replyText,
                    <?= csrf_token() ?>: "<?= csrf_hash() ?>"
                },
                success(res) {
                    if (res.success) {
                        $('#replyModal').modal('hide');
                        showSuccessToast(res.message);
                        setTimeout(() => location.reload(), 800);
                    } else {
                        showDangerToast(res.message);
                    }
                },
                error() {
                    showDangerToast('Server error. Try again.');
                }
            });
        });

    });
</script>