<script>
    $(document).ready(function() {
        $('#document').dropify();
        let loading = false;
        let nextPage = 1;
        let searchQuery = '';
        let searchTimer;
        // Document search with debouncing 
        $('#docSearch').on('keyup', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(function() {
                searchQuery = $('#docSearch').val();
                nextPage = 1;
                loading = false;
                loadDocuments(1);
            }, 400);
        });

        // Load Doc 
        function loadDocuments(page = 1) {
            if (loading || (!nextPage && page !== 1)) return;
            loading = true;
            $.get("<?= base_url('admin/api/get-documents') ?>", {
                page: page,
                search: searchQuery
            }, function(response) {
                const docs = response.data;
                nextPage = response.next_page;
                if (!docs.length && page === 1) {
                    $('.all-documents').html('<p>No documents found</p>');
                    loading = false;
                    return;
                }
                let html = '';
                docs.forEach(function(item) {
                    html += `
                        <div class="col-6 col-md-2 mb-3 document-item" data-name="${item.file_name.toLowerCase()}">
                            <div class="position-relative media-box border rounded p-2">

                                <div class="pdf-preview text-center"
                                    data-url="<?= base_url() ?>${item.file_path}"
                                    style="cursor:pointer">

                                    <i class="fa fa-file-pdf text-danger" style="font-size:48px"></i>

                                    <div class="mb-3">
                                    <i class="fa fa-file-pdf-o fs-3"></i>
                                    </div>

                                </div>

                                <div class="copy-link position-absolute bottom-0 start-0 end-0 text-center small "
                                    data-url="<?= base_url() ?>${item.file_path}"
                                    style="cursor:pointer">
                                    Copy Link
                                </div>
                                <div class="delete-document position-absolute top-0 end-0 m-1"
                                    data-id="${item.id}"
                                    style="cursor:pointer">

                                    <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center"
                                        style="width:22px;height:22px">
                                        <i class="fa fa-times text-white" style="font-size:11px"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                });
                if (page === 1) {
                    $('.all-documents').html('<div class="row" id="doc-grid">' + html + '</div>');
                } else {
                    $('#doc-grid').append(html);
                }
                loading = false;
            });
        }

        loadDocuments();

        // Lazy load 
        $('.all-documents').on('scroll', function() {
            let container = $(this)[0];
            if (container.scrollTop + container.clientHeight >= container.scrollHeight - 50) {
                if (nextPage && !loading) {
                    loadDocuments(nextPage);
                }
            }
        });
        // Upload
        $('#documentForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: "<?= base_url('admin/document/upload') ?>",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.success) {
                        let dr = $('#document').data('dropify');
                        dr.clearElement();
                        showSuccessToast(res.message);
                        loadDocuments(1);
                    } else {
                        showDangerToast(res.error || res.message);
                    }
                }
            });
        });
        // Delete
        $(document).on('click', '.delete-document', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Delete this document?',
                icon: 'warning',
                showCancelButton: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('admin/delete-document') ?>/" + id,
                        type: "DELETE",
                        success: function(res) {
                            if (res.success) {
                                Swal.fire('Deleted', '', 'success');
                                loadDocuments();
                            }
                        }
                    });
                }
            });
        });

        // Preview 
        $(document).on('click', '.pdf-preview', function() {
            let url = $(this).data('url');
            $('#pdfFrame').attr('src', url);
            $('#pdfPreviewModal').modal('show');
        });
        // Copy link
        $(document).on('click', '.copy-link', function() {
            let url = $(this).data('url');
            navigator.clipboard.writeText(url)
                .then(() => showSuccessToast('Link copied'))
                .catch(() => alert(url));
        });
    });
</script>