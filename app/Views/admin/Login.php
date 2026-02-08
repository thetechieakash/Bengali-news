<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
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
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/bangla-logo-mini.svg" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
                <div class="row flex-grow">
                    <div class="col-lg-6 login-half-bg d-flex flex-row">
                        <p class="text-white fw-medium text-center flex-grow align-self-end">Copyright &copy; <?= date('Y') ?> All rights reserved.</p>
                    </div>
                    <div class="col-lg-6 d-flex align-items-center justify-content-center">
                        <div class="auth-form-transparent text-left p-3">
                            <div class="brand-logo">
                                <img class="w-50" src="<?= base_url() ?>assets/images/bengali-logo.svg" alt="logo">
                            </div>
                            <h4>Welcome back!</h4>
                            <h6 class="fw-light">Happy to see you again!</h6>
                            <?php if (session('error') !== null) : ?>
                                <div class="alert alert-danger" role="alert"><?= esc(session('error')) ?></div>
                            <?php elseif (session('errors') !== null) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php if (is_array(session('errors'))) : ?>
                                        <?php foreach (session('errors') as $error) : ?>
                                            <?= esc($error) ?>
                                            <br>
                                        <?php endforeach ?>
                                    <?php else : ?>
                                        <?= esc(session('errors')) ?>
                                    <?php endif ?>
                                </div>
                            <?php endif ?>

                            <?php if (session('message') !== null) : ?>
                                <div class="alert alert-success" role="alert"><?= esc(session('message')) ?></div>
                            <?php endif ?>
                            <form class="pt-3" action="<?= url_to('login') ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail"><?= lang('Auth.email') ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0 h-100">
                                                <i class="ti-user text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control form-control-lg border-left-0" name="email" inputmode="email" autocomplete="email"
                                            placeholder="Username" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword"><?= lang('Auth.password') ?></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend bg-transparent">
                                            <span class="input-group-text bg-transparent border-right-0 h-100">
                                                <i class="ti-lock text-primary"></i>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control form-control-lg border-left-0" name="password" inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" required>
                                    </div>
                                </div>
                                <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
                                    <div class="my-2 d-flex justify-content-between align-items-center">
                                        <div class="form-check">
                                            <label class="form-check-label text-muted">
                                                <input type="checkbox" class="form-check-input" <?= old('remember') ? " checked" : "" ?>>
                                                Keep me signed in
                                            </label>
                                        </div>
                                        <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
                                            <a href="<?= url_to('magic-link') ?>" class="auth-link text-black">Forgot password?</a>
                                        <?php endif ?>
                                    </div>
                                <?php endif; ?>

                                <div class="my-3 d-grid gap-2">
                                    <button class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn" type="submit">LOGIN</button>
                                </div>
                                <?php if (setting('Auth.allowRegistration')) : ?>
                                    <div class="text-center mt-4 fw-light">
                                        Don't have an account? <a href="<?= url_to('register') ?>" class="text-primary">Create</a>
                                    </div>
                                <?php endif ?>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?= base_url() ?>assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url() ?>assets/js/off-canvas.js"></script>
    <script src="<?= base_url() ?>assets/js/hoverable-collapse.js"></script>
    <script src="<?= base_url() ?>assets/js/template.js"></script>
    <script src="<?= base_url() ?>assets/js/settings.js"></script>
    <script src="<?= base_url() ?>assets/js/todolist.js"></script>
    <!-- endinject -->
</body>

</html>