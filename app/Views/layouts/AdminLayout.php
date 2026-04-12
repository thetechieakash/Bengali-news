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
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/vertical-layout-light/style.css?v=13.0">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/insta-logo.jpg" />
    <link rel="stylesheet" href="<?= base_url('assets/customs/css/admincustom.css') ?>?v=13.0">
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
        <?= $this->include('admin/Components/Topbar.php') ?>
        <div class="container-fluid page-body-wrapper">
            <?= $this->include('admin/Components/Sidebar.php') ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <?= $this->renderSection('content') ?>
                </div>
                <?= $this->include('admin/Components/Footer.php') ?>
            </div>
        </div>
    </div>
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
            $('#global-loader').fadeOut();
        });

        $('#datepicker-popup').datepicker({
            defaultViewDate: true,
            format: 'dd/mm/yyyy'
        });
    </script>
    <?= $this->renderSection('script') ?>
</body>

</html>