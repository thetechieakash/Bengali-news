<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="<?= base_url() ?>">
                <img src="<?= base_url() ?>assets/images/purulia_logo.png" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="<?= base_url() ?>">
                <img src="<?= base_url() ?>assets/images/insta-logo.jpg" alt="logo" />
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                <?php if (auth()->loggedIn()): ?>
                    <h1 class="welcome-text">Hellow, <span class="text-black fw-bold"><?= auth()->user()->username ?></span></h1>
                <?php endif; ?>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item d-none d-lg-block">
                <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                    <span class="input-group-addon input-group-prepend border-right">
                        <span class="icon-calendar input-group-text calendar-icon"></span>
                    </span>
                    <input type="text" class="form-control">
                </div>
            </li>
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle" src="<?= base_url() ?>assets/images/faces/dp.webp" alt="Profile image"> </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" src="<?= base_url() ?>assets/images/faces/dp.webp" alt="Profile image">
                        <p class="my-1 fw-semibold"><?= auth()->user()->username ?></p>
                        <p class="fw-light text-muted mb-0"><?= auth()->user()->getEmail() ?></p>
                    </div>
                    <a class="dropdown-item border-0" href="<?= base_url('logout') ?>"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>