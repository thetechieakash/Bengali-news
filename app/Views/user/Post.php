<?= $this->extend('layouts/ViewLayout.php') ?>
<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('cssPlugins') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<!-- Page Title Start -->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li>Lifestyle</li>
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
                    <div class="utf_post_title-area"> <a class="utf_post_cat" href="#">Health</a>
                        <h2 class="utf_post_title">Lorem Ipsum is simply dummy text of the printing and type setting industry simply dummy text type.</h2>
                        <div class="utf_post_meta">
                            <span class="utf_post_author"> By John Wick </span>
                            <span class="utf_post_date"> 15 Jan, 2022</span>
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
                            <a href="<?= base_url() ?>assets/images/news/lifestyle/health5.jpg" class="glightbox">
                                <img src="<?= base_url() ?>assets/images/news/lifestyle/health5.jpg" class="img-fluid" alt=""></a>
                        </div>
                        <div class="entry-content">
                            <p>Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy text ever since when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            <p>Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy text ever since when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            <blockquote>Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy text ever since when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic.</blockquote>
                            <p>Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy text ever since when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            <ul class="list-round mr_bottom-20">
                                <li>Lorem Ipsum is simply dummy text of the printing.</li>
                                <li>Lorem Ipsum is simply dummy text of the printing.</li>
                                <li>Lorem Ipsum is simply dummy text of the printing.</li>
                                <li>Lorem Ipsum is simply dummy text of the printing.</li>
                            </ul>
                            <p>Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry's standard dummy text ever since when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        </div>

                        <div class="tags-area clearfix">
                            <div class="post-tags">
                                <span>Tags:</span>
                                <a href="#"># Business</a>
                                <a href="#"># Corporate</a>
                                <a href="#"># Services</a>
                                <a href="#"># Customer</a>
                            </div>
                        </div>

                        <div class="share-items clearfix">
                            <ul class="post-social-icons unstyled">
                                <li class="facebook"> <a href="#"> <i class="fa fa-facebook"></i> <span class="ts-social-title">Facebook</span></a> </li>
                                <li class="twitter"> <a href="#"> <i class="fa fa-twitter"></i> <span class="ts-social-title">Twitter</span></a> </li>
                                <li class="gplus"> <a href="#"> <i class="fa fa-google-plus"></i> <span class="ts-social-title">Google +</span></a> </li>
                                <li class="pinterest"> <a href="#"> <i class="fa fa-pinterest"></i> <span class="ts-social-title">Pinterest</span></a> </li>
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
                <div id="comments" class="comments-area color-primary  block">
                    <h3 class="utf_block_title">
                        <span>03 Comments</span>
                    </h3>
                    <ul class="comments-list">
                        <li>
                            <div class="comment">
                                <div class="comment-body">
                                    <div class="meta-data">
                                        <span class="comment-author">Miss Lisa Doe</span>
                                        <span class="comment-date pull-right">15 Jan, 2022</span>
                                    </div>
                                    <div class="comment-content">
                                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt iure amet non.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="comment">
                                <div class="comment-body">
                                    <div class="meta-data">
                                        <span class="comment-author">Miss Lisa Doe</span>
                                        <span class="comment-date pull-right">15 Jan, 2022</span>
                                    </div>
                                    <div class="comment-content">
                                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sunt iure amet non.</p>
                                    </div>
                                </div>
                            </div>

                        </li>
                    </ul>
                </div>
                <!-- Post comment end -->

                <?php if (auth()->loggedIn()): ?>
                    <!-- Comments Form Start -->
                    <div class="comments-form">
                        <h3 class="title-normal">Leave a comment</h3>
                        <form>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control required-field" id="message" placeholder="Comment" rows="10" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                                <button class="comments-btn btn btn-primary" type="submit">Post Comment</button>
                            </div>
                        </form>
                    </div>
                    <!-- Comments form end -->
                <?php endif; ?>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="sidebar utf_sidebar_right">
                    <div class="widget color-primary">
                        <h3 class="utf_block_title"><span>Follow Us</span></h3>
                        <ul class="social-icon">
                            <li><a href="#" target="_blank"><i class="fa fa-rss"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>

                    <div class="widget color-primary">
                        <h3 class="utf_block_title">
                            <span>আরও পড়ুন</span>
                        </h3>
                        <div class="utf_list_post_block">
                            <ul class="utf_list_post">
                                <li class="clearfix">
                                    <div class="utf_post_block_style post-float clearfix">
                                        <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/gadget3.jpg" alt="" /> </a> <a class="utf_post_cat" href="#">Gadgets</a> </div>
                                        <div class="utf_post_content">
                                            <h2 class="utf_post_title title-small"> <a href="#">Zhang social media pop also known when smart innocent...</a> </h2>
                                            <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date"> 25 Jan, 2022</span> </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="clearfix">
                                    <div class="utf_post_block_style post-float clearfix">
                                        <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/lifestyle/travel5.jpg" alt="" /> </a> <a class="utf_post_cat" href="#">Travel</a> </div>
                                        <div class="utf_post_content">
                                            <h2 class="utf_post_title title-small"> <a href="#">Zhang social media pop also known when smart innocent...</a> </h2>
                                            <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date"> 25 Jan, 2022</span> </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="clearfix">
                                    <div class="utf_post_block_style post-float clearfix">
                                        <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/robot5.jpg" alt="" /> </a> <a class="utf_post_cat" href="#">Traveling</a> </div>
                                        <div class="utf_post_content">
                                            <h2 class="utf_post_title title-small"> <a href="#">Zhang social media pop also known when smart innocent...</a> </h2>
                                            <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date"> 25 Jan, 2022</span> </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="clearfix">
                                    <div class="utf_post_block_style post-float clearfix">
                                        <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/lifestyle/food1.jpg" alt="" /> </a> <a class="utf_post_cat" href="#">Food</a> </div>
                                        <div class="utf_post_content">
                                            <h2 class="utf_post_title title-small"> <a href="#">Zhang social media pop also known when smart innocent...</a> </h2>
                                            <div class="utf_post_meta"> <span class="utf_post_author"> John Wick</span> <span class="utf_post_date"> 25 Jan, 2022</span> </div>
                                        </div>
                                    </div>
                                </li>
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

                    <div class="widget color-primary m-bottom-0">
                        <h3 class="utf_block_title"><span>Newsletter</span></h3>
                        <div class="utf_newsletter_block">
                            <div class="utf_newsletter_introtext">
                                <h4>Subscribe Newsletter!</h4>
                                <p>Lorem ipsum dolor sit consectetur adipiscing elit Maecenas in pulvinar neque Nulla finibus lobortis pulvinar.</p>
                            </div>
                            <div class="utf_newsletter_form">
                                <form action="#" method="post">
                                    <div class="form-group">
                                        <input type="email" name="email" id="utf_newsletter_form-email" class="form-control form-control-lg" placeholder="E-Mail Address" autocomplete="off">
                                        <button class="btn btn-primary">Subscribe</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- 1rd Block Wrapper End -->

<?= $this->endSection() ?>
<?= $this->section('jsPlugins') ?>

<?= $this->endSection() ?>
<?= $this->section('customjs') ?>

<?= $this->endSection() ?>