<?= $this->extend('layouts/AuthLayout.php') ?>

<?= $this->section('title') ?>
<?= lang('Auth.useMagicLink') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
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

                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-3"><?= lang('Auth.useMagicLink') ?></h5>

                                <p><b><?= lang('Auth.checkYourEmail') ?></b></p>

                                <p><?= lang('Auth.magicLinkDetails', [setting('Auth.magicLinkLifetime') / 60]) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>