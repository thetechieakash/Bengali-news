<script>
    $(document).ready(function() {

        const table = $('#news-listing').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: BASE_URL + "admin/api/news-list",
                type: "GET",
                data: function(d) {
                    d.status = STATUS; // from controller
                }
            },

            columns: [{
                    data: "sl"
                },

                {
                    data: null,
                    render: function(data) {
                        let link = data.status == 1 ?
                            `/news/${data.slug}` :
                            `/admin/news-preview/${data.slug}`;

                        return `
                        <a href="${link}" target="_blank">
                            ${truncateText(data.headline, 30)}
                        </a>
                        <div class="mt-2">
                            <span class="badge badge-outline-primary">
                                Views: ${data.views}
                            </span>
                            <span class="badge badge-outline-primary">
                                Comments: ${data.total_comments}
                            </span>
                        </div>
                    `;
                    }
                },

                {
                    data: null,
                    render: function(data) {

                        if (data.total_comments == 0) {
                            return `<span class="badge badge-danger">No Comments</span>`;
                        }

                        return `
                        ${data.approved_comments > 0 ? `
                        <a href="#" class="approved-comments" data-id="${data.id}">
                            <span class="badge badge-success">
                                Approved (${data.approved_comments})
                            </span>
                        </a>` : ''}

                        ${data.pending_comments > 0 ? `
                        <a href="#" class="pending-comments" data-id="${data.id}">
                            <span class="badge badge-warning">
                                Pending (${data.pending_comments})
                            </span>
                        </a>` : ''}
                    `;
                    }
                },

                {
                    data: "date"
                },

                {
                    data: null,
                    render: function(data) {
                        return `
                        <label class="toggle-switch">
                            <input type="checkbox"
                                class="toggle-status"
                                data-id="${data.id}"
                                ${data.status == 1 ? 'checked' : ''}>
                            <span class="slider"></span>
                        </label>
                    `;
                    }
                },

                {
                    data: null,
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
                }
            ]
        });

        /* -------------------------
           HELPERS
        ------------------------- */

        function truncateText(text, len) {
            return text.length > len ? text.substring(0, len) + '...' : text;
        }

        /* -------------------------
           EVENTS
        ------------------------- */

        $(document).on('click', '.editBtn', function() {
            let id = $(this).data('id');
            window.location.href = BASE_URL + "admin/news/update/" + id;
        });

        $(document).on('click', '.approved-comments', function(e) {
            e.preventDefault();
            getComments($(this).data('id'), 'approve');
        });

        $(document).on('click', '.pending-comments', function(e) {
            e.preventDefault();
            getComments($(this).data('id'), 'pending');
        });

    });
</script>