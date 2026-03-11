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
                                        <li class="nav-item sub-parent">
                                            <a class="nav-link sub-cat-link"
                                                href="<?= base_url('category/' . $cat['slug'] . '/' . $sub['slug']) ?>">
                                                <?= esc($sub['name']) ?>
                                            </a>
                                            <!-- CHILD DROPDOWN -->
                                            <?php if (!empty($sub['children'])): ?>
                                                <ul class="child-menu dropdown-child">
                                                    <?php foreach ($sub['children'] as $child): ?>
                                                        <li>
                                                            <a href="<?= base_url('category/' . $cat['slug'] . '/' . $sub['slug'] . '/' . $child['child_cat_slug']) ?>"
                                                                class="child-cat-link">
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
                                                <?= esc($cat['name']) ?>
                                            </a>
                                        </li>
                                        <?php if (!empty($cat['subs'])): ?>
                                            <?php foreach ($cat['subs'] as $sub): ?>
                                                <li class="nav-item ps-3 sub-parent">
                                                    <a class="nav-link sub-cat"
                                                        href="<?= base_url('category/' . $cat['slug'] . '/' . $sub['slug']) ?>">
                                                        <?= esc($sub['name']) ?>
                                                    </a>
                                                    <!-- CHILD DROPDOWN -->
                                                    <?php if (!empty($sub['children'])): ?>
                                                        <ul class="child-menu dropdown-child">
                                                            <?php foreach ($sub['children'] as $child): ?>
                                                                <li class="ps-4">
                                                                    <a class="nav-link child-cat"
                                                                        href="<?= base_url('category/' . $cat['slug'] . '/' . $sub['slug'] . '/' . $child['child_cat_slug']) ?>">

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
                            class="form-control border-1 news-search"
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
<!-- CHILD DROPDOWN CSS -->
<style>
    .sub-parent {
        position: relative;
    }

    /* default child dropdown (for normal navbar) */
    .dropdown-child {
        display: none;
        position: absolute;
        left: 125%;
        top: 0;
        min-width: 180px;
        background: #fff;
        z-index: 999;
        list-style: none;
        padding: 5px 0;
    }

    /* show on hover */
    .sub-parent:hover>.dropdown-child {
        display: block;
    }


    /* FIX FOR MEGA MENU */
    .mega-menu .dropdown-child {
        display: none;
        left: calc(100% - 140px);
        top: 0;
    }

    .mega-menu .sub-parent:hover>.dropdown-child {
        display: block;
    }

    /* prevent screen overflow */
    .mega-menu .sub-parent {
        position: relative;
    }

    @media (max-width:991px) {

        .dropdown-child {
            position: relative;
            left: 0;
            top: 0;
            display: none;
        }

        .sub-parent.open>.dropdown-child {
            display: block;
        }

    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (window.innerWidth <= 991) {
            document.querySelectorAll(".sub-parent > a").forEach(function(link) {
                link.addEventListener("click", function(e) {
                    const parent = this.parentElement;
                    const dropdown = parent.querySelector(".dropdown-child");
                    if (!dropdown) return;
                    if (!parent.classList.contains("open")) {
                        e.preventDefault();
                        document.querySelectorAll(".sub-parent.open").forEach(function(el) {
                            el.classList.remove("open");
                        });
                        parent.classList.add("open");
                    }
                });
            });
        }
    });
</script>