<script>
    $(document).ready(function() {
        // DataTable
        $('#tag-listing').DataTable();

        /* -----------------------------
                ADD TAG
            ------------------------------*/
        $('#tagform').on('submit', function(e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            const tagName = $('#tag').val().trim();

            if (!tagName) {
                showDangerToast('Tag name is required');
                return;
            }

            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success(res) {
                    if (res.success) {
                        showSuccessToast(res.message);
                        form.reset();
                        setTimeout(() => location.reload(), 700);
                    } else {
                        showDangerToast(res.message || 'Tag create failed');
                    }
                },
                error() {
                    showDangerToast('Something went wrong');
                }
            });
        });
        /* -----------------------------
        EDIT TAG
    ------------------------------*/
        $('#tag-listing').on('click', '.editBtn', async function() {
            const id = $(this).data('id');

            const { value: tagName } = await Swal.fire({
                title: 'Edit Tag',
                input: 'text',
                inputLabel: 'Tag name',
                inputPlaceholder: 'Enter tag name',
                showCancelButton: true,
                confirmButtonText: 'Update',
                cancelButtonText: 'Cancel',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Tag name is required';
                    }
                }
            });

            if (!tagName) return;

            $.ajax({
                url: "<?= base_url('admin/tag/update') ?>",
                type: "POST",
                data: {
                    id: id,
                    tag: tagName,
                    <?= csrf_token() ?>: "<?= csrf_hash() ?>"
                },
                success(res) {
                    if (res.success) {
                        showSuccessToast(res.message);
                        setTimeout(() => location.reload(), 700);
                    } else {
                        showDangerToast(res.message || 'Update failed');
                    }
                },
                error() {
                    showDangerToast('Something went wrong');
                }
            });
        });


        /* -----------------------------
            DELETE TAG
        ------------------------------*/
        $('#tag-listing').on('click', '.deletebtn', async function() {
            const id = $(this).data('id');

            const confirmed = await Swal.fire({
                title: 'Delete Tag?',
                text: 'This tag will be permanently deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            });

            if (!confirmed.isConfirmed) return;

            $.ajax({
                url: "<?= base_url('admin/tag/delete') ?>",
                type: "POST",
                data: {
                    id: id,
                    <?= csrf_token() ?>: "<?= csrf_hash() ?>"
                },
                success(res) {
                    if (res.success) {
                        showSuccessToast(res.message);
                        setTimeout(() => location.reload(), 700);
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
</script>