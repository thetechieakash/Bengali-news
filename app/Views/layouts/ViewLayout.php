<!DOCTYPE html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>News Now || <?= $this->renderSection('pageTitle') ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/vendor.bundle.base.css">

    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/glightbox/glightbox.min.css" />
    <?= $this->renderSection('cssPlugins') ?>
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/horizontal-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.png" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/customs/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/customs/css/custom.css">
</head>

<body>
    <!-- Start Pre Loader -->
    <div id="global-loader" class="light-loader">
        <img src="<?= base_url('assets/images/ripple.svg') ?>" class="loader-img" alt="Loader">
    </div>
    <!-- End Pre Loader -->
    <div class="container-scroller">
        <!-- partial:partials/_horizontal-navbar.html -->
        <?= $this->include('user/Components/HorizontalNavbar.php') ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 px-0 px-md-3">
                                <div class="home-tab">
                                    <!-- News ticker  -->
                                    <div class="mx-auto px-md-3" style="max-width: 1100px;">
                                        <?php $carousels = [
                                            'চন্দ্রকোনায় কনভয়ে হামলা! সিবিআই তদন্তের দাবিতে হাই কোর্টে শুভেন্দু',
                                            'বাংলাদেশে ফের মৌলবাদীদের হাতে খুন হিন্দু যুবক',
                                            'তপসিয়ায় চাকা ফেটে বাস দুর্ঘটনা, আহত অন্তত ১৬',
                                            'উত্তুরে হাওয়ার দাপট! মকর সংক্রান্তিতে কাঁপবে তিলোত্তমা',
                                            'ভারতের উপর ফের ২৫ শতাংশ শুল্ক চাপাল আমেরিকা',
                                            'সাতসকালে ব্যাহত মেট্রো পরিষেবা',
                                            'এসআইআর শুনানিতে ডাক লক্ষ্মীরতন শুক্লকে',
                                            'ইরানে গ্রেপ্তার ভারতীয়রা? মুখ খুলল প্রশাসন'
                                        ]; ?>
                                        <div class="container my-2 px-0">
                                            <div class="breaking-wrapper d-flex align-items-center shadow-lg">
                                                <!-- LEFT LABEL -->
                                                <div class="breaking-label">
                                                    BREAKING NEWS
                                                </div>
                                                <!-- TICKER -->
                                                <div class="breaking-ticker owl-carousel ticker ps-0">
                                                    <?php foreach ($carousels as $carousel): ?>
                                                        <div class="ticker-item">
                                                            <i class="fa fa-circle"></i>
                                                            <a href="#"><?= esc($carousel) ?></a>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?= $this->renderSection('content') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?= $this->include('user/Components/Footer.php') ?>
                <div id="back-to-top" class="back-to-top">
                    <button class="btn" title="Back to Top"> <i class="fa fa-angle-up"></i> </button>
                </div>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url() ?>assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url() ?>assets/js/off-canvas.js"></script>
    <script src="<?= base_url() ?>assets/js/hoverable-collapse.js"></script>
    <script src="<?= base_url() ?>assets/js/template.js"></script>
    <script src="<?= base_url() ?>assets/js/settings.js"></script>
    <script src="<?= base_url() ?>assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?= base_url() ?>assets/customs/js/jquery.colorbox.js"></script>
    <script src="<?= base_url() ?>assets/customs/js/custom_script.js"></script>
    <script src="<?= base_url() ?>assets/js/owl-carousel.js"></script>
    <script src="<?= base_url() ?>assets/vendors/glightbox/glightbox.min.js"></script>
    <?= $this->renderSection('jsPlugins') ?>
    <script>
        /* Loading Js*/
        $(window).on('load', function() {
            setTimeout(function() {
                $('#global-loader').delay(500).fadeOut(500);
            }, 800);
        });
        $(document).ready(function() {
            $('[data-toggle="horizontal-menu-toggle-new"]').on("click", function() {

                $(".horizontal-menu .bottom-navbar").toggleClass("header-toggled");
                // toggle icons
                $(this).find('.ti-menu').toggleClass('d-none');
                $(this).find('.ti-close').toggleClass('d-none');

            });
            $('.ticker').owlCarousel({
                loop: true,
                margin: 20,
                autoWidth: true,

                items: 1,
                slideTransition: 'linear',
                smartSpeed: 9000,
                autoplay: true,
                autoplayTimeout: 0,
                autoplaySpeed: 9000,
                autoplayHoverPause: true,
                dots: false,
                nav: false,
                mouseDrag: true,
                touchDrag: true,
                pullDrag: false
            });
            const lightbox = GLightbox();
            $('.glightbox').on('open', (target) => {
                console.log('lightbox opened');
            });
        });
    </script>
    <?= $this->renderSection('customjs') ?>

    <!-- End custom js for this page-->
</body>

</html>