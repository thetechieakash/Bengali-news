<?= $this->extend('layouts/ViewLayout.php') ?>
<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('cssPlugins') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php

use App\Helpers\StringShort;
use App\Helpers\ThumbHelper;

$defaultThumb = base_url('assets/images/news/placeholder.png');
?>
<!-- Page Breadcrumb Start -->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="<?= base_url() ?>">হোম</a></li>
                    <li><a href="<?= base_url("category/{$category['slug']}") ?>"><?= esc($category['cat']) ?></a></li>
                    <li><?= esc($subCategory['sub_cat_name']) ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page Breadcrumb end -->

<section class="utf_block_wrapper py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="block category-listing category-style2 color-primary">
                    <h3 class="utf_block_title"><span>News</span></h3>
                    <?php if (!empty($childCategory)): ?>
                        <ul class="subCategory unstyled">
                            <?php foreach ($childCategory as $childCat): ?>
                                <li>
                                    <a href="<?= base_url("category/{$category['slug']}/{$subCategory['sub_cat_slug']}/{$childCat['child_cat_slug']}") ?>">
                                        <?= esc($childCat['child_cat_name']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <?php if (!empty($posts)): ?>
                        <?php foreach ($posts as $post): ?>
                            <div class="utf_post_block_style post-list clearfix">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="utf_post_thumb thumb-float-style">
                                            <a href="#">
                                                <img class="img-fluid" src="<?= ThumbHelper::getThumbUrl($post['thumbnail_url'], $post['type']) ?>" alt="<?= $post['headline'] ?>" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <div class="utf_post_content">
                                            <h2 class="utf_post_title title-large">
                                                <a href="<?= base_url('news/' . $post['slug']) ?>"><?= StringShort::truncate($post['headline']) ?></a>
                                            </h2>
                                            <div class="utf_post_meta">
                                                <span class="utf_post_author"><?= esc($post['author']) ?></span>
                                                <span class="utf_post_date">
                                                    <?php $formattedPostDate = (new DateTime($post['post_date_time']))->format('d M, Y'); ?>
                                                    <?= $formattedPostDate ?>
                                                </span>
                                            </div>
                                            <p><?= $post['short_description'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card shadow-sm border-0 text-center p-4 my-4">

                                    <div class="mb-3">
                                        <i class="fa fa-newspaper-o text-muted" style="font-size:50px;"></i>
                                    </div>

                                    <h4 class="text-dark mb-2">
                                        No News Available
                                    </h4>

                                    <p class="text-muted mb-3">
                                        There are currently no news articles available in this section.
                                        Please check back later.
                                    </p>

                                    <a href="<?= base_url() ?>" class="btn btn-primary">
                                        <i class="fa fa-home"></i> Back to Home
                                    </a>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if (!empty($posts)): ?>
                    <?= $pager->links('default', 'custom') ?>
                <?php endif; ?>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="sidebar utf_sidebar_right mt-3 mt-md-0">
                    <?php if (!empty($blockAds)) : ?>
                        <div class="widget text-center">
                            <div class="owl-carousel blockAdsCarousel">
                                <?php foreach ($blockAds as $blockAd) : ?>
                                    <div class="item">
                                        <?php if (!empty($blockAd['url'])) : ?>
                                            <a href="<?= esc($blockAd['url']) ?>" target="_blank">
                                                <img class="banner img-fluid"
                                                    src="<?= base_url($blockAd['image']) ?>"
                                                    alt="<?= esc($blockAd['title']) ?>">
                                            </a>
                                        <?php else : ?>
                                            <img class="banner img-fluid"
                                                src="<?= base_url($blockAd['image']) ?>"
                                                alt="<?= esc($blockAd['title']) ?>">
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="widget color-primary">
                        <h3 class="utf_block_title"><span>বিখ্যাত সংবাদ</span></h3>
                        <div class="utf_list_post_block">
                            <ul class="utf_list_post">
                                <?php foreach ($popularNews as $news): ?>
                                    <li class="clearfix">
                                        <div class="utf_post_block_style post-float clearfix">
                                            <div class="utf_post_thumb">
                                                <img class="img-fluid" src="<?= ThumbHelper::getThumbUrl($news['thumbnail_url'], $news['type']) ?>" alt="$news['headline']" />
                                            </div>
                                            <div class="utf_post_content">
                                                <h2 class="utf_post_title title-small">
                                                    <a href="<?= base_url('news/' . $news['slug']) ?>"><?= StringShort::truncate($news['headline'], 30)  ?></a>
                                                </h2>
                                                <div class="utf_post_meta">
                                                    <span class="utf_post_author"><?= esc($news['author']) ?></span>
                                                    <span class="utf_post_date"><?= date('d M, Y', strtotime($news['post_date_time'])) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <?php if (!empty($blockAds)) : ?>
                        <div class="widget text-center">
                            <div class="owl-carousel blockAdsCarousel">
                                <?php foreach ($blockAds as $blockAdb) : ?>
                                    <div class="item">
                                        <?php if (!empty($blockAdb['url'])) : ?>
                                            <a href="<?= esc($blockAdb['url']) ?>" target="_blank">
                                                <img class="banner img-fluid"
                                                    src="<?= base_url($blockAdb['image']) ?>"
                                                    alt="<?= esc($blockAdb['title']) ?>">
                                            </a>
                                        <?php else : ?>
                                            <img class="banner img-fluid"
                                                src="<?= base_url($blockAdb['image']) ?>"
                                                alt="<?= esc($blockAdb['title']) ?>">
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
<?= $this->section('jsPlugins') ?>

<?= $this->endSection() ?>
<?= $this->section('customjs') ?>

<?= $this->endSection() ?>