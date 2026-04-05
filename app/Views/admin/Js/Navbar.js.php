<script>
    $(document).ready(function() {

        let isChanged = false;

        // Sortable init
        new Sortable(document.getElementById('sortableList'), {
            animation: 150,
            ghostClass: 'bg-light',
            handle: '.handle',
            onEnd: function() {
                isChanged = true;
            }
        });

        // Save order
        $('#saveOrder').on('click', function() {

            let order = [];

            $('#sortableList li').each(function(index) {
                order.push({
                    id: $(this).data('id'),
                    position: index + 1
                });
            });

            let csrfName = $('#csrf_name').val();
            let csrfHash = $('#csrf_hash').val();

            $.ajax({
                url: "<?= base_url('admin/navbar/update-order') ?>",
                type: "POST",
                data: JSON.stringify({
                    order: order,
                    [csrfName]: csrfHash
                }),
                contentType: "application/json",
                dataType: "json",

                beforeSend: function() {
                    $('#saveOrder').prop('disabled', true).text('Saving...');
                },

                success: function(res) {
                    if (res.success) {
                        isChanged = false;
                        showSuccessToast(res.message)

                    } else {
                        showDangerToast(res.message);
                    }
                },

                error: function(xhr) {
                    console.error(xhr);
                    showDangerToast('Server error occurred');

                },

                complete: function() {
                    $('#saveOrder').prop('disabled', false).text('Save Order');
                }
            });

        });

        // Warn before leaving
        $(window).on('beforeunload', function() {
            if (isChanged) {
                return "You have unsaved changes!";
            }
        });

    });
</script>