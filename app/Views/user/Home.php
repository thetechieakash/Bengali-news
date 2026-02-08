<?= $this->extend('layouts/ViewLayout.php') ?>
<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('cssPlugins') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php

use App\Helpers\StringShort;
?>

<section class="utf_featured_post_area mt-5 pt-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 pad-r">
                <div id="utf_featured_slider" class="owl-carousel owl-theme utf_featured_slider content-bottom">
                    <?php foreach ($carousal as $items): ?>
                        <div class="item" style="background-image:url(<?= $items['thumbnail_url'] ?? base_url('assets/images/news/placeholder.png') ?>)">
                            <div class="utf_featured_post">
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title title-extra-large">
                                        <a href="<?= base_url('news/' . $items['slug']) ?>"><?= StringShort::truncate($items['headline']) ?></a>
                                    </h2>
                                    <div class="utf_post_meta">
                                        <span class="utf_post_author"><?= $items['author'] ?></span>
                                        <?php
                                        $date = new DateTime($items['created_at']);
                                        $formattedDate =  $date->format('d,M Y H:i'); ?>
                                        <span class="utf_post_date"><?= $formattedDate ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

            <div class="col-lg-4 col-md-12 pad-l">
                <div class="widget text-center"> <img class="banner img-fluid" src="<?= base_url() ?>assets/images/banner-ads/ad-sidebar.png" alt="" /> </div>

                <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="utf_post_overaly_style text-center first clearfix">
                            <div class="utf_post_thumb"> <a href="#"><img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/gadget2.jpg" alt="" /></a> </div>
                            <div class="utf_post_content"> <a class="utf_post_cat" href="#">Lifestyle</a>
                                <h2 class="utf_post_title title-medium"> <a href="#">Samsung Gear S3 review: A whimper, when…</a> </h2>
                                <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="utf_post_overaly_style text-center clearfix">
                            <div class="utf_post_thumb"> <a href="#"><img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/game1.jpg" alt="" /></a> </div>
                            <div class="utf_post_content"> <a class="utf_post_cat" href="#">Games</a>
                                <h2 class="utf_post_title title-medium"> <a href="#">Historical heroes and robot dinosaurs: New games...</a> </h2>
                                <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>
<!-- Feature area end -->

<!-- 1rd Block Wrapper Start -->
<section class="utf_block_wrapper pb-top-0">
    <div class="container">
        <div class="row">
            <?php foreach ($randomPosts as $item): ?>

                <?php
                $category = $item['category'];
                $posts    = $item['posts'];

                // Skip empty categories safely
                if (empty($posts)) {
                    continue;
                }

                $featured = $posts[0];                 // first post
                $listPosts = array_slice($posts, 1);   // remaining (0–3)
                ?>

                <div class="col-lg-4 col-md-12">
                    <div class="block color-primary">

                        <!-- CATEGORY TITLE -->
                        <h3 class="utf_block_title">
                            <span><?= esc($category['cat']) ?></span>
                        </h3>

                        <!-- FEATURED POST -->
                        <div class="utf_post_overaly_style clearfix">
                            <div class="utf_post_thumb">
                                <a href="<?= base_url('news/' . $featured['slug']) ?>">
                                    <img class="img-fluid"
                                        src="<?= $featured['thumbnail_url'] ?? base_url('assets/images/news/placeholder.png') ?>"
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

                                    <?php foreach ($listPosts as $post): ?>
                                        <li class="clearfix">
                                            <div class="utf_post_block_style post-float clearfix">
                                                <div class="utf_post_thumb">
                                                    <a href="<?= base_url('news/' . $post['slug']) ?>">
                                                        <img class="img-fluid"
                                                            src="<?= $post['thumbnail_url'] ?: base_url('assets/images/default.jpg') ?>"
                                                            alt="">
                                                    </a>
                                                </div>

                                                <div class="utf_post_content">
                                                    <h2 class="utf_post_title title-small">
                                                        <a href="<?= base_url('news/' . $post['slug']) ?>">
                                                            <?= StringShort::truncate($post['headline'], 30) ?>
                                                        </a>
                                                    </h2>

                                                    <div class="utf_post_meta">
                                                        <span class="utf_post_author">
                                                            <?= esc($post['author']) ?>
                                                        </span>
                                                        <span class="utf_post_date">
                                                            <?= date('d M, Y', strtotime($post['post_date_time'])) ?>
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
<!-- 1rd Block Wrapper End -->
<div class="section-divider my-4">
    <span class="divider-title">আরও পড়ুন</span>
