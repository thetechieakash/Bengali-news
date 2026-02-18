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

?>
<section class="utf_featured_post_area mt-5 pt-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 pad-r">
                <div id="utf_featured_slider" class="owl-carousel owl-theme utf_featured_slider content-bottom">
                    <?php foreach ($carousal as $items): ?>
                        <?php
                        $thumbUrl = ThumbHelper::getThumbUrl(
                            $items['thumbnail_url'] ?? null,
                            $items['type'] ?? 'image'
                        );
                        ?>
                        <div class="item" style="background-image:url('<?= esc($thumbUrl) ?>')">
                            <div class="utf_featured_post">
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title title-extra-large">
                                        <a href="<?= base_url('news/' . $items['slug']) ?>">
                                            <?= StringShort::truncate($items['headline']) ?>
                                        </a>
                                    </h2>
                                    <div class="utf_post_meta">
                                        <span class="utf_post_author"><?= esc($items['author']) ?></span>
                                        <span class="utf_post_date"><?= date('d M, Y', strtotime($items['created_at'])) ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>

            <div class="col-lg-4 col-md-12 pad-l">
                <div class="widget text-center"> <img class="banner img-fluid" src="<?= base_url() ?>assets/images/banner-ads/ad-sidebar.png" alt="" /> </div>
            </div>
        </div>
    </div>
</section>
<!-- Feature area end -->

<!-- 1rd Block Wrapper Start -->
<section class="utf_block_wrapper pb-top-0">
    <div class="container">
        <div class="row">
            <?php foreach ($randomPosts as $randomPost): ?>

                <?php
                $rCategory = $randomPost['category'];
                $rPosts    = $randomPost['posts'];

                // Skip empty categories safely
                if (empty($rPosts)) {
                    continue;
                }

                $featured = $rPosts[0];                 // first post
                $listPosts = array_slice($rPosts, 1);   // remaining (0–3)
                ?>

                <div class="col-lg-4 col-md-12">
                    <div class="block color-primary">

                        <!-- CATEGORY TITLE -->
                        <h3 class="utf_block_title">
                            <span><?= esc($rCategory['cat']) ?></span>
                        </h3>

                        <!-- FEATURED POST -->
                        <div class="utf_post_overaly_style clearfix">
                            <div class="utf_post_thumb">
                                <a href="<?= base_url('news/' . $featured['slug']) ?>">
                                    <img class="img-fluid"
                                        src="<?= ThumbHelper::getThumbUrl($featured['thumbnail_url'], $featured['type'])  ?>"
                                        alt="<?= esc($featured['headline']) ?>">
                                </a>
                            </div>

                            <div class="utf_post_content">
                                <h2 class="utf_post_title">
                                    <a href="<?= base_url('news/' . $featured['slug']) ?>">
                                        <?= StringShort::truncate($featured['headline'], 30) ?>
                                    </a>
                                </h2>

                                <div class="utf_post_meta">
                                    <span class="utf_post_author">
                                        <?= esc($featured['author']) ?>
                                    </span>
                                    <span class="utf_post_date">
                                        <?= date('d M, Y', strtotime($featured['post_date_time'])) ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- LIST POSTS -->
                        <?php if (!empty($listPosts)): ?>
                            <div class="utf_list_post_block">
                                <ul class="utf_list_post">

                                    <?php foreach ($listPosts as $listPost): ?>
                                        <li class="clearfix">
                                            <div class="utf_post_block_style post-float clearfix">
                                                <div class="utf_post_thumb">
                                                    <a href="<?= base_url('news/' . $listPost['slug']) ?>">
                                                        <img class="img-fluid"
                                                            src="<?= ThumbHelper::getThumbUrl($listPost['thumbnail_url'], $listPost['type'])?>"
                                                            alt="<?= $listPost['headline'] ?>">
                                                    </a>
                                                </div>

                                                <div class="utf_post_content">
                                                    <h2 class="utf_post_title title-small">
                                                        <a href="<?= base_url('news/' . $listPost['slug']) ?>">
                                                            <?= StringShort::truncate($listPost['headline'], 30) ?>
                                                        </a>
                                                    </h2>

                                                    <div class="utf_post_meta">
                                                        <span class="utf_post_author">
                                                            <?= esc($listPost['author']) ?>
                                                        </span>
                                                        <span class="utf_post_date">
                                                            <?= date('d M, Y', strtotime($listPost['post_date_time'])) ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>

                                </ul>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div>
