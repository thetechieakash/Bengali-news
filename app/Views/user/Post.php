<?php

use App\Helpers\StringShort;
use App\Helpers\ThumbHelper;

$thumbUrl = ThumbHelper::getThumbUrl(
    $post['thumbnail']['thumbnail_url'] ?? null,
    $post['thumbnail']['type'] ?? null
);
?>
<?= $this->extend('layouts/ViewLayout.php') ?>
<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('HomeMeta') ?>
<meta name="description" content="<?= $post['short_description'] ?>">
<meta name="keywords" content="<?= esc($post['headline']) ?>, <?= $post['short_description'] ?>, Purulia news, West Bengal news, local news, Purulia Mirror">
<meta name="author" content="Purulia Mirror">
<meta name="robots" content="index, follow">
<link rel="canonical" href="<?= current_url(); ?>">

<meta property="og:type" content="news">
<meta property="og:title" content="<?= esc($pageTitle); ?>">
<meta property="og:description" content="<?= $post['short_description'] ?>">
<meta property="og:image" content="<?= $thumbUrl; ?>">
<meta property="og:url" content="<?= current_url(); ?>">
<meta property="og:site_name" content="Purulia Mirror">

<meta name="twitter:card" content="<?= $thumbUrl; ?>">
<meta name="twitter:title" content="<?= esc($post['headline']) ?>">
<meta name="twitter:description" content="<?= esc($post['headline']) ?>">
<meta name="twitter:image" content="<?= $thumbUrl; ?>">

<meta name="news_keywords" content="<?= esc($post['headline']) ?>, Purulia, West Bengal, Local News">
<meta property="article:published_time" content="<?= $post['post_date_time']; ?> +05:30">
<meta property="article:modified_time" content="<?= $post['post_date_time']; ?>+05:30">
<meta property="article:author" content="Purulia Mirror">

<meta name="geo.region" content="IN-WB">
<meta name="geo.placename" content="Purulia">
<meta name="geo.position" content="23.33;86.36">
<meta name="ICBM" content="23.33, 86.36">
<?= $this->endSection() ?>
<?= $this->section('cssPlugins') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/jquery-toast-plugin/jquery.toast.min.css">
<link rel="stylesheet" href="<?= base_url() ?>assets/vendors/glightbox/glightbox.min.css" />
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php



function formattedPostDate($date)
{
    $formatted = new Datetime($date);
    return $formatted->format('d M, Y');
}
?>
<!-- Page Title Start -->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="<?= base_url() ?>">হোম</a></li>
                    <li>খবর</li>
                    <li><?= esc($post['headline']) ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page title end -->