</div>
<div class="section-header mt-4 mb-3">
    <span class="header-title">খেলা</span>
</div>
<!-- 2rd Block Wrapper Start -->
<section class="utf_block_wrapper solid-bg">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="utf_post_overaly_style text-center first clearfix mb-3 mb-md-0">
                    <div class="utf_post_thumb">
                        <a href="#">
                            <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/gadget2.jpg" alt="" />
                        </a>
                    </div>
                    <div class="utf_post_content">
                        <a class="utf_post_cat" href="#">ক্রিকেট</a>
                        <h2 class="utf_post_title"> <a href="#">২০২৭ বিশ্বকাপ নিয়ে গম্ভীরের সঙ্গে কথা শুরু রোহিত-কোহলির! ফাঁস টিম ইন্ডিয়ার অন্দরের খবর</a> </h2>
                        <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="utf_post_overaly_style text-center clearfix mb-3 mb-md-0">
                    <div class="utf_post_thumb">
                        <a href="#">
                            <img class="img-fluid" src="<?= base_url() ?>assets/images/news/lifestyle/health5.jpg" alt="" />
                        </a>
                    </div>
                    <div class="utf_post_content">
                        <a class="utf_post_cat" href="#">ফুটবল</a>
                        <h2 class="utf_post_title">
                            <a href="#">সন্তোষের জন্য দল ঘোষণা সঞ্জয় সেনের, খেতাব ধরে রাখতে কাদের উপর আস্থা রাখলেন বাংলার কোচ?</a>
                        </h2>
                        <div class="utf_post_meta">
                            <span class="utf_post_author"> John Wick</span>
                            <span class="utf_post_date">25 Jan, 2022</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="utf_post_overaly_style text-center clearfix">
                    <div class="utf_post_thumb">
                        <a href="#">
                            <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/game1.jpg" alt="" />
                        </a>
                    </div>
                    <div class="utf_post_content">
                        <a class="utf_post_cat" href="#">অন্যান্য</a>
                        <h2 class="utf_post_title">
                            <a href="#">১০ বছর ধরে পরকীয়ায় জড়িয়ে মেরি কম! বিস্ফোরক প্রাক্তন স্বামী</a>
                        </h2>
                        <div class="utf_post_meta">
                            <span class="utf_post_author"> John Wick</span>
                            <span class="utf_post_date">25 Jan, 2022</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- 2rd Block Wrapper End -->

