<?= $this->extend('layouts/ViewLayout.php') ?>
<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('cssPlugins') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php
use App\Helpers\StringShort;
$defaultThumb = base_url('assets/images/news/placeholder.png');

?>
<!-- Page Breadcrumb Start -->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="<?= base_url() ?>">হোম</a></li>
                    <li>ট্যাগ</li>
                    <li><?= esc($tag['name']) ?></li>
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
                    <h3 class="utf_block_title"><span><?= esc($tag['name']) ?></span></h3>
                    <?php if (!empty($subCategory)): ?>
                        <ul class="subCategory unstyled">
                            <?php foreach ($subCategory as $subCat): ?>
                                <li>
                                    <a href="<?= base_url("category/{$category['slug']}/sub-category/{$subCat['sub_cat_slug']}") ?>">
                                        <?= esc($subCat['sub_cat_name']) ?>
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
                                                <img class="img-fluid" src="<?= $post['thumbnail_url'] ?? $defaultThumb  ?>" alt="" />
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
                    <?php endif; ?>
                </div>
                <?= $pager->links() ?>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="sidebar utf_sidebar_right">
                    <div class="widget text-center"> <img class="banner img-fluid" src="<?= base_url() ?>assets/images/banner-ads/ad-sidebar.png" alt="" /> </div>
                    <div class="widget color-primary">
                        <h3 class="utf_block_title"><span>বিখ্যাত সংবাদ</span></h3>
                        <!-- <div class="utf_post_overaly_style clearfix">
                            <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/lifestyle/health4.jpg" alt="" /> </a> </div>
                            <div class="utf_post_content"> <a class="utf_post_cat" href="#">Health</a>
                                <h2 class="utf_post_title"> <a href="#">Smart packs parking sensor tech and beeps when col…</a> </h2>
                                <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                            </div>
                        </div> -->

                        <div class="utf_list_post_block">
                            <ul class="utf_list_post">
                                <?php foreach ($popularNews as $news): ?>
                                    <li class="clearfix">
                                        <div class="utf_post_block_style post-float clearfix">
                                            <div class="utf_post_thumb">
                                                <img class="img-fluid" src="<?= $news['thumbnail_url'] ?? $defaultThumb ?>" alt="" />
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
                    <div class="widget text-center"> <img class="banner img-fluid" src="<?= base_url() ?>assets/images/banner-ads/ad-sidebar.png" alt="" /> </div>
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