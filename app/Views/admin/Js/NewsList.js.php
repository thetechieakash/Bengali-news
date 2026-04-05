<script>
    $(document).ready(function() {

        const BASE_URL = '<?= base_url(); ?>';
        const STATUS = '<?= $status ?>';
        const IS_SUPER_ADMIN = <?= $isSuperAdmin ? 'true' : 'false' ?>;
        const highlightId = "<?= $highLightId ?? '' ?>";

        /* --------------------------------
         * DYNAMIC COLUMN BUILD
         * -------------------------------- */
        let columns = [{
                data: "sl",
                orderable: true, // SL # sortable
                name: "sl"
            },
            {
                data: null,
                orderable: true,
                name: "news_posts.headline",
                render: function(data) {
                    let link = data.status == 1 ?
                        BASE_URL + "news/" + data.slug :
                        BASE_URL + "admin/news-preview/" + data.slug;

                    return `
                    <a href="${link}" target="_blank">
                        ${truncateText(data.headline, 40)}
                    </a>
                    <div class="mt-2">
                        <p class="text-primary mb-1">Views: ${data.views}</p>
                        <p class="text-primary mb-1">Comments: ${data.total_comments}</p>
                    </div>
                `;
                }
            }
        ];

        // Author column (superadmin only)
        if (IS_SUPER_ADMIN) {
            columns.push({
                data: "author",
                name: "users.username",
                orderable: true,
                render: data => `<span class="badge badge-info">${data}</span>`
            });
        }

        // Comments column (not sortable)
        columns.push({
            data: null,
            orderable: false,
            render: function(data) {
                if (data.total_comments == 0) {
                    return `<span class="badge badge-danger">No Comments</span>`;
                }
                let html = '';
                if (data.approved_comments > 0) {
                    html += `<a href="#" class="approved-comments" data-id="${data.id}">
                    <span class="badge badge-success">Approved (${data.approved_comments})</span>
                </a> `;
                }
                if (data.pending_comments > 0) {
                    html += `<a href="#" class="pending-comments" data-id="${data.id}">
                    <span class="badge badge-warning">Pending (${data.pending_comments})</span>
                </a>`;
                }
                return html;
            }
        });

        // Post Date column
        columns.push({
            data: "date",
            name: "news_posts.created_at",
            orderable: true
        });

        // Status column
        columns.push({
            data: null,
            name: "news_posts.status",
            orderable: true,
            render: function(data) {
                return `
                <label class="toggle-switch mb-0">
                    <input type="checkbox"
                        class="toggle-status"
                        data-id="${data.id}"
                        ${data.status == 1 ? 'checked' : ''}>
                    <span class="slider"></span>
                </label>
            `;
            }
        });

        // Actions column (not sortable)
        columns.push({
            data: null,
            orderable: false,
            render: function(data) {
                return `
                <div class="dropdown">
                    <button class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                        Modify
                    </button>
                    <div class="dropdown-menu">
                        <button class="dropdown-item editBtn" data-id="${data.id}">Edit</button>
                        <button class="dropdown-item deleteBtn" data-id="${data.id}">Delete</button>
                    </div>
                </div>
            `;
            }
        });

        /* --------------------------------
         * RESOLVE DATE COLUMN INDEX
         * superadmin:  0=SL,1=Post,2=Author,3=Comments,4=Date,5=Status,6=Actions
         * regular:     0=SL,1=Post,2=Comments,3=Date,4=Status,5=Actions
         * -------------------------------- */
        const dateColIndex = IS_SUPER_ADMIN ? 4 : 3;

        /* --------------------------------
         * DATATABLE INIT
         * -------------------------------- */
        const table = $('#news-listing').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,

            ajax: {
                url: BASE_URL + "admin/api/news-list",
                type: "GET",
                data: function(d) {
                    d.status = STATUS;
                }
            },

            columns: columns,

            //  Default sort: Date column DESC on page load
            order: [
                [dateColIndex, 'desc']
            ],

            // Map column names so DataTables sends correct index to server
            columnDefs: [{
                targets: 0,
                name: 'sl'
            }],
            createdRow: function(row, data) {
                $(row).attr('data-id', data.id);
            }
        });
        if (highlightId) {
            table.search(highlightId).draw();
        }

        // Step 2: After table is drawn, highlight row
        table.on('draw', function() {
            if (!highlightId) return;
            const row = $('#news-listing tbody tr').filter(function() {
                return $(this).find('[data-id="' + highlightId + '"]').length > 0;
            });
            if (row.length) {
                row.addClass('table-warning');
                row.fadeOut(200).fadeIn(200);
                row[0].scrollIntoView({
                    behavior: "smooth",
                    block: "center"
                });
            }
        });
        //  rest of your event handlers unchanged

        /* --------------------------------
         * HELPERS
         * -------------------------------- */
        function truncateText(text, length) {
            if (!text) return '';
            return text.length > length ? text.substring(0, length) + '...' : text;
        }

        function truncateByWord(text, length) {
            if (text.length <= length) return text;
            let trimmed = text.substr(0, length);
            return trimmed.substr(0, trimmed.lastIndexOf(' ')) + '...';
        }

        /* --------------------------------
         * EDIT
         * -------------------------------- */
        $(document).on('click', '.editBtn', function() {
            let id = $(this).data('id');
            if (!id) return showDangerToast('Invalid post');

            window.location.href = BASE_URL + "admin/news/update/" + id;
        });

        /* --------------------------------
         * COMMENTS MODAL
         * -------------------------------- */
        let commentTable;

        function getComments(id, type) {
            $.get(BASE_URL + "admin/api/get-comment", {
                id,
                type
            }, function(res) {

                if (!res.status) {
                    showDangerToast(res.message);
                    return;
                }
                loadCommentTable(res.comments);
                $('#commentModal').modal('show');

            }, 'json');
        }

        function loadCommentTable(comments) {

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
                    <td>${truncateByWord(comment.comment, 30)}</td>
                    <td>${comment.guest_name ?? 'Admin'}</td>
                    <td>${comment.created_at}</td>
                    <td>
                        <button class="btn btn-dark view-comment"
                            data-id="${comment.id}"
                            data-status="${comment.status}">
                            View
                        </button>
                    </td>
                </tr>
            `);
            });

            commentTable = $('#commentTable').DataTable({
                pageLength: 5,
                order: [
                    [3, 'desc']
                ]
            });
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

            window.location.href = BASE_URL +
                (status == 1 ? "admin/approved-comments" : "admin/pending-comments") +
                "?highlight=" + id;
        });

        /* --------------------------------
         * STATUS TOGGLE
         * -------------------------------- */
        $('#news-listing').on('change', '.toggle-status', function() {

            const checkbox = $(this);
            const id = checkbox.data('id');

            const newValue = checkbox.is(':checked') ? 1 : 0;
            const oldValue = newValue === 1 ? 0 : 1;

            const rollback = () => checkbox.prop('checked', !!oldValue);

            Swal.fire({
                title: newValue ? 'Publish this post?' : 'Unpublish this post?',
                text: newValue ? 'This news will post now' : '',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: newValue ? 'Yes, publish' : 'Yes, unpublish',
                reverseButtons: true
            }).then(async (result) => {

                if (!result.isConfirmed) return rollback();

                checkbox.prop('disabled', true);

                try {
                    const res = await fetch(BASE_URL + "admin/news/update-status", {
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
                        showDangerToast(data.message);
                    } else {
                        showSuccessToast(data.message);
                        table.ajax.reload(null, false);
                    }

                } catch (e) {
                    rollback();
                    showDangerToast('Something went wrong');
                } finally {
                    checkbox.prop('disabled', false);
                }
            });
        });

        /* --------------------------------
         * DELETE
         * -------------------------------- */
        $(document).on('click', '.deleteBtn', function() {

            const id = $(this).data('id');

            Swal.fire({
                title: 'Delete this post?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete',
                confirmButtonColor: '#dc3545'
            }).then((result) => {

                if (!result.isConfirmed) return;

                $.post(BASE_URL + "admin/news/delete/" + id, function(res) {

                    if (res.success) {
                        showSuccessToast(res.message);
                        table.ajax.reload(null, false);
                    } else {
                        showDangerToast(res.message);
                    }

                }, 'json').fail(() => {
                    showDangerToast('Something went wrong');
                });
            });
        });

    });
</script>