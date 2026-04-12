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
    <nav class="navbar top-navbar bg-transparent col-lg-12 col-12 p-0 py-2">
        <div class="container justify-content-evenly justify-content-md-between position-relative">
            <button class="navbar-toggler navbar-toggler-right d-lg-none position-absolute" type="button"
                style="left:1%; border: none;"
                data-toggle="horizontal-menu-toggle">
                <span class="ti-menu"></span>
            </button>
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start me-lg-3">
                <div>
                    <a class="navbar-brand brand-logo" href="<?= base_url() ?>">
                        <img src="<?= base_url() ?>assets/images/purulia_logo.png" alt="logo" />
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="<?= base_url() ?>">
                        <img src="<?= base_url() ?>assets/images/purulia_logo.png" alt="logo" />
                    </a>
                </div>
            </div>
            <div>
                <ul class="social-icon mt-1 mt-sm-0 mb-1 text-center text-md-start">
                    <li><a href="https://www.facebook.com/puruliamirror" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="https://www.instagram.com/purulia_mirror" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="https://wa.me/916295142737" target="_blank"><i class="fa-brands fa-whatsapp"></i></a></li>
                    <li><a href="https://x.com/PuruliaMirror" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                    <li><a href="https://www.youtube.com/@PuruliaMirror" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                </ul>
                <div id="bnDateTime" class="fs-6" ></div>
            </div>
        </div>
    </nav>
    <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation">
                <li class="nav-item ">
                    <a class="nav-link" style="color: red;" href="<?= base_url() ?>">
                        <span class="menu-title">হোম <i class="fa fa-home"></i></span>
                    </a>
                </li>
                <?php foreach ($mainNav as $cat): ?>

                    <?php
                    $hasSubs = !empty($cat['subs']);
                    $hasChild = false;

                    if ($hasSubs) {
                        foreach ($cat['subs'] as $s) {
                            if (!empty($s['children'])) {
                                $hasChild = true;
                                break;
                            }
                        }
                    }
                    ?>

                    <li class="nav-item <?= $hasChild ? 'mega-menu' : '' ?>">

                        <a class="nav-link" href="<?= base_url('category/' . $cat['slug']) ?>">
                            <span class="menu-title"><?= esc($cat['name']) ?></span>
                            <?php if ($hasSubs): ?>
                                <i class="menu-arrow"></i>
                            <?php endif; ?>
                        </a>


                        <?php if ($hasSubs && !$hasChild): ?>
                            <div class="submenu">
                                <ul class="submenu-item">
                                    <?php foreach ($cat['subs'] as $sub): ?>
                                        <li class="nav-item">
                                            <a class="nav-link mega-sub-link"
                                                href="<?= base_url('category/' . $cat['slug'] . '/' . $sub['slug']) ?>">
                                                <?= esc($sub['name']) ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <?php if ($hasChild): ?>
                            <!-- MEGA MENU -->
                            <div class="submenu">
                                <div class="col-group-wrapper row">
                                    <?php foreach ($cat['subs'] as $sub): ?>
                                        <div class="col-group col-md-3">
                                            <a class="nav-link mega-sub-link" href="<?= base_url('category/' . $cat['slug'] . '/' . $sub['slug']) ?>"><?= esc($sub['name']) ?></a>
                                            <ul class="submenu-item">
                                                <?php if (!empty($sub['children'])): ?>
                                                    <?php foreach ($sub['children'] as $child): ?>
                                                        <li class="nav-item">
                                                            <a class="nav-link mega-child-link"
                                                                href="<?= base_url('category/' . $cat['slug'] . '/' . $sub['slug'] . '/' . $child['child_cat_slug']) ?>">
                                                                <?= esc($child['child_cat_name']) ?>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
                <?php if (!empty($megaMenu)): ?>
                    <li class="nav-item mega-menu">
                        <a href="#" class="nav-link">
                            <span class="menu-title">এছাড়াও</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="submenu">
                            <div class="col-group-wrapper row">
                                <?php foreach ($megaMenu as $cat): ?>
                                    <div class="col-group col-md-3">
                                        <a class="nav-link mega-main-link" href="<?= base_url('category/' . $cat['slug']) ?>"><?= esc($cat['name']) ?></a>
                                        <!-- <?php if (!empty($cat['subs'])): ?>
                                            <ul class="submenu-item">
                                                <?php foreach ($cat['subs'] as $sub): ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                            href="<?= base_url('category/' . $cat['slug'] . '/' . $sub['slug']) ?>">
                                                            <?= esc($sub['name']) ?>
                                                        </a>
                                                        <?php if (!empty($sub['children'])): ?>
                                                            <ul class="submenu-item">
                                                                <?php foreach ($sub['children'] as $child): ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link"
                                                                            href="<?= base_url('category/' . $cat['slug'] . '/' . $sub['slug'] . '/' . $child['child_cat_slug']) ?>">
                                                                            <?= esc($child['child_cat_name']) ?>
                                                                        </a>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?> -->
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if ($uri !== 'search'): ?>
                    <li class="nav-item">
                        <button class="btn nav-link search-btn px-md-0" style="font-size: 20px;"><i class="fa fa-search"></i> <span class="menu-title">Search</span></button>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </nav>
</div>
<style>
    .mega-sub-link,
    .mega-main-link {
        font-size: 16px;
        font-weight: 700;
    }

    .mega-child-link {
        font-size: 15px;
        font-weight: 600;
    }
</style>