<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin || <?= $this->renderSection('pageTitle') ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/js/select.dataTables.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/jquery-toast-plugin/jquery.toast.min.css">
    <?= $this->renderSection('plugin') ?>
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/bangla-logo-mini.svg" />
    <link rel="stylesheet" href="<?= base_url('assets/customs/css/admincustom.css') ?>">
    <style>
        #global-loader {
            position: fixed;
            z-index: 50000;
            background: white;
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            height: 100%;
            width: 100%;
            margin: 0 auto;
            text-align: center;
        }

        .loader-img {
            position: absolute;
            right: 0;
            bottom: 0;
            top: 43%;
            left: 0;
            margin: 0 auto;
            text-align: center;
        }
    </style>
</head>

<body class="with-welcome-text">
    <!-- Start Pre Loader -->
    <div id="global-loader" class="light-loader">
        <img src="<?= base_url('assets/images/ripple.svg') ?>" class="loader-img" alt="Loader">
    </div>
    <!-- End Pre Loader -->
    <div class="container-scroller">
        <!-- <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0">
                <div class="card-body card-body-padding px-3 d-flex align-items-center justify-content-between">
                    <div class="ps-lg-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0 fw-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more!</p>
                            <a href="<?= base_url() ?>" target="_blank"
                                class="btn me-2 buy-now-btn border-0">Visit site</a>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="<?= base_url() ?>"><i class="ti-home me-3 text-white"></i></a>
                        <button id="bannerClose" class="btn border-0 p-0">
                            <i class="ti-close text-white"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- partial:partials/_navbar.html -->
        <?= $this->include('admin/Components/Topbar.php') ?>

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial -->
            <?= $this->include('admin/Components/Sidebar.php') ?>

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <?= $this->renderSection('content') ?>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?= $this->include('admin/Components/Footer.php') ?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?= base_url() ?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url() ?>assets/vendors/chart.js/chart.umd.js"></script>
    <script src="<?= base_url() ?>assets/vendors/progressbar.js/progressbar.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url() ?>assets/js/off-canvas.js"></script>
    <script src="<?= base_url() ?>assets/js/hoverable-collapse.js"></script>
    <script src="<?= base_url() ?>assets/js/template.js"></script>
    <script src="<?= base_url() ?>assets/js/settings.js"></script>
    <script src="<?= base_url() ?>assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?= base_url() ?>assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
    <script src="<?= base_url() ?>assets/customs/js/custom.toast.js"></script>
    <?= $this->renderSection('jsLib') ?>
    <!-- End custom js for this page-->
    <script>
        /* Loading Js*/
        $(window).on('load', function() {
            setTimeout(function() {
                $('#global-loader').delay(500).fadeOut(500);
            }, 800);
        });
    </script>
    <?= $this->renderSection('script') ?>
</body>

</html>