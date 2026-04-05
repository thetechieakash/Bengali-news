<script>
    $(document).ready(function() {

        $('#messages-listing').DataTable();

        /* -----------------------------
           VIEW MESSAGE MODAL
        ------------------------------*/
        $(document).on('click', '.viewBtn', function() {

            let subject = $(this).data('subject');
            let message = $(this).data('message');

            $('#modalSubject').text(subject);
            $('#modalMessage').text(message);

            $('#viewMessageModal').modal('show');

        });


        /* -----------------------------
           DELETE MESSAGE
        ------------------------------*/
        $(document).on('click', '.deletebtn', function() {

            let id = $(this).data('id');
            let row = $(this).closest('tr');

            Swal.fire({
                title: 'Are you sure?',
                text: "This message will be deleted permanently!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?= base_url('admin/messages/delete/') ?>" + id,
                        type: "POST",
                        data: {
                            "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
                        },
                        dataType: "json",

                        success: function(res) {
                            if (res.success) {
                                showSuccessToast(res.message);
                                row.remove();
                            } else {
                                showDangerToast(res.message);
                            }
                        },
                        error: function() {
                            showDangerToast('Server error');
                        }
                    });
                }
            });
        });
    });
</script>