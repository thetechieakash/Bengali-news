<script>
    $(document).ready(function() {

        CKEDITOR.replace('editor', {
            height: '400px'
        });

        $('#pageForm').on('submit', function(e) {
            e.preventDefault();

            let description = CKEDITOR.instances.editor.getData();
            let formData = new FormData(this);
            formData.set('description', description);
            $.ajax({
                url: "<?= base_url('admin/pages/save') ?>",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend: function() {
                    $('.btn-primary').prop('disabled', true).text('Saving...');
                },
                success: function(res) {
                    if (res.success) {
                        showSuccessToast(res.message);
                    } else {
                        showDangerToast(res.message);
                    }
                },
                complete: function() {
                    $('.btn-primary').prop('disabled', false).text('Save Page');
                },
                error(err) {
                    showDangerToast('Server error');
                }
            });
        });
    });
</script>