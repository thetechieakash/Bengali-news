<?= $this->extend('layouts/ViewLayout.php') ?>
<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('cssPlugins') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?php

use App\Helpers\StringShort;

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
                    <li><a href="<?= base_url() ?>">Home</a></li>
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
                        <?php foreach ($post['categories'] as $cats): ?>
                            <a class="utf_post_cat" href="<?= $cats['slug'] ?>"><?= $cats['name'] ?></a>
                        <?php endforeach; ?>
                        <h1 class="utf_post_title"><?= esc($post['headline']) ?></h1>
                        <div class="utf_post_meta">
                            <span class="utf_post_author"><?= esc($post['author']) ?></span>
                            <?php
                            $formattedPostDate = (new DateTime($post['post_date_time '] ?? $post['created_at']))->format('d M, Y'); ?>
                            <span class="utf_post_date"><?= $formattedPostDate ?></span>
                            <!-- <span class="post-hits">
                                <i class="fa fa-eye"></i> 21
                            </span> -->
                            <span class="post-comment">
                                <i class="fa fa-comments-o"></i>
                                <a href="#comments" class="comments-link">
                                    <span>01</span>
                                </a>
                            </span>
                        </div>
                    </div>

                    <div class="utf_post_content-area">
                        <div class="post-media post-featured-image">
                            <?php if (isset($post['thumbnail']['thumbnail_url'])): ?>
                                <a href="<?= esc($post['thumbnail']['thumbnail_url']) ?>" class="glightbox">
                                    <img src="<?= esc($post['thumbnail']['thumbnail_url']) ?>" class="img-fluid" alt="">
                                </a>
                            <?php else: ?>
                                <a href="<?= base_url('assets/images/news/placeholder.png') ?>" class="glightbox">
                                    <img src="<?= base_url('assets/images/news/placeholder.png') ?>" class="img-fluid" alt="">
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="entry-content">
                            <?= $post['description'] ?>
                        </div>

                        <div class="tags-area clearfix">
                            <div class="post-tags">
                                <span>Tags:</span>
                                <?php foreach ($post['tags'] as $tag): ?>
                                    <a href="#"># <?= $tag['name'] ?></a>
                                <?php endforeach ?>
                            </div>
                        </div>

                        <div class="share-items clearfix">
                            <ul class="post-social-icons unstyled">
                                <?php $postUrl   = current_url(); ?>
                                <li class="facebook">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $postUrl ?>" target="_blank" rel="noopener">
                                        <i class="fa fa-facebook"></i>
                                        <span class="ts-social-title">Facebook</span>
                                    </a>
                                </li>
                                <li class="twitter">
                                    <a href="https://twitter.com/intent/tweet?url=<?= $postUrl ?>&text=<?= esc($post['headline']) ?>" target="_blank" rel="noopener"> <i class="fa fa-twitter"></i>
                                        <span class="ts-social-title">Twitter</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <nav class="post-navigation clearfix">
                    <div class="post-previous">
                        <a href="#"> <span><i class="fa fa-angle-left"></i>Previous Post</span>
                            <h3>Zhang social media pop also known when smart innocent...</h3>
                        </a>
                    </div>
                    <div class="post-next">
                        <a href="#"> <span>Next Post <i class="fa fa-angle-right"></i></span>
                            <h3>Zhang social media pop also known when smart innocent...</h3>
                        </a>
                    </div>
                </nav>

                <div class="related-posts block">
                    <h3 class="utf_block_title"><span>Related Posts</span></h3>
                    <div id="utf_latest_news_slide" class="owl-carousel owl-theme utf_latest_news_slide">
                        <div class="item">
                            <div class="utf_post_block_style clearfix">
                                <div class="utf_post_thumb"> <a href="#"><img class="img-fluid" src="<?= base_url() ?>assets/images/news/lifestyle/travel5.jpg" alt="" /></a> </div>
                                <a class="utf_post_cat" href="#">Health</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title title-medium"> <a href="#">Zhang social media pop also innocent...</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_date"> 25 Jan, 2022</span> </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="utf_post_block_style clearfix">
                                <div class="utf_post_thumb"> <a href="#"><img class="img-fluid" src="<?= base_url() ?>assets/images/news/lifestyle/health5.jpg" alt="" /></a> </div>
                                <a class="utf_post_cat" href="#">Health</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title title-medium"> <a href="#">Zhang social media pop also innocent...</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_date"> 25 Jan, 2022</span> </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="utf_post_block_style clearfix">
                                <div class="utf_post_thumb"> <a href="#"><img class="img-fluid" src="<?= base_url() ?>assets/images/news/lifestyle/travel3.jpg" alt="" /></a> </div>
                                <a class="utf_post_cat" href="#">Travel</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title title-medium"> <a href="#">Zhang social media pop also innocent...</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_date"> 25 Jan, 2022</span> </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="utf_post_block_style clearfix">
                                <div class="utf_post_thumb"> <a href="#"><img class="img-fluid" src="<?= base_url() ?>assets/images/news/lifestyle/travel4.jpg" alt="" /></a> </div>
                                <a class="utf_post_cat" href="#">Travel</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title title-medium"> <a href="#">Zhang social media pop also innocent...</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_date"> 25 Jan, 2022</span> </div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="utf_post_block_style clearfix">
                                <div class="utf_post_thumb"> <a href="#"><img class="img-fluid" src="<?= base_url() ?>assets/images/news/lifestyle/travel5.jpg" alt="" /></a> </div>
                                <a class="utf_post_cat" href="#">Health</a>
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title title-medium"> <a href="#">Zhang social media pop also innocent...</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_date"> 25 Jan, 2022</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Post comment start -->
                <?php if (!empty($comments)): ?>
                    <div id="comments" class="comments-area color-primary  block">
                        <h3 class="utf_block_title">
                            <span><?= sprintf("%02d", count($comments)); ?> Comments</span>
                        </h3>
                        <ul class="comments-list">
                            <?php foreach ($comments as $comment): ?>
                                <li>
                                    <div class="comment">
                                        <div class="comment-body">
                                            <div class="meta-data">
                                                <span class="comment-author"><i class="fa fa-user me-2"></i><?= $comment['guest_name'] ?></span>
                                                <span class="comment-date pull-right"><?= formattedPostDate($comment['created_at']) ?></span>
                                            </div>
                                            <div class="comment-content">
                                                <p><?= $comment['comment'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (!empty($comment['reply'])): ?>
                                        <ul class="comments-reply">
                                            <?php foreach ($comment['reply'] as $reply): ?>
                                                <li>
                                                    <div class="comment">
                                                        <div class="comment-body">
                                                            <div class="meta-data">
                                                                <span class="comment-author"><?= esc($reply['guest_name']) ?></span>
                                                                <span class="comment-date pull-right"><?= formattedPostDate($reply['created_at']) ?></span>
                                                            </div>
                                                            <div class="comment-content">
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
                        <h3 class="title-normal">Leave a comment</h3>
                        <?= csrf_field() ?>
                        <input type="hidden" name="postid" value="<?= esc($post['id']) ?>">
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
                    <div id="success-card" style="display:none;">
                        <div class="card">
                            <div class="card-body text-center">
                                <div class="alert alert-success" id="success-alert" style="display:none;"></div>
                                <div class="alert alert-danger" id="danger-alert" style="display:none;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Comments form end -->
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="sidebar utf_sidebar_right">
                    <div class="widget text-center"> <img class="banner img-fluid" src="<?= base_url() ?>assets/images/banner-ads/ad-sidebar.png" alt="" />
                    </div>

                    <div class="widget color-primary">
                        <h3 class="utf_block_title">
                            <span>আরও পড়ুন</span>
                        </h3>
                        <div class="utf_list_post_block">
                            <ul class="utf_list_post">
                                <?php foreach ($readMorePosts as $post) : ?>
                                    <li class="clearfix">
                                        <div class="utf_post_block_style post-float clearfix">
                                            <div class="utf_post_thumb">
                                                <img class="img-fluid" src="<?= $post['thumbnail_url'] ?? base_url('assets/images/news/placeholder.png') ?>" alt="" />
                                            </div>
                                            <div class="utf_post_content">
                                                <h2 class="utf_post_title title-small">
                                                    <a href="<?= base_url('news/' . $post['slug']) ?>"><?= StringShort::truncate($post['headline'], 30) ?></a>
                                                </h2>
                                                <div class="utf_post_meta">
                                                    <span class="utf_post_author"><?= $post['author'] ?></span>
                                                    <span class="utf_post_date"><?= formattedPostDate($post['post_date_time']) ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="widget text-center"> <img class="banner img-fluid" src="<?= base_url() ?>assets/images/banner-ads/ad-sidebar.png" alt="" /> </div>

                    <div class="widget color-primary widget-tags">
                        <h3 class="utf_block_title"><span>Popular Tags</span></h3>
                        <ul class="unstyled clearfix">
                            <li><a href="#">Business</a></li>
                            <li><a href="#">Corporate</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Customer</a></li>
                            <li><a href="#">Money</a></li>
                            <li><a href="#">Health</a></li>
                            <li><a href="#">Lifestyles</a></li>
                            <li><a href="#">Traveling</a></li>
                            <li><a href="#">Partners</a></li>
                            <li><a href="#">Wordpress</a></li>
                            <li><a href="#">Customer</a></li>
                        </ul>
                    </div>

                    <div class="widget text-center">
                        <img class="banner img-fluid" src="<?= base_url() ?>assets/images/banner-ads/ad-sidebar.png" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- 1rd Block Wrapper End -->

<?= $this->endSection() ?>
<?= $this->section('jsPlugins') ?>
<script src="https://www.google.com/recaptcha/api.js?render=<?= $recapcha_key ?>"></script>
<?= $this->endSection() ?>
<?= $this->section('customjs') ?>
<script>
    $(document).on('click', '#commentSubmit', function(e) {
        e.preventDefault();

        grecaptcha.ready(function() {
            grecaptcha.execute('<?= $recapcha_key ?>', {
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
                                // fade form out
                                $('#comment').fadeOut(200, function() {
                                    // show card smoothly
                                    $('#success-card').fadeIn(200);

                                    $('#success-alert')
                                        .html(res.message)
                                        .fadeIn(200);
                                });
                            } else {
                                $('#success-card').fadeIn(200);
                                $('#danger-alert')
                                    .html(res.message)
                                    .fadeIn(200);
                            }
                        },
                        error: function(err) {
                            console.error('Comment submit ajax error', err)
                            $('#success-card').fadeIn(200);
                            $('#danger-alert')
                                .html('Something went wrong. Try again.')
                                .fadeIn(200);
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