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
<section class="utf_block_wrapper py-3 mt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="block category-listing category-style2 color-primary">
                    <h3>Search result for : "<?= esc($keyword) ?>"</h3>
                    <h3 class="utf_block_title"></h3>
                    <?php if (!empty($results)): ?>
                        <?php foreach ($results as $post): ?>
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
                        <div class="card ">
                            <div class="card-body bg-info mx-auto">
                                Sorry! can not found any news releated to "<?= esc($keyword) ?>"!
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?= $pager->links() ?>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="sidebar utf_sidebar_right">
                    <div class="widget text-center"> <img class="banner img-fluid" src="<?= base_url() ?>assets/images/banner-ads/ad-sidebar.png" alt="" /> </div>
                    <div class="widget color-primary">
                        <h3 class="utf_block_title"><span>বিখ্যাত সংবাদ</span></h3>
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