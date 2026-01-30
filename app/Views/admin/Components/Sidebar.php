<?php
$uri = uri_string();

?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item <?= $uri === 'admin' ? 'active' : '' ?>">
            <a class="nav-link " href="<?= base_url('admin') ?>">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <!-- <li class="nav-item nav-category">News Categories</li>
        <li class="nav-item <?= $uri === 'admin/catagories' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/catagories') ?>">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Catagories</span>
            </a>
        </li> -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#catagories" aria-expanded="false" aria-controls="catagories">
                <i class="mdi mdi-grid-large menu-icon"></i> <span class="menu-title">News Categories</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="catagories">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link <?= $uri === 'admin/categories' ? 'active' : '' ?>" href="<?= base_url('admin/categories') ?>">Catagories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $uri === 'admin/sub-categories' ? 'active' : '' ?>" href="<?= base_url('admin/sub-categories') ?>">Sub Catagories</a>
                    </li>

                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">News and Posts</li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#news" aria-expanded="false" aria-controls="news">
                <i class="mdi mdi-grid-large menu-icon"></i> <span class="menu-title">News</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="news">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link <?= $uri === 'admin/all-news' ? 'active' : '' ?>" href="<?= base_url('admin/all-news') ?>">All news</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $uri === 'admin/news' ? 'active' : '' ?>" href="<?= base_url('admin/news') ?>">Create  news</a>
                    </li>

                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title"><?= $uri ?></span>
            </a>
        </li>
    </ul>
</nav>