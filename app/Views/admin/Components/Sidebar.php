<?php
$uri  = uri_string();
$user = auth()->user();
?>

<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">

        <?php if ($user->can('dashboard.view')): ?>
            <li class="nav-item <?= $uri === 'admin' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin') ?>">
                    <i class="fa fa-tachometer"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if ($user->can('news.view') || $user->can('news.create')): ?>
            <li class="nav-item nav-category">News Manager</li>

            <?php if ($user->can('news.view')): ?>
                <li class="nav-item <?= $uri === 'admin/published-news' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/published-news') ?>">
                        <i class="fa fa-newspaper-o"></i>
                        <span class="menu-title">Published News</span>
                    </a>
                </li>
                <li class="nav-item <?= $uri === 'admin/draft-news' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/draft-news') ?>">
                        <i class="fa fa-newspaper-o"></i>
                        <span class="menu-title">Draft News</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($user->can('news.create')): ?>
                <li class="nav-item <?= $uri === 'admin/create-news' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/create-news') ?>">
                        <i class="fa fa-newspaper-o"></i>
                        <span class="menu-title">Create News</span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($user->can('comments.view')): ?>
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
        <?php if ($user->can('tags.view')): ?>
            <li class="nav-item nav-category">Tags Manager</li>

            <li class="nav-item <?= $uri === 'admin/tags' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/tags') ?>">
                    <i class="fa fa-tags"></i>
                    <span class="menu-title">Tags</span>
                </a>
            </li>
        <?php endif; ?>
        <?php if ($user->can('media.view')): ?>
            <li class="nav-item nav-category">Media Manager</li>

            <li class="nav-item <?= $uri === 'admin/media' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/media') ?>">
                    <i class="fa fa-image"></i>
                    <span class="menu-title">Media</span>
                </a>
            </li>
        <?php endif; ?>
        <?php if ($user->can('documents.view')): ?>
            <li class="nav-item <?= $uri === 'admin/documents' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/documents') ?>">
                    <i class="fa fa-tags"></i>
                    <span class="menu-title">PDF</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if ($user->can('categories.view') || $user->can('sub_categories.view') || $user->can('child_categories.view')): ?>
            <li class="nav-item nav-category">Categories Manager</li>
            <?php if ($user->can('categories.view')): ?>
                <li class="nav-item <?= $uri === 'admin/categories' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/categories') ?>">
                        <i class="fa fa-sitemap"></i>
                        <span class="menu-title">Categories</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($user->can('sub_categories.view')): ?>
                <li class="nav-item <?= $uri === 'admin/sub-categories' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/sub-categories') ?>">
                        <i class="fa fa-sitemap"></i>
                        <span class="menu-title">Sub Categories</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if ($user->can('child_categories.view')): ?>
                <li class="nav-item <?= $uri === 'admin/child-categories' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin/child-categories') ?>">
                        <i class="fa fa-sitemap"></i>
                        <span class="menu-title">Child Categories</span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ($user->can('ads.view')): ?>
            <li class="nav-item nav-category">Ads Manager</li>
            <li class="nav-item <?= $uri === 'admin/ads' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/ads') ?>">
                    <i class="fa fa-bullhorn"></i>
                    <span class="menu-title">Ads</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if ($user->can('author.view')): ?>
            <li class="nav-item nav-category">Author Manager</li>
            <li class="nav-item <?= $uri === 'admin/author' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/author') ?>">
                    <i class="fa fa-user"></i>
                    <span class="menu-title">Create Author</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if ($user->can('messages.view')): ?>
            <li class="nav-item nav-category">Messages Manager</li>
            <li class="nav-item <?= $uri === 'admin/messages' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/messages') ?>">
                    <i class="fa fa-user"></i>
                    <span class="menu-title">Messages</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if ($user->inGroup('superadmin')): ?>
            <li class="nav-item nav-category">Pages Manager</li>
            <li class="nav-item <?= $uri === 'admin/about-us' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/about-us') ?>">
                    <i class="fa fa-user"></i>
                    <span class="menu-title">About Us</span>
                </a>
            </li>
            <li class="nav-item <?= $uri === 'admin/privacy-policy' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/privacy-policy') ?>">
                    <i class="fa fa-user"></i>
                    <span class="menu-title">Privacy & Policy</span>
                </a>
            </li>

            <li class="nav-item nav-category">User Manager</li>
            <li class="nav-item <?= $uri === 'admin/all-users' ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/all-users') ?>">
                    <i class="fa fa-user"></i>
                    <span class="menu-title">All Users</span>
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