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
        <li class="nav-item nav-category">News Categories</li>
        <li class="nav-item <?= $uri === 'admin/catagories' ? 'active' : '' ?>">
            <a class="nav-link" href="<?= base_url('admin/catagories') ?>">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Catagories</span>
            </a>
        </li>
        <li class="nav-item nav-category">News and Posts</li>
        <li class="nav-item">
            <a class="nav-link " href="<?= base_url() ?>">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">News lists</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="<?= base_url() ?>">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Create news</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title"><?= $uri ?></span>
            </a>
        </li>
    </ul>
</nav>