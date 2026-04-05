<script>
    $(document).ready(function() {

        const highlightId = "<?= $highlightId ?? '' ?>";

        /* -------------------------------
         * DataTable Init
         * ------------------------------- */
        const table = $('#comments-listing').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            searching: true,
            lengthMenu: [10, 25, 50, 100],

            ajax: {
                url: "<?= base_url('admin/api/comments-list') ?>",
                type: "POST",
                data: function(d) {
                    d.type = "<?= $status ?>";
                    d.highlight = "<?= $highlightId ?? '' ?>";
                }
            },

            columns: [{
                    data: 'sl',
                    orderable: false
                },

                {
                    data: 'status',
                    orderable: false,
                    render: function(data) {
                        return data === 1 ?
                            '<span class="badge bg-success">Approved</span>' :
                            '<span class="badge bg-warning">Pending</span>';
                    }
                },

                {
                    data: 'comment',
                    render: function(data) {
                        let safeText = $('<div>').text(data).html();
                        let shortText = safeText.length > 25 ?
                            safeText.substring(0, 25) + '...' :
                            safeText;

                        return `
                    <a href="#!" class="viewcomment" data-text="${safeText}">
                        ${shortText}
                    </a>
                `;
                    }
                },

                {
                    data: null,
                    render: function(row) {
                        return `
                    <strong>${row.guest_name}</strong><br>
                    <small>${row.guest_email}</small>
                `;
                    }
                },

                {
                    data: 'score',
                    render: function(score) {
                        let cls = score >= 0.7 ?
                            'text-success' :
                            (score >= 0.4 ? 'text-warning' : 'text-danger');

                        return `<span class="${cls}">${score.toFixed(2)}</span>`;
                    }
                },

                {
                    data: 'date',
                    render: function(date) {
                        let d = new Date(date);

                        return `
                    ${d.toLocaleDateString()}<br>
                    <small>${d.toLocaleTimeString()}</small>
                `;
                    }
                },

                {
                    data: null,
                    orderable: false,
                    render: function(row) {

                        let actions = `
                    <div class="dropdown">
                        <button class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                            Modify
                        </button>
                        <div class="dropdown-menu">
                `;

                        if (row.status === 0) {
                            actions += `<button class="dropdown-item approveBtn" data-id="${row.id}">Approve</button>`;
                        } else {
                            actions += `
                        <button class="dropdown-item unpublishBtn" data-id="${row.id}">Unpublish</button>
                        <button class="dropdown-item replyBtn"
                            data-id="${row.id}">
                            Reply
                        </button>
                    `;
                        }

                        actions += `
                    <button class="dropdown-item viewpost" data-url="${row.post_url}">View Post</button>
                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item text-danger deleteBtn" data-id="${row.id}">Delete</button>
                    </div>
                </div>
                `;

                        return actions;
                    }
                }
            ],

            drawCallback: function() {
                const highlightId = "<?= $highlightId ?? '' ?>";

                if (highlightId) {
                    const row = $('#comment-row-' + highlightId);
                    if (row.length) {
                        row.addClass('table-warning');
                        row[0].scrollIntoView({
                            behavior: "smooth",
                            block: "center"
                        });
                    }
                }
            }
        });

        /* -------------------------------
         * Common Action Handler
         * ------------------------------- */
        function commentAction({
            url,
            id,
            confirmTitle = 'Are you sure?',
            confirmText = 'This action cannot be undone.',
            confirmButton = 'Yes'
        }) {
            Swal.fire({
                title: confirmTitle,
                text: confirmText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: confirmButton
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
                            table.ajax.reload(null, false); // NO reload page
                        } else {
                            showDangerToast(res.message);
                        }
                    },
                    error() {
                        showDangerToast('Server error');
                    }
                });

            });
        }

        /* -------------------------------
         * ACTIONS
         * ------------------------------- */

        $(document).on('click', '.approveBtn', function() {
            commentAction({
                url: "<?= base_url('admin/comments/approve') ?>",
                id: $(this).data('id'),
                confirmTitle: 'Approve comment?',
                confirmButton: 'Approve'
            });
        });

        $(document).on('click', '.unpublishBtn', function() {
            commentAction({
                url: "<?= base_url('admin/comments/unpublish') ?>",
                id: $(this).data('id'),
                confirmTitle: 'Unpublish comment?',
                confirmButton: 'Unpublish'
            });
        });

        $(document).on('click', '.deleteBtn', function() {
            commentAction({
                url: "<?= base_url('admin/comments/delete') ?>",
                id: $(this).data('id'),
                confirmTitle: 'Delete comment?',
                confirmButton: 'Delete'
            });
        });

        $(document).on('click', '.viewpost', function() {
            window.location.href = $(this).data('url');
        });

        $(document).on('click', '.viewcomment', function(e) {
            e.preventDefault();
            $('#modaltitle').html('Comment');
            $('#reply').val($(this).data('text')).prop('disabled', true);
            $('#viewModal').modal('show');
        });

        /* -------------------------------
         * REPLY MODAL
         * ------------------------------- */
        $(document).on('click', '.replyBtn', function() {

            const id = $(this).data('id');

            // Set ID
            $('#replyCommentId').val(id);

            // Show loading state
            $('#replyText')
                .val('Loading reply...')
                .prop('disabled', true);

            $('#submitReply')
                .text('Please wait...')
                .prop('disabled', true);

            $('#deleteReply').hide();

            // Open modal
            $('#replyModal').modal('show');

            $.ajax({
                url: "<?= base_url('admin/api/get-reply') ?>",
                type: "POST",
                dataType: "json",
                data: {
                    id: id,
                    <?= csrf_token() ?>: "<?= csrf_hash() ?>"
                },

                success: function(res) {

                    // Enable inputs again
                    $('#replyText').prop('disabled', false);
                    $('#submitReply').prop('disabled', false);

                    if (res && res.success && res.reply) {

                        $('#replyText').val(res.reply.comment);
                        $('#submitReply').text('Update');
                        $('#deleteReply').show();

                    } else {

                        $('#replyText').val('');
                        $('#submitReply').text('Reply');
                        $('#deleteReply').hide();
                    }
                },

                error: function() {

                    $('#replyText')
                        .val('')
                        .prop('disabled', false);

                    $('#submitReply')
                        .text('Reply')
                        .prop('disabled', false);

                    showDangerToast('Failed to load reply');
                }
            });

        });

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
                        table.ajax.reload(null, false); // FIXED
                    } else {
                        showDangerToast(res.message);
                    }
                },
                error() {
                    showDangerToast('Server error');
                }
            });
        });

        $('#deleteReply').on('click', function() {

            const commentId = $('#replyCommentId').val();

            $.ajax({
                url: "<?= base_url('admin/reply/delete') ?>",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: commentId,
                    <?= csrf_token() ?>: "<?= csrf_hash() ?>"
                },
                success(res) {
                    if (res.success) {
                        $('#replyModal').modal('hide');
                        showSuccessToast('Reply deleted');
                        table.ajax.reload(null, false);
                    } else {
                        showDangerToast(res.message);
                    }
                },
                error() {
                    showDangerToast('Server error');
                }
            });
        });

    });
</script>