<!-- 3rd Block Wrapper Start -->
<section class="utf_block_wrapper p-bottom-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="utf_more_news block color-primary">
                    <h3 class="utf_block_title"><span>আরও পড়ুন</span></h3>
                    <div id="utf_more_news_slide" class="owl-carousel owl-theme utf_more_news_slide">
                        <div class="item">
                            <div class="utf_post_block_style utf_post_float_half clearfix">
                                <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/video/video1.jpg" alt="" /> </a> </div>
                                <a class="utf_post_cat" href="#">Video</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title"> <a href="#">Ratcliffe to be Director of intelligence Trump ignored smart innocent...</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since has five...</p>
                                </div>
                            </div>

                            <div class="utf_post_block_style utf_post_float_half clearfix">
                                <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/game5.jpg" alt="" /> </a> </div>
                                <a class="utf_post_cat" href="#">Games</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title"> <a href="#">Ratcliffe to be Director of intelligence Trump ignored smart innocent...</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since has five...</p>
                                </div>
                            </div>

                            <div class="utf_post_block_style utf_post_float_half clearfix">
                                <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/game4.jpg" alt="" /> </a> </div>
                                <a class="utf_post_cat" href="#">Games</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title"> <a href="#">Zhang social media pop also known when smart innocent...</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since has five...</p>
                                </div>
                            </div>

                            <div class="utf_post_block_style utf_post_float_half clearfix">
                                <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/robot5.jpg" alt="" /> </a> </div>
                                <a class="utf_post_cat" href="#">Traveling</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title"> <a href="#">Zhang social media pop also known when smart innocent...</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since has five...</p>
                                </div>
                            </div>

                            <div class="utf_post_block_style utf_post_float_half clearfix">
                                <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/video/video3.jpg" alt="" /> </a> </div>
                                <a class="utf_post_cat" href="#">Video</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title"> <a href="#">Breeze through 17 locations in Europe in this breathtaking v…</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since has five...</p>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="utf_post_block_style utf_post_float_half clearfix">
                                <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/video/video2.jpg" alt="" /> </a> </div>
                                <a class="utf_post_cat" href="#">Video</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title"> <a href="#">Ratcliffe to be Director of intelligence Trump ignored smart innocent...</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since has five...</p>
                                </div>
                            </div>

                            <div class="utf_post_block_style utf_post_float_half clearfix">
                                <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/video/video3.jpg" alt="" /> </a> </div>
                                <a class="utf_post_cat" href="#">Video</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title"> <a href="#">Breeze through 17 locations in Europe in this breathtaking v…</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since has five...</p>
                                </div>
                            </div>

                            <div class="utf_post_block_style utf_post_float_half clearfix">
                                <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/lifestyle/architecture1.jpg" alt="" /> </a> </div>
                                <a class="utf_post_cat" href="#">Architecture</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title"> <a href="#">Science meets architecture in robotically woven, solar...</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since has five...</p>
                                </div>
                            </div>

                            <div class="utf_post_block_style utf_post_float_half clearfix">
                                <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/game1.jpg" alt="" /> </a> </div>
                                <a class="utf_post_cat" href="#">Traveling</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title"> <a href="#">Historical heroes and robot dinosaurs: New games on our…</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since has five...</p>
                                </div>
                            </div>

                            <div class="utf_post_block_style utf_post_float_half clearfix">
                                <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/video/video3.jpg" alt="" /> </a> </div>
                                <a class="utf_post_cat" href="#">Video</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title"> <a href="#">Breeze through 17 locations in Europe in this breathtaking v…</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since has five...</p>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="utf_post_block_style utf_post_float_half clearfix">
                                <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/video/video1.jpg" alt="" /> </a> </div>
                                <a class="utf_post_cat" href="#">Video</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title"> <a href="#">Ratcliffe to be Director of intelligence Trump ignored smart innocent...</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since has five...</p>
                                </div>
                            </div>

                            <div class="utf_post_block_style utf_post_float_half clearfix">
                                <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/game5.jpg" alt="" /> </a> </div>
                                <a class="utf_post_cat" href="#">Games</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title"> <a href="#">Ratcliffe to be Director of intelligence Trump ignored smart innocent...</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since has five...</p>
                                </div>
                            </div>

                            <div class="utf_post_block_style utf_post_float_half clearfix">
                                <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/game4.jpg" alt="" /> </a> </div>
                                <a class="utf_post_cat" href="#">Games</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title"> <a href="#">Zhang social media pop also known when smart innocent...</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since has five...</p>
                                </div>
                            </div>

                            <div class="utf_post_block_style utf_post_float_half clearfix">
                                <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/robot5.jpg" alt="" /> </a> </div>
                                <a class="utf_post_cat" href="#">Traveling</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title"> <a href="#">Zhang social media pop also known when smart innocent...</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since has five...</p>
                                </div>
                            </div>

                            <div class="utf_post_block_style utf_post_float_half clearfix">
                                <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/video/video3.jpg" alt="" /> </a> </div>
                                <a class="utf_post_cat" href="#">Video</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title"> <a href="#">Breeze through 17 locations in Europe in this breathtaking v…</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since has five...</p>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="utf_post_block_style utf_post_float_half clearfix">
                                <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/video/video2.jpg" alt="" /> </a> </div>
                                <a class="utf_post_cat" href="#">Video</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title"> <a href="#">Ratcliffe to be Director of intelligence Trump ignored smart innocent...</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since has five...</p>
                                </div>
                            </div>

                            <div class="utf_post_block_style utf_post_float_half clearfix">
                                <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/video/video3.jpg" alt="" /> </a> </div>
                                <a class="utf_post_cat" href="#">Video</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title"> <a href="#">Breeze through 17 locations in Europe in this breathtaking v…</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since has five...</p>
                                </div>
                            </div>

                            <div class="utf_post_block_style utf_post_float_half clearfix">
                                <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/lifestyle/architecture1.jpg" alt="" /> </a> </div>
                                <a class="utf_post_cat" href="#">Architecture</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title"> <a href="#">Science meets architecture in robotically woven, solar...</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since has five...</p>
                                </div>
                            </div>

                            <div class="utf_post_block_style utf_post_float_half clearfix">
                                <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/game1.jpg" alt="" /> </a> </div>
                                <a class="utf_post_cat" href="#">Traveling</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title"> <a href="#">Historical heroes and robot dinosaurs: New games on our…</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since has five...</p>
                                </div>
                            </div>

                            <div class="utf_post_block_style utf_post_float_half clearfix">
                                <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/video/video3.jpg" alt="" /> </a> </div>
                                <a class="utf_post_cat" href="#">Video</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title"> <a href="#">Breeze through 17 locations in Europe in this breathtaking v…</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text since has five...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="sidebar utf_sidebar_right">
                    <div class="widget color-primary">
                        <h3 class="utf_block_title"><span>Popular News</span></h3>
                        <div class="utf_post_overaly_style clearfix">
                            <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/lifestyle/health4.jpg" alt="" /> </a> </div>
                            <div class="utf_post_content"> <a class="utf_post_cat" href="#">Health</a>
                                <h2 class="utf_post_title"> <a href="#">Smart packs parking sensor tech and beeps when col…</a> </h2>
                                <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                            </div>
                        </div>

                        <div class="utf_list_post_block">
                            <ul class="utf_list_post">
                                <li class="clearfix">
                                    <div class="utf_post_block_style post-float clearfix">
                                        <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/gadget3.jpg" alt="" /> </a> <a class="utf_post_cat" href="#">Lifestyle</a> </div>
                                        <div class="utf_post_content">
                                            <h2 class="utf_post_title title-small"> <a href="#">Zhang social media pop also known when smart innocent...</a> </h2>
                                            <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="clearfix">
                                    <div class="utf_post_block_style post-float clearfix">
                                        <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/lifestyle/travel5.jpg" alt="" /> </a> <a class="utf_post_cat" href="#">Travel</a> </div>
                                        <div class="utf_post_content">
                                            <h2 class="utf_post_title title-small"> <a href="#">Zhang social media pop also known when smart innocent...</a> </h2>
                                            <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="clearfix">
                                    <div class="utf_post_block_style post-float clearfix">
                                        <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/robot5.jpg" alt="" /> </a> <a class="utf_post_cat" href="#">Traveling</a> </div>
                                        <div class="utf_post_content">
                                            <h2 class="utf_post_title title-small"> <a href="#">Zhang social media pop also known when smart innocent...</a> </h2>
                                            <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="clearfix">
                                    <div class="utf_post_block_style post-float clearfix">
                                        <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/gadget2.jpg" alt="" /> </a> <a class="utf_post_cat" href="#">Lifestyle</a> </div>
                                        <div class="utf_post_content">
                                            <h2 class="utf_post_title title-small"> <a href="#">Zhang social media pop also known when smart innocent...</a> </h2>
                                            <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date">25 Jan, 2022</span> </div>
                                        </div>
                                    </div>
                                </li>
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