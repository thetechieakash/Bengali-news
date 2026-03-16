<!DOCTYPE html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $this->renderSection('pageTitle') ?> || Purulia mirror </title>
    <?= $this->renderSection("HomeMeta"); ?>

    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/vendor.bundle.base.css">

    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <?= $this->renderSection('cssPlugins') ?>
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/horizontal-layout-light/style.css?v=10.5">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/insta-logo.jpg" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/customs/css/style.css?v=10.5">
    <link rel="stylesheet" href="<?= base_url() ?>assets/customs/css/custom.css?v=10.5">
</head>

<body>
    <?php

    use App\Helpers\StringShort;
    use App\Models\NewsPostModel;

    $postModel = new NewsPostModel();
    $tickers = $postModel->headlineTicker();
    ?>
    <!-- Start Pre Loader -->
    <div id="global-loader" class="light-loader">
        <img src="<?= base_url('assets/images/ripple.svg') ?>" class="loader-img" alt="Loader">
    </div>
    <!-- End Pre Loader -->
    <div class="container-scroller">
        <!-- partial:partials/_horizontal-navbar.html -->
        <?= $this->include('user/Components/Horizontal.php') ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <?php if (isset($leftAds)): ?>
                                <div class="col-sm-2 p-0 d-none d-md-block">
                                    <div class="container">
                                        <div class="owl-carousel left-carousel">
                                            <?php foreach ($leftAds as $leftAd) : ?>
                                                <div class="item">
                                                    <?php if (!empty($leftAd['url'])) : ?>
                                                        <a href="<?= esc($leftAd['url']) ?>" target="_blank">
                                                            <img class="img-fluid"
                                                                src="<?= base_url($leftAd['image']) ?>"
                                                                alt="<?= esc($leftAd['title']) ?>">
                                                        </a>
                                                    <?php else : ?>
                                                        <img class="img-fluid"
                                                            src="<?= base_url($leftAd['image']) ?>"
                                                            alt="<?= esc($leftAd['title']) ?>">
                                                    <?php endif; ?>

                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?= $this->renderSection('w-full') ?>
                            <div class="col-sm-12 col-md-8 px-0">
                                <div class="home-tab">
                                    <!-- News ticker  -->
                                    <?php if ($tickerActive): ?>
                                        <div class="mx-auto px-md-3" style="max-width: 1100px;">
                                            <div class="container my-2 px-0">
                                                <div class="breaking-wrapper d-flex align-items-center shadow-lg">
                                                    <!-- LEFT LABEL -->
                                                    <div class="breaking-label">
                                                        BREAKING NEWS
                                                    </div>
                                                    <!-- TICKER -->
                                                    <div class="breaking-ticker owl-carousel ticker ps-0">
                                                        <?php foreach ($tickers as $ticker): ?>
                                                            <div class="ticker-item">
                                                                <i class="fa fa-circle"></i>
                                                                <a href="<?= base_url('news/' . $ticker['slug']) ?>"><?= StringShort::truncate($ticker['headline'], 50)  ?></a>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($topAds)) : ?>
                                        <div class="utf_ad_content_area text-center utf_banner_area pt-3 pb-0">
                                            <div class="container">
                                                <div class="owl-carousel ads-carousel">
                                                    <?php foreach ($topAds as $topAd) : ?>
                                                        <div class="item">
                                                            <?php if (!empty($topAd['url'])) : ?>
                                                                <a href="<?= esc($topAd['url']) ?>" target="_blank">
                                                                    <img class="img-fluid"
                                                                        src="<?= base_url($topAd['image']) ?>"
                                                                        alt="<?= esc($topAd['title']) ?>">
                                                                </a>
                                                            <?php else : ?>
                                                                <img class="img-fluid"
                                                                    src="<?= base_url($topAd['image']) ?>"
                                                                    alt="<?= esc($topAd['title']) ?>">
                                                            <?php endif; ?>

                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?= $this->renderSection('content') ?>
                                </div>
                            </div>
                            <?php if (isset($rightAds)): ?>
                                <div class="col-sm-2 p-0 d-none d-md-block">
                                    <div class="container">
                                        <div class="owl-carousel right-carousel">
                                            <?php foreach ($rightAds as $rightAd) : ?>
                                                <div class="item">
                                                    <?php if (!empty($rightAd['url'])) : ?>
                                                        <a href="<?= esc($rightAd['url']) ?>" target="_blank">
                                                            <img class="img-fluid"
                                                                src="<?= base_url($rightAd['image']) ?>"
                                                                alt="<?= esc($leftAd['title']) ?>">
                                                        </a>
                                                    <?php else : ?>
                                                        <img class="img-fluid"
                                                            src="<?= base_url($rightAd['image']) ?>"
                                                            alt="<?= esc($rightAd['title']) ?>">
                                                    <?php endif; ?>

                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php if (!empty($bottomAds)) : ?>
                    <div class="utf_ad_content_area text-center utf_banner_area pb-3 pt-0">
                        <div class="container">
                            <div class="owl-carousel ads-carousel">
                                <?php foreach ($bottomAds as $bottomAd) : ?>
                                    <div class="item">
                                        <?php if (!empty($bottomAd['url'])) : ?>
                                            <a href="<?= esc($bottomAd['url']) ?>" target="_blank">
                                                <img class="img-fluid"
                                                    src="<?= base_url($bottomAd['image']) ?>"
                                                    alt="<?= esc($bottomAd['title']) ?>">
                                            </a>
                                        <?php else : ?>
                                            <img class="img-fluid"
                                                src="<?= base_url($bottomAd['image']) ?>"
                                                alt="<?= esc($bottomAd['title']) ?>">
                                        <?php endif; ?>

                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <!-- content-wrapper ends -->
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
    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0 pb-1">
                    <h5 class="modal-title">Search news</h5>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('search') ?>" method="get">
                        <input type="text"
                            class="form-control border-1 news-search"
                            autocomplete="off"
                            name="q"
                            placeholder="Search news..."
                            required>
                        <button type="submit" class="btn btn-primary mt-2">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
    <?php if (isset($scriptAds)): ?>
        <?php foreach ($scriptAds as $scAds): ?>
            <?= $scAds['script'] ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <?= $this->renderSection('jsPlugins') ?>
    <script>
        /* Loading Js*/
        $(window).on('load', function() {
            $('#global-loader').fadeOut();
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

            $('.ads-carousel').owlCarousel({
                items: 1,
                loop: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 7000,
                autoplayHoverPause: false,
                nav: false,
                dots: true,
            });
            $('.left-carousel').owlCarousel({
                items: 1,
                loop: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 8000,
                autoplayHoverPause: false,
                nav: false,
                dots: true
            });
            $('.right-carousel').owlCarousel({
                items: 1,
                loop: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 8000,
                autoplayHoverPause: false,
                nav: false,
                dots: true,
                rtl: true
            });
            $('.blockAdsCarousel').owlCarousel({
                items: 1,
                loop: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: false,
                nav: false,
                dots: true
            });
        });
    </script>
    <script>
        document.querySelectorAll('.nav-item > .nav-link').forEach(function(link) {

            link.addEventListener('click', function(e) {

                if (window.innerWidth <= 992) {

                    const parent = this.closest('.nav-item');
                    const submenu = parent.querySelector('.submenu');

                    if (submenu) {

                        if (!parent.classList.contains('submenu-open')) {
                            e.preventDefault();
                            parent.classList.add('submenu-open');
                            submenu.style.display = 'block';
                        }
                    }
                }

            });

        });
        const search = document.querySelector('.search-btn');

        if (search) {
            search.addEventListener('click', function(e) {
                e.preventDefault();
                $('#searchModal').modal('show');
            });
        }
    </script>
    <?= $this->renderSection('customjs') ?>

    <!-- End custom js for this page-->
</body>

</html>