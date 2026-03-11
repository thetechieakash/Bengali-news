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
                        <h4><?= lang('Auth.useMagicLink') ?></h4>
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
                        <form class="pt-3" action="<?= url_to('magic-link') ?>" method="post">
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
                                        placeholder="Email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email', auth()->user()->email ?? null) ?>" required>
                                </div>
                            </div>
                            <div class="my-3 d-grid gap-2">
                                <button class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn" type="submit"><?= lang('Auth.send') ?></button>
                            </div>
                            <div class="text-center mt-4 fw-light">
                                Already have an account? <a href="<?= url_to('login') ?>" class="text-primary"><?= lang('Auth.backToLogin') ?></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>