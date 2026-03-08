<?php
$uri = urldecode(uri_string());

$mainNav = [];
$megaMenu = [];

foreach ($navbarCategories as $cat) {

    if ((int)$cat['is_active'] === 1) {
        $mainNav[] = $cat;
    } else {
        $megaMenu[] = $cat;
    }
}
?>

<div class="horizontal-menu">

    <!-- TOP NAV -->
    <nav class="navbar top-navbar bg-transparent col-lg-12 col-12 p-0 py-3">
        <div class="container position-relative justify-content-center">

            <button
                class="navbar-toggler navbar-toggler-right d-lg-none position-absolute"
                style="left:2%"
                type="button"
                data-toggle="horizontal-menu-toggle-new">
                <span class="ti-menu"></span>
                <span class="ti-close d-none"></span>
            </button>

            <div class="text-start navbar-brand-wrapper d-flex align-items-center justify-content-start me-lg-3">
                <a class="navbar-brand brand-logo" href="<?= base_url() ?>">
                    <img src="<?= base_url() ?>assets/images/purulia_logo.png" alt="logo" />
                </a>

                <a class="navbar-brand brand-logo-mini" href="<?= base_url() ?>">
                    <img src="<?= base_url() ?>assets/images/purulia_logo.png" alt="logo" />
                </a>
            </div>

        </div>
    </nav>


    <!-- MAIN NAVBAR -->
    <nav class="bottom-navbar">
        <div class="container">

            <ul class="nav page-navigation justify-content-start main-top-nav">

                <!-- HOME -->
                <li class="nav-item <?= $uri == '' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url() ?>">
                        <span class="menu-title">হোম</span>
                    </a>
                </li>


                <!-- MAIN NAV CATEGORIES -->
                <?php foreach ($mainNav as $cat): ?>

                    <?php if (!empty($cat['subs'])): ?>

                        <li class="nav-item has-sub <?= str_contains($uri, $cat['slug']) ? 'active' : '' ?>">

                            <a href="<?= base_url('category/' . $cat['slug']) ?>" class="nav-link">
                                <span class="menu-title"><?= esc($cat['name']) ?></span>
                                <i class="menu-arrow"></i>
                            </a>

                            <div class="submenu">
                                <ul class="submenu-item">

                                    <?php foreach ($cat['subs'] as $sub): ?>

                                        <li class="nav-item">

                                            <a class="nav-link"
                                                href="<?= base_url('category/' . $cat['slug'] . '/sub-category/' . $sub['slug']) ?>">
                                                <?= esc($sub['name']) ?>
                                            </a>

                                            <!-- CHILD CATEGORIES -->
                                            <?php if (!empty($sub['children'])): ?>

                                                <ul class="child-menu">

                                                    <?php foreach ($sub['children'] as $child): ?>

                                                        <li>
                                                            <a href="<?= base_url('category/' . $cat['slug'] . '/sub-category/' . $sub['slug'] . '/' . $child['child_cat_slug']) ?>" class="child-cat-link">
                                                                <?= esc($child['child_cat_name']) ?>
                                                            </a>
                                                        </li>

                                                    <?php endforeach ?>

                                                </ul>

                                            <?php endif ?>

                                        </li>

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


                <!-- MEGA MENU -->
                <?php if (!empty($megaMenu)): ?>

                    <li class="nav-item mega-menu">

                        <a href="#" class="nav-link">
                            <span class="menu-title">এছাড়াও</span>
                            <i class="menu-arrow"></i>
                        </a>

                        <div class="submenu sub-menu-grid">
                            <div class="sub-menu-grid-layout">

                                <ul>

                                    <?php foreach ($megaMenu as $cat): ?>

                                        <li class="nav-item fw-bold">
                                            <a class="nav-link"
                                                href="<?= base_url('category/' . $cat['slug']) ?>">
                                                <?= esc($cat['name']) ?>a
                                            </a>
                                        </li>

                                        <?php if (!empty($cat['subs'])): ?>
                                            <?php foreach ($cat['subs'] as $sub): ?>
                                                <li class="nav-item ps-3">
                                                    <a class="nav-link sub-cat"
                                                        href="<?= base_url('category/' . $cat['slug'] . '/sub-category/' . $sub['slug']) ?>">
                                                        <?= esc($sub['name']) ?>
                                                    </a>
                                                    <!-- CHILD -->
                                                    <?php if (!empty($sub['children'])): ?>
                                                        <ul class="child-menu">
                                                            <?php foreach ($sub['children'] as $child): ?>
                                                                <li class="ps-4">
                                                                    <a class="nav-link child-cat"
                                                                        href="<?= base_url('category/' . $cat['slug'] . '/sub-category/' . $sub['slug'] . '/' . $child['child_cat_slug']) ?>">
                                                                        <?= esc($child['child_cat_name']) ?>
                                                                    </a>
                                                                </li>
                                                            <?php endforeach ?>
                                                        </ul>
                                                    <?php endif ?>
                                                </li>

                                            <?php endforeach ?>

                                        <?php endif ?>

                                    <?php endforeach ?>

                                </ul>

                            </div>
                        </div>

                    </li>

                <?php endif ?>


                <!-- SEARCH -->
                <?php if ($uri !== 'search'): ?>

                    <form action="<?= base_url('search') ?>" class="my-2 m-md-auto" method="get">
                        <input type="text"
                            class="form-control border-1"
                            autocomplete="off"
                            name="q"
                            placeholder="Search news..."
                            required>
                    </form>

                <?php endif ?>

            </ul>

        </div>
    </nav>

</div>