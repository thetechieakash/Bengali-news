<?= $this->extend('layouts/ViewLayout.php') ?>
<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('cssPlugins') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/jquery-toast-plugin/jquery.toast.min.css">
<?= $this->endSection() ?>
<?= $this->section('w-full') ?>
<div class="col-sm-12 col-md-10 px-0">
    <div class="home-tab">
        <section class="utf_block_wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 contact_area">
                        <h3>Leave a Message</h3>
                        <form id="contactForm">
                            <?= csrf_field() ?>
                            <input type="hidden" name="g-recaptcha-response" id="recaptcha_token">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input class="form-control form-control-name" name="name" id="name" placeholder="Name" type="text" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control form-control-email" name="email" id="email" placeholder="Email" type="email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input class="form-control form-control-phone" name="phone" id="phone" placeholder="Phone" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <input class="form-control form-control-subject" name="subject" id="subject" placeholder="Subject" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control form-control-message" name="message" id="message" placeholder="Message..." rows="10" required></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary solid blank" type="submit">Send Message</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-4 col-md-12 contact_detail_area">
                        <div class="sidebar utf_sidebar_right">
                            <div class="widget">
                                <h3 class="utf_block_title"><span>Office Address</span></h3>
                                <ul class="contct_detail_list">
                                    <li><i class="fa fa-home"></i>Lorem ipsum dolor sit amet, consecte adipiscing elit Maecenas in pulvinar neque Nulla finibus lobortis.</li>
                                    <li><i class="fa fa-phone"></i> <a href="#">(+12) 34567 890 123</a></li>
                                    <li><i class="fa fa-envelope-o"></i> <a href="#">mail@example.com</a></li>
                                    <li><i class="fa fa-info-circle"></i> <a href="<?= base_url() ?>">www.puruliamirror.com</a></li>
                                </ul>
                            </div>

                            <div class="widget">
                                <h3 class="utf_block_title"><span>Follow Us</span></h3>
                                <ul class="social-icon">
                                    <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#" target="_blank"><i class="fa fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('jsPlugins') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url() ?>assets/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
<script src="<?= base_url() ?>assets/customs/js/custom.toast.js"></script>
<script src="https://www.google.com/recaptcha/api.js?render=<?= $recaptcha_key ?>"></script>
<?= $this->endSection() ?>
<?= $this->section('customjs') ?>
<script>
    $(document).on('submit', '#contactForm', function(e) {
        e.preventDefault();
        grecaptcha.ready(function() {
            grecaptcha.execute('<?= $recaptcha_key ?>', {
                    action: 'contact'
                })
                .then(function(token) {
                    $('#recaptcha_token').val(token);
                    $.ajax({
                        url: "<?= base_url('contact/send') ?>",
                        type: "POST",
                        data: $('#contactForm').serialize(),
                        dataType: "json",
                        beforeSend: function() {
                            $('#contactForm button')
                                .prop('disabled', true)
                                .text('Sending...');
                        },
                        success: function(res) {
                            if (res.success) {
                                $('#contactForm')[0].reset();
                                showSuccessToast(res.message)
                            } else {
                                if (res.errors) {
                                    Object.values(res.errors).forEach(function(msg) {
                                        showDangerToast(msg);
                                    });
                                }
                                if (res.message) {
                                    showDangerToast(res.message);
                                }
                            }
                        },
                        error: function(err) {
                            console.error('Message send error', err);
                            showDangerToast("Something went wrong! try again later");
                        },
                        complete: function() {
                            $('#contactForm button')
                                .prop('disabled', false)
                                .text('Send Message');
                        }
                    });
                });
        });
    });
</script>
<?= $this->endSection() ?>