<script>
    $(document).ready(function() {
        // Data table config
        const table = $('#news-listing').DataTable();
        const highlightId = "<?= $highlightId ?? '' ?>";

        if (highlightId) {

            const rowNode = table.rows().nodes().to$().filter('#post-row-' + highlightId);

            if (rowNode.length) {

                const rowIndex = table.row(rowNode).index();
                const pageIndex = Math.floor(rowIndex / table.page.len());

                // Go to correct page
                table.page(pageIndex).draw(false);

                // Wait for redraw
                setTimeout(function() {

                    const row = $('#post-row-' + highlightId);

                    row.addClass('table-warning');
                    row.fadeOut(200)
                        .fadeIn(200)
                        .fadeOut(200)
                        .fadeIn(200);

                    row[0].scrollIntoView({
                        behavior: "smooth",
                        block: "center"
                    });

                }, 300);
            }
        }

        // Edit function redirect to edit page
        $(document).on('click', '.editBtn', function() {

            let id = $(this).data('id');
            if (!id) {
                showDangerToast('Invalid post');
                return;
            }
            window.location.href = "<?= base_url('admin/news/update') ?>/" + id;
        });
        let commentTable;

        function getComments(id, type) {

            $.ajax({
                type: "GET",
                url: "<?= base_url('admin/api/get-comment') ?>",
                data: {
                    id: id,
                    type: type
                },
                dataType: "json",
                success: function(res) {

                    if (!res.status) {
                        showDangerToast(res.message);
                        return;
                    }
                    console.log(res);

                    loadCommentTable(res.comments);
                    $('#commentModal').modal('show');
                }
            });
        }

        function loadCommentTable(comments) {

            // Destroy if already exists
            if ($.fn.DataTable.isDataTable('#commentTable')) {
                $('#commentTable').DataTable().destroy();
            }

            $('#commentTable tbody').empty();

            comments.forEach(function(comment) {

                let statusBadge = comment.status == 1 ?
                    '<span class="badge badge-success">Approved</span>' :
                    '<span class="badge badge-warning">Pending</span>';

                $('#commentTable tbody').append(`
            <tr>
                <td>${statusBadge}</td>
                <td>${truncateByWord(comment.comment,30)}</td>
                <td>${comment.guest_name ?? 'Admin'}</td>
                <td>${comment.created_at}</td>
                <td>
                    <button 
                        class="btn btn-dark view-comment"
                        data-id="${comment.id}"
                        data-status="${comment.status}">
                        View
                    </button>
                </td>
            </tr>
        `);
            });

            commentTable = $('#commentTable').DataTable({
                destroy: true,
                responsive: true,
                pageLength: 5,
                order: [
                    [3, 'desc']
                ]
            });
        }

        function truncateByWord(phrase, length) {
            if (phrase.length <= length) {
                return phrase;
            }
            let trimmed = phrase.slice(0, length);
            // Trim to the last space to avoid cutting a word in half
            trimmed = trimmed.slice(0, trimmed.lastIndexOf(' '));
            return trimmed + '...';
        }

        $('#news-listing').on('click', '.approved-comments', function(e) {
            e.preventDefault();
            getComments($(this).data('id'), 'approve');
        });

        $('#news-listing').on('click', '.pending-comments', function(e) {
            e.preventDefault();
            getComments($(this).data('id'), 'pending');
        });

        $('#commentTable').on('click', '.view-comment', function() {

            const id = $(this).data('id');
            const status = $(this).data('status');

            if (status == 1) {
                window.location.href = "<?= base_url('admin/approved-comments') ?>?highlight=" + id;
            } else {
                window.location.href = "<?= base_url('admin/pending-comments') ?>?highlight=" + id;
            }
        });

        /* --------------------------------
         * STATUS TOGGLE (SweetAlert)
         * -------------------------------- */
        $('#news-listing').on('change', '.toggle-status', function() {

            const checkbox = $(this);
            const id = checkbox.data('id');
            const newValue = checkbox.is(':checked') ? 1 : 0;
            const oldValue = newValue === 1 ? 0 : 1;

            // rollback helper
            const rollback = () => checkbox.prop('checked', !!oldValue);

            Swal.fire({
                title: newValue ?
                    'Publish this post?' : 'Unpublish this post?',
                html: newValue ?
                    `<small>The post date will be updated to <b>current date & time</b>.</small>` : `<small>The post will be moved back to <b>draft</b>.</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: newValue ? 'Yes, publish' : 'Yes, unpublish',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#1F3BB3',
                cancelButtonColor: '#6c757d',
                reverseButtons: true
            }).then(async (result) => {

                if (!result.isConfirmed) {
                    rollback();
                    return;
                }

                checkbox.prop('disabled', true);

                try {
                    const res = await fetch('<?= base_url('admin/news/update-status') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            id,
                            value: newValue
                        })
                    });

                    const data = await res.json();

                    if (!data.success) {
                        rollback();
                        showDangerToast(data.message || 'Status update failed');
                    } else {
                        showSuccessToast(data.message);
                    }

                } catch (e) {
                    rollback();
                    showDangerToast('Something went wrong');
                    console.error(e);
                } finally {
                    checkbox.prop('disabled', false);
                }
            });
        });

        /* --------------------------------
         * DELETE POST (SweetAlert)
         * -------------------------------- */
        $(document).on('click', '.deleteBtn', function() {

            const id = $(this).data('id');

            Swal.fire({
                title: 'Delete this post?',
                text: 'This action cannot be undone!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                reverseButtons: true
            }).then((result) => {

                if (!result.isConfirmed) return;

                $.ajax({
                    url: "<?= base_url('admin/news/delete') ?>/" + id,
                    type: "POST",
                    dataType: "json",
                    success(res) {
                        if (res.success) {
                            showSuccessToast(res.message);
                            setTimeout(() => location.reload(), 800);
                        } else {
                            showDangerToast(res.message || 'Delete failed');
                        }
                    },
                    error(err) {
                        showDangerToast('Something went wrong');
                        console.error('Delete error:', err);
                    }
                });
            });
        });

    });
</script>