<!-- 1rd Block Wrapper Start -->
<section class="utf_block_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="single-post">
                    <div class="utf_post_title-area">
                        <?php if (!empty($post['categories'])): ?>
                            <?php foreach ($post['categories'] as $cats): ?>
                                <a class="utf_post_cat" href="<?= $cats['slug'] ?>"><?= $cats['name'] ?></a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <h1 class="utf_post_title"><?= esc($post['headline']) ?></h1>
                        <?php if (isset($post['short_description'])): ?>
                            <div class="fst-italic p-3 px-5 mb-3">
                                <?= $post['short_description'] ?>
                            </div>
                        <?php endif; ?>
                        <div class="utf_post_meta">
                            <span class="utf_post_author">Puruliamirror Digital Desk</span>
                            <span class="utf_post_date"><?= formattedPostDate($post['post_date_time']) ?></span>
                            <span class="post-hits">
                                <i class="fa fa-eye"></i> <?= sprintf("%02d", $post['views']) ?>
                            </span>
                            <?php if (count($comments) > 0): ?>
                                <span class="post-comment">
                                    <i class="fa fa-comments-o"></i>
                                    <a href="<?= !empty($comments) ? '#comments' : 'javascript:void(0)' ?>" class="comments-link">
                                        <span><?= sprintf("%02d", count($comments)) ?></span>
                                    </a>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="utf_post_content-area">
                        <div class="post-media post-featured-image">
                            <?php
                            $thumbUrl = ThumbHelper::getThumbUrl(
                                $post['thumbnail']['thumbnail_url'] ?? null,
                                $post['thumbnail']['type'] ?? null
                            );
                            ?>
                            <a href="<?= esc($thumbUrl) ?>" class="glightbox-single">
                                <img src="<?= esc($thumbUrl) ?>" class="img-fluid" alt="<?= $post['headline'] ?>">
                            </a>
                        </div>
                        <?php if (!empty($post['sub_author'])): ?>
                            <div class="d-flex align-items-center p-3 mb-3 shadow-sm">

                                <!-- Profile Image -->
                                <div class="me-3">
                                    <img src="<?= base_url($post['sub_author']['profile_image']) ?>"
                                        alt="Author Image"
                                        class="rounded-circle"
                                        style="width:60px; height:60px; object-fit:cover;">
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">
                                        <?= esc($post['sub_author']['name']); ?>
                                    </h6>
                                    <small class="text-muted">
                                        <?= esc($post['sub_author']['email']); ?>
                                    </small>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="entry-content">
                            <?= $post['description'] ?>
                        </div>
                        <?php if (!empty($post['sub_author'])): ?>
                            <div class="warn_div">
                                <h5>Disclaimer:</h5>
                                <p>এই প্রবন্ধটি অতিথি লেখক <strong><?= esc($post['sub_author']['name']); ?></strong> -এর রচনা। এতে প্রকাশিত মতামত সম্পূর্ণভাবে লেখকের নিজস্ব এবং তা Purulia Mirror-এর মতামত বা অবস্থানকে প্রতিফলিত করে না। এই লেখায় উল্লিখিত তথ্যসমূহ Purulia Mirror স্বতন্ত্রভাবে যাচাই করেনি এবং এর বিষয়বস্তুর জন্য পত্রিকা কোনো দায়ভার গ্রহণ করে না। এ বিষয়ে কোনো প্রশ্ন বা আপত্তি থাকলে অনুগ্রহ করে সরাসরি লেখকের সঙ্গে <strong><a href="mailto:<?= $post['sub_author']['email']; ?>"><?= esc($post['sub_author']['email']); ?></a></strong> -এ যোগাযোগ করুন।</p>
                            </div>
                        <?php endif; ?>
                        <?php if (count($post['tags']) > 0): ?>
                            <div class="tags-area clearfix">
                                <div class="post-tags">
                                    <span>ট্যাগ:</span>
                                    <?php foreach ($post['tags'] as $tag): ?>
                                        <a href="<?= base_url('tag/' . $tag['name']) ?>"># <?= $tag['name'] ?></a>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="share-items clearfix">
                            <?php
                            $postUrl = current_url();
                            $encodedUrl = urlencode($postUrl);
                            $encodedText = urlencode($post['headline']);
                            ?>
                            <ul class="social-icon mb-1 text-end text-md-start">
                                <li title="Copy Link">
                                    <a href="javascript:void(0)" onclick="copyLink(this, '<?= $postUrl ?>')">
                                        <i class="fa-solid fa-copy"></i>
                                    </a>
                                </li>
                                <li title="Share on Facebook">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $encodedUrl ?>" target="_blank">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li title="Share on WhatsApp">
                                    <a href="https://wa.me/?text=<?= $encodedText ?>%20<?= $encodedUrl ?>" target="_blank">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>
                                </li>
                                <li title="Share on Twitter">
                                    <a href="https://twitter.com/intent/tweet?url=<?= $encodedUrl ?>&text=<?= $encodedText ?>" target="_blank">
                                        <i class="fa-brands fa-x-twitter"></i>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="related-posts block color-primary">
                    <h3 class="utf_block_title"><span>সম্পর্কিত লিংক</span></h3>
                    <div id="utf_latest_news_slide" class="owl-carousel owl-theme utf_latest_news_slide">
                        <?php foreach ($relatedPosts as $related): ?>
                            <?php
                            // Get safe thumbnail URL
                            $relUrl = ThumbHelper::getThumbUrl(
                                $related['thumbnail_url'] ?? null,
                                $related['type'] ?? 'image' // default type
                            );

                            // Format post date
                            $formattedPostDate = isset($related['post_date_time'])
                                ? (new DateTime($related['post_date_time']))->format('d M, Y')
                                : '';
                            ?>
                            <div class="item">
                                <div class="utf_post_block_style clearfix">
                                    <div class="utf_post_thumb">
                                        <a href="<?= esc($relUrl) ?>" class="glightbox">
                                            <img class="img-fluid" src="<?= esc($relUrl) ?>" alt="<?= esc($related['headline']) ?>" />
                                        </a>
                                    </div>
                                    <div class="utf_post_content">
                                        <h2 class="utf_post_title title-medium">
                                            <a href="<?= base_url('news/' . $related['slug']) ?>">
                                                <?= StringShort::truncate($related['headline'], 25) ?>
                                            </a>
                                        </h2>
                                        <?php if ($formattedPostDate): ?>
                                            <div class="utf_post_meta">
                                                <span class="utf_post_date"><?= esc($formattedPostDate) ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- Post comment start -->
                <?php if (!empty($comments)): ?>
                    <div id="comments" class="comments-area color-primary  block">
                        <h3 class="utf_block_title">
                            <span><?= sprintf("%02d", count($comments)); ?> কমেন্ট</span>
                        </h3>
                        <ul class="comments-list">
                            <?php foreach ($comments as $comment): ?>
                                <li id="comment-<?= $comment['id'] ?>">
                                    <div class="comment mb-3 p-3">
                                        <div class="comment-body">
                                            <div class="meta-data">
                                                <span class="comment-author"><i class="fa fa-user me-2"></i><?= ucwords($comment['guest_name']) ?></span>
                                                <span class="comment-date pull-right"><?= formattedPostDate($comment['created_at']) ?></span>
                                            </div>
                                            <div class="comment-content my-1 ms-4">
                                                <p><?= $comment['comment'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (!empty($comment['reply'])): ?>
                                        <ul class="comments-reply">
                                            <?php foreach ($comment['reply'] as $reply): ?>
                                                <li>
                                                    <div class="comment mb-3">
                                                        <div class="comment-body">
                                                            <div class="meta-data">
                                                                <span class="comment-author"><i class="fa fa-mail-reply me-2"></i>Puruliamirror Digital Desk</span>
                                                                <span class="comment-date pull-right">
                                                                    <?= formattedPostDate($reply['created_at']) ?>
                                                                </span>
                                                            </div>
                                                            <div class="comment-content my-1 ms-4">
                                                                <p><?= esc($reply['comment']) ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>

                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <!-- Post comment end -->
                <!-- Comments Form Start -->
                <div class="comments-form">
                    <form method="post" action="<?= base_url('comment') ?>" id="comment">
                        <h3 class="title-normal">কমেন্ট করুন</h3>
                        <?= csrf_field() ?>
                        <input type="hidden" name="postid" id="postid" value="<?= esc($post['id']) ?>">
                        <input type="hidden" name="g-recaptcha-response" id="recaptcha_token">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="name" placeholder="Full name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="email" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control required-field" name="comment" id="message" placeholder="Comment" rows="10" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">
                            <button
                                type="button"
                                id="commentSubmit"
                                class="comments-btn btn btn-primary">
                                Post Comment
                            </button>

                        </div>
                    </form>
                </div>
                <!-- Comments form end -->
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="sidebar utf_sidebar_right">
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
                        <h3 class="utf_block_title">
                            <span>আরও পড়ুন</span>
                        </h3>
                        <div class="utf_list_post_block">
                            <ul class="utf_list_post">
                                <?php foreach ($readMorePosts as $readMore): ?>
                                    <?php
                                    // Safe thumbnail URL
                                    $thumbUrl = \App\Helpers\ThumbHelper::getThumbUrl(
                                        $readMore['thumbnail_url'] ?? null,
                                        $readMore['type'] ?? 'image' // default type
                                    );

                                    // Format post date safely
                                    $postDate = isset($readMore['post_date_time'])
                                        ? (new DateTime($readMore['post_date_time']))->format('d M, Y')
                                        : '';
                                    ?>
                                    <li class="clearfix">
                                        <div class="utf_post_block_style post-float clearfix">
                                            <div class="utf_post_thumb">
                                                <a href="<?= base_url('news/' . $readMore['slug']) ?>" class="glightbox">
                                                    <img class="img-fluid" src="<?= esc($thumbUrl) ?>" alt="<?= esc($readMore['headline']) ?>" />
                                                </a>
                                            </div>
                                            <div class="utf_post_content">
                                                <h2 class="utf_post_title title-small">
                                                    <a href="<?= base_url('news/' . $readMore['slug']) ?>">
                                                        <?= StringShort::truncate($readMore['headline'], 30) ?>
                                                    </a>
                                                </h2>
                                                <div class="utf_post_meta">
                                                    <?php if ($postDate): ?>
                                                        <span class="utf_post_date"><?= esc($postDate) ?></span>
                                                    <?php endif; ?>
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
                    <div class="widget color-primary widget-tags">
                        <h3 class="utf_block_title"><span>অন্যান্য ট্যাগ</span></h3>
                        <ul class="unstyled clearfix">
                            <?php foreach ($popularTags as $tags): ?>
                                <li>
                                    <a href="<?= base_url('tag/' . $tags['name']) ?>"><?= esc($tags['name']) ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
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
                </div>
            </div>
        </div>
    </div>
</section>
<!-- 1rd Block Wrapper End -->

<?= $this->endSection() ?>
<?= $this->section('jsPlugins') ?>
<script src="<?= base_url() ?>assets/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
<script src="<?= base_url() ?>assets/customs/js/custom.toast.js"></script>
<script src="<?= base_url() ?>assets/vendors/glightbox/glightbox.min.js"></script>
<?= $this->endSection() ?>
<?= $this->section('customjs') ?>
<script src="https://www.google.com/recaptcha/api.js?render=<?= $recaptcha_key ?>"></script>
<script>
    function copyLink(el, url) {
        const icon = el.querySelector('i');

        navigator.clipboard.writeText(url).then(() => {
            // change to tick
            icon.classList.remove('fa-solid', 'fa-copy');
            icon.classList.add('fa-solid', 'fa-check');
            showSuccessToast("Post Link copied");

            // revert after 2 seconds
            setTimeout(() => {
                icon.classList.remove('fa-solid', 'fa-check');
                icon.classList.add('fa-solid', 'fa-copy');
            }, (1000 * 10));
        }).catch((err) => {
            showWarningToast("Link copied failed");

            console.error("Copy failed", err);
        });
    }
    const lightbox = GLightbox({
        selector: '.glightbox-single',
        touchNavigation: false,
        loop: false
    });
    $(document).on('click', '#commentSubmit', function(e) {
        e.preventDefault();

        grecaptcha.ready(function() {
            grecaptcha.execute('<?= $recaptcha_key ?>', {
                    action: 'comment'
                })
                .then(function(token) {

                    // attach token
                    $('#recaptcha_token').val(token);

                    $.ajax({
                        url: "<?= base_url('comment') ?>",
                        type: "POST",
                        data: $('#comment').serialize(),
                        dataType: "json",
                        beforeSend: function() {
                            $('#commentSubmit').prop('disabled', true).text('Posting...');
                        },
                        success: function(res) {
                            if (res.success) {
                                $('#comment')[0].reset();
                                showSuccessToast(res.message);
                            } else {
                                Object.values(res.errors).forEach(msg => {
                                    showWarningToast(msg);
                                })
                            }
                        },
                        error: function(err) {
                            showWarningToast('Something went wrong. Try again.');
                            console.error('Comment submit ajax error', err)
                        },
                        complete: function() {
                            $('#commentSubmit').prop('disabled', false).text('Post Comment');
                        }
                    });

                });
        });
    });
</script>

<?= $this->endSection() ?>