</section>
<div class="utf_ad_content_area text-center utf_banner_area">
    <div class="container">
        <div class="row">
            <div class="col-sm-12"> <img class="img-fluid" src="<?= base_url() ?>assets/images/banner-ads/ad-content-one.jpg" alt="" /> </div>
        </div>
    </div>
</div>
<!-- 1rd Block Wrapper End -->
<div class="section-divider my-4">
    <span class="divider-title">আরও পড়ুন</span>
</div>
<?php foreach ($getPostAndCategory as $rCatPost): ?>
    <div class="section-header mt-4 mb-3">
        <span class="header-title"><a href=""><?= esc($rCatPost['category']['cat']) ?></a></span>
    </div>
    <!-- 2rd Block Wrapper Start -->
    <section class="utf_block_wrapper solid-bg mb-3">
        <div class="container">
            <div class="row">
                <?php foreach ($rCatPost['posts'] as $rpc): ?>
                    <div class="col-md-4">
                        <div class="utf_post_overaly_style text-center first clearfix mb-3 mb-md-0">
                            <div class="utf_post_thumb">
                                <img class="img-fluid" src="<?= ThumbHelper::getThumbUrl($rpc['thumbnail_url'], $rpc['type'])?>" alt="<?= $rpc['headline'] ?>" />
                            </div>
                            <div class="utf_post_content">
                                <h2 class="utf_post_title">
                                    <a href="<?= base_url('news/' . $rpc['slug']) ?>"><?= StringShort::truncate($rpc['headline']) ?></a>
                                </h2>
                                <div class="utf_post_meta">
                                    <span class="utf_post_author"><?= esc($rpc['author']) ?></span>
                                    <span class="utf_post_date"><?= date('d M, Y', strtotime($rpc['post_date_time'])) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- 2rd Block Wrapper End -->
<?php endforeach; ?>

<!-- 3rd Block Wrapper Start -->
<section class="utf_block_wrapper p-bottom-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="utf_more_news block color-primary">
                    <h3 class="utf_block_title"><span>আরও পড়ুন</span></h3>
                    <?php foreach ($postDuration as $pd): ?>
                        <div class="utf_post_block_style utf_post_float_half clearfix">
                            <div class="utf_post_thumb">
                                <img class="img-fluid" src="<?= ThumbHelper::getThumbUrl($pd['thumbnail_url'], $pd['type']) ?>" alt="<?= $pd['headline'] ?>" />
                            </div>
                            <div class="utf_post_content">
                                <h2 class="utf_post_title">
                                    <a href="<?= base_url('news/' . $pd['slug']) ?>"><?= StringShort::truncate($pd['headline'], 40)  ?></a>
                                </h2>
                                <div class="utf_post_meta">
                                    <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span>
                                </div>
                                <p><?= StringShort::truncate($pd['short_description'], 250)  ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="sidebar utf_sidebar_right">
                    <div class="widget color-primary">
                        <h3 class="utf_block_title"><span>বিখ্যাত সংবাদ</span></h3>
                        <div class="utf_list_post_block">
                            <ul class="utf_list_post">
                                <?php foreach ($popularNews as $pN): ?>
                                    <li class="clearfix">
                                        <div class="utf_post_block_style post-float clearfix">
                                            <div class="utf_post_thumb">
                                                <img class="img-fluid" src="<?= ThumbHelper::getThumbUrl($pN['thumbnail_url'], $pN['type']) ?>" alt="<?= $pN['headline'] ?>" />
                                            </div>
                                            <div class="utf_post_content">
                                                <h2 class="utf_post_title title-small">
                                                    <a href="<?= base_url('news/' . $pN['slug']) ?>"><?= StringShort::truncate($pN['headline'], 30)  ?></a>
                                                </h2>
                                                <div class="utf_post_meta">
                                                    <span class="utf_post_author"><?= esc($pN['author']) ?></span>
                                                    <span class="utf_post_date"><?= date('d M, Y', strtotime($pN['post_date_time'])) ?></span>
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
<!-- 3rd Block Wrapper End -->
<?= $this->endSection() ?>
<?= $this->section('jsPlugins') ?>
<?= $this->endSection() ?>
<?= $this->section('customjs') ?>

<?= $this->endSection() ?>