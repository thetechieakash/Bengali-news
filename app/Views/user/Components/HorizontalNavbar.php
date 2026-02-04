<?php
$uri = uri_string();

$activeNavCats = [];
$megaMenuCats  = [];

foreach ($navbarCategories as $cat) {
    if ((int)$cat['is_active'] === 1) {
        $activeNavCats[] = $cat;
    } else {
        $megaMenuCats[] = $cat;
    }
}
?>
<div class="horizontal-menu">
    <nav class="navbar top-navbar bg-transparent col-lg-12 col-12 p-0 py-3">
        <div class="container position-relative justify-content-center">
            <button
                class="navbar-toggler navbar-toggler-right d-lg-none align-self-centerd-lg-none position-absolute " style="left: 2%;"
                type="button"
                data-toggle="horizontal-menu-toggle-new">
                <span class="ti-menu"></span>
                <span class="ti-close d-none"></span>
            </button>
            <div class="text-start navbar-brand-wrapper d-flex align-items-center justify-content-start me-lg-3">
                <div>
                    <a class="navbar-brand brand-logo" href="<?= base_url() ?>">
                        <img src="<?= base_url() ?>assets/images/bengali-logo.svg" alt="logo" />
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="<?= base_url() ?>">
                        <img src="<?= base_url() ?>assets/images/bangla-logo-mini.svg" alt="logo" />
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation justify-content-start main-top-nav">
                <li class="nav-item <?= $uri == '' ? 'active' : '' ?>">
                    <a class="nav-link " href="<?= base_url() ?>">
                        <!-- <i class="icon-grid menu-icon"></i> -->
                        <span class="menu-title">হোম</span>
                    </a>
                </li>
                <?php foreach ($activeNavCats as $cat): ?>
                    <?php if (!empty($cat['subs'])): ?>
                        <li class="nav-item <?= str_contains($uri, $cat['slug']) ? 'active' : '' ?>">
                            <a href="<?= base_url('category/' . $cat['slug']) ?>" class="nav-link">
                                <span class="menu-title"><?= esc($cat['name']) ?></span>
                                <i class="menu-arrow"></i>
                            </a>

                            <div class="submenu cs">
                                <ul class="submenu-item">
                                    <?php foreach ($cat['subs'] as $sub): ?>
                                        <?php if ((int)$sub['is_active'] === 1): ?>
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                    href="<?= base_url('category/' . $cat['slug'] . '/sub-category/' . $sub['sub_cat_slug']) ?>">
                                                    <?= esc($sub['sub_cat_name']) ?>
                                                </a>
                                            </li>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="nav-item <?= str_contains($uri, $cat['slug']) ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= base_url('category/' . $cat['slug']) ?>">
                                <span class="menu-title"><?= esc($cat['name']) ?></span>
                            </a>
                        </li>
                    <?php endif ?>
                <?php endforeach ?>

                <?php if (!empty($megaMenuCats)): ?>
                    <li class="nav-item mega-menu">
                        <a href="#" class="nav-link">
                            <span class="menu-title">এছাড়াও</span>
                            <i class="menu-arrow"></i>
                        </a>

                        <div class="submenu sub-menu-grid">
                            <div class="sub-menu-grid-layout">
                                <ul>
                                    <?php foreach ($megaMenuCats as $cat): ?>
                                        <li class="nav-item fw-bold">
                                            <a class="nav-link" href="<?= base_url('category/' . $cat['slug']) ?>">
                                                <span class="menu-title"><?= esc($cat['name']) ?></span>
                                            </a>
                                        </li>

                                        <?php if (!empty($cat['subs'])): ?>
                                            <?php foreach ($cat['subs'] as $sub): ?>
                                                <li class="nav-item ps-3">
                                                    <a class="nav-link sub-cat"
                                                        href="<?= base_url('category/' . $cat['slug'] . '/sub-category/' . $sub['sub_cat_slug']) ?>">
                                                        <?= esc($sub['sub_cat_name']) ?>
                                                    </a>
                                                </li>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </li>
                <?php endif ?>

            </ul>
        </div>
    </nav>
</div>