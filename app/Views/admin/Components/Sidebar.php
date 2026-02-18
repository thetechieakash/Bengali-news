<?php
$uri  = uri_string();
$user = auth()->user();
?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <?php if ($user->inGroup('admin', 'superadmin', 'author')): ?>
            <li class="nav-item <?= $uri === 'admin' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin') ?>">
                    <i class="fa fa-tachometer"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if ($user->inGroup('author', 'admin', 'superadmin')): ?>
            <li class="nav-item nav-category">News Manager</li>

            <li class="nav-item <?= $uri === 'admin/all-news' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/all-news') ?>">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="menu-title">All News</span>
                </a>
            </li>

            <li class="nav-item <?= $uri === 'admin/create-news' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/create-news') ?>">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="menu-title">Create News</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if ($user->inGroup('admin', 'superadmin')): ?>
            <li class="nav-item nav-category">Comments Manager</li>

            <li class="nav-item <?= $uri === 'admin/approved-comments' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/approved-comments') ?>">
                    <i class="fa fa-comments"></i>
                    <span class="menu-title">Approved Comments</span>
                </a>
            </li>
            <li class="nav-item <?= $uri === 'admin/pending-comments' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/pending-comments') ?>">
                    <i class="fa fa-comments"></i>
                    <span class="menu-title">Pending Comments</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if ($user->inGroup('admin', 'superadmin')): ?>
            <li class="nav-item nav-category">Tags Manager</li>

            <li class="nav-item <?= $uri === 'admin/tags' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/tags') ?>">
                    <i class="fa fa-tags"></i>
                    <span class="menu-title">All Tags</span>
                </a>
            </li>
            <li class="nav-item nav-category">Media Manager</li>

            <li class="nav-item <?= $uri === 'admin/media' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/media') ?>">
                    <i class="fa fa-tags"></i>
                    <span class="menu-title">Media</span>
                </a>
            </li>
            <li class="nav-item nav-category">Categories Manager</li>

            <li class="nav-item <?= $uri === 'admin/categories' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/categories') ?>">
                    <i class="fa fa-sitemap"></i>
                    <span class="menu-title">Categories</span>
                </a>
            </li>

            <li class="nav-item <?= $uri === 'admin/sub-categories' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/sub-categories') ?>">
                    <i class="fa fa-sitemap"></i>
                    <span class="menu-title">Sub Categories</span>
                </a>
            </li>

            <li class="nav-item nav-category">User Manager</li>

            <li class="nav-item <?= $uri === 'admin/all-users' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/all-users') ?>">
                    <i class="fa fa-user"></i>
                    <span class="menu-title">All Users</span>
                </a>
            </li>

            <li class="nav-item <?= $uri === 'admin/author' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/author') ?>">
                    <i class="fa fa-user"></i>
                    <span class="menu-title">Create Author</span>
                </a>
            </li>
            <li class="nav-item <?= $uri === 'admin/user' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/user') ?>">
                    <i class="fa fa-user"></i>
                    <span class="menu-title">Create User</span>
                </a>
            </li>
        <?php endif; ?>

    </ul>
</nav>