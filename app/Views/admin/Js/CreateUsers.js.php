<script>
    $(document).ready(function() {
        document.getElementById('togglePassword').addEventListener('click', function() {
            const input = document.getElementById('password');
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
        $("#createUser").submit(function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const btn = $(this).find('button[type="submit"]').prop('disabled', true);

            $.ajax({
                url: "<?= base_url('admin/user/create') ?>",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success(res) {
                    if (res.success) {
                        showSuccessToast(res.message);
                        $("#createUser")[0].reset();

                        setTimeout(() => window.location.href = res.redirect, 1000);
                    } else {
                        if (res.errors) {
                            Object.values(res.errors).forEach(err => {
                                showDangerToast(err);
                            });
                        } else {
                            showDangerToast(res.message);
                        }
                    }
                },
                error(e) {
                    showDangerToast('Something went wrong');
                    console.error("User create ajax error", e);

                },
                complete() {
                    btn.prop('disabled', false);
                }
            });
        });
    });
</script>