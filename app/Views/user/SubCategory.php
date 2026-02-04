<?= $this->extend('layouts/ViewLayout.php') ?>
<?= $this->section('pageTitle') ?>
<?= esc($pageTitle); ?>
<?= $this->endSection() ?>
<?= $this->section('cssPlugins') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<!-- Page Breadcrumb Start -->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li><a href="<?= base_url("category/{$category['slug']}") ?>"><?= esc($category['cat']) ?></a></li>
                    <li><?= esc($subCategory['sub_cat_name']) ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page Breadcrumb end -->

<section class="utf_block_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="block category-listing category-style2 color-primary">
                    <h3 class="utf_block_title"><span><?= esc($category['cat']) ?></span></h3>

                    <div class="utf_post_block_style post-list clearfix">
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="utf_post_thumb thumb-float-style"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/robot5.jpg" alt="" /> </a> <a class="utf_post_cat" href="#">Traveling</a> </div>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title title-large"> <a href="#">Robots in hospitals can be quite handy to navigate around the hospital</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"><i class="fa fa-user"></i> <a href="#">John Wick</a></span> <span class="utf_post_date"><i class="fa fa-clock-o"></i> 25 Jan, 2022</span> <span class="post-comment pull-right"><i class="fa fa-comments-o"></i> <a href="#" class="comments-link"><span>03</span></a></span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing type setting industry. Lorem Ipsum has been the industry's standard dummy text ever galley of type...</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="utf_post_block_style post-list clearfix">
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="utf_post_thumb thumb-float-style"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/game2.jpg" alt="" /> </a> <a class="utf_post_cat" href="#">Games</a> </div>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title title-large"> <a href="#">Lindie game plonks players in front of huge starship command center</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"><i class="fa fa-user"></i> <a href="#">John Wick</a></span> <span class="utf_post_date"><i class="fa fa-clock-o"></i> 25 Jan, 2022</span> <span class="post-comment pull-right"><i class="fa fa-comments-o"></i> <a href="#" class="comments-link"><span>03</span></a></span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing type setting industry. Lorem Ipsum has been the industry's standard dummy text ever galley of type...</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="utf_post_block_style post-list clearfix">
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="utf_post_thumb thumb-float-style"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/robot3.jpg" alt="" /> </a> <a class="utf_post_cat" href="#">Traveling</a> </div>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title title-large"> <a href="#">Zhang social media pop also known when smart innocent...</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"><i class="fa fa-user"></i> <a href="#">John Wick</a></span> <span class="utf_post_date"><i class="fa fa-clock-o"></i> 25 Jan, 2022</span> <span class="post-comment pull-right"><i class="fa fa-comments-o"></i> <a href="#" class="comments-link"><span>03</span></a></span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing type setting industry. Lorem Ipsum has been the industry's standard dummy text ever galley of type...</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="utf_post_block_style post-list clearfix">
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="utf_post_thumb thumb-float-style"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/gadget2.jpg" alt="" /> </a> <a class="utf_post_cat" href="#">Lifestyle</a> </div>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title title-large"> <a href="#">Samsung Gear S3 review: A whimper, when smartwatches need a bang</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"><i class="fa fa-user"></i> <a href="#">John Wick</a></span> <span class="utf_post_date"><i class="fa fa-clock-o"></i> 25 Jan, 2022</span> <span class="post-comment pull-right"><i class="fa fa-comments-o"></i> <a href="#" class="comments-link"><span>03</span></a></span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing type setting industry. Lorem Ipsum has been the industry's standard dummy text ever galley of type...</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="utf_post_block_style post-list clearfix">
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                <div class="utf_post_thumb thumb-float-style"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/game1.jpg" alt="" /> </a> <a class="utf_post_cat" href="#">Games</a> </div>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <div class="utf_post_content">
                                    <h2 class="utf_post_title title-large"> <a href="#">Historical heroes and robot dinosaurs: New games on our radar in April</a> </h2>
                                    <div class="utf_post_meta"> <span class="utf_post_author"><i class="fa fa-user"></i> <a href="#">John Wick</a></span> <span class="utf_post_date"><i class="fa fa-clock-o"></i> 25 Jan, 2022</span> <span class="post-comment pull-right"><i class="fa fa-comments-o"></i> <a href="#" class="comments-link"><span>03</span></a></span> </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing type setting industry. Lorem Ipsum has been the industry's standard dummy text ever galley of type...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="paging">
                    <ul class="pagination">
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="sidebar utf_sidebar_right">
                    <div class="widget text-center"> <img class="banner img-fluid" src="<?= base_url() ?>assets/images/banner-ads/ad-sidebar.png" alt="" /> </div>


                    <div class="widget color-primary">
                        <h3 class="utf_block_title"><span>Popular News</span></h3>
                        <div class="utf_list_post_block">
                            <ul class="utf_list_post">
                                <li class="clearfix">
                                    <div class="utf_post_block_style post-float clearfix">
                                        <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/gadget3.jpg" alt="" /> </a> <a class="utf_post_cat" href="#">Lifestyle</a> </div>
                                        <div class="utf_post_content">
                                            <h2 class="utf_post_title title-small"> <a href="#">Zhang social media pop also known when smart innocent...</a> </h2>
                                            <div class="utf_post_meta"> <span class="utf_post_author"><i class="fa fa-user"></i> <a href="#">John Wick</a></span> <span class="utf_post_date"><i class="fa fa-clock-o"></i> 25 Jan, 2022</span> </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="clearfix">
                                    <div class="utf_post_block_style post-float clearfix">
                                        <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/lifestyle/travel5.jpg" alt="" /> </a> <a class="utf_post_cat" href="#">Travel</a> </div>
                                        <div class="utf_post_content">
                                            <h2 class="utf_post_title title-small"> <a href="#">Zhang social media pop also known when smart innocent...</a> </h2>
                                            <div class="utf_post_meta"> <span class="utf_post_author"><i class="fa fa-user"></i> <a href="#">John Wick</a></span> <span class="utf_post_date"><i class="fa fa-clock-o"></i> 25 Jan, 2022</span> </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="clearfix">
                                    <div class="utf_post_block_style post-float clearfix">
                                        <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/tech/robot5.jpg" alt="" /> </a> <a class="utf_post_cat" href="#">Traveling</a> </div>
                                        <div class="utf_post_content">
                                            <h2 class="utf_post_title title-small"> <a href="#">Zhang social media pop also known when smart innocent...</a> </h2>
                                            <div class="utf_post_meta"> <span class="utf_post_author"><i class="fa fa-user"></i> <a href="#">John Wick</a></span> <span class="utf_post_date"><i class="fa fa-clock-o"></i> 25 Jan, 2022</span> </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="clearfix">
                                    <div class="utf_post_block_style post-float clearfix">
                                        <div class="utf_post_thumb"> <a href="#"> <img class="img-fluid" src="<?= base_url() ?>assets/images/news/lifestyle/food1.jpg" alt="" /> </a> <a class="utf_post_cat" href="#">Food</a> </div>
                                        <div class="utf_post_content">
                                            <h2 class="utf_post_title title-small"> <a href="#">Zhang social media pop also known when smart innocent...</a> </h2>
                                            <div class="utf_post_meta"> <span class="utf_post_author"><i class="fa fa-user"></i> <a href="#">John Wick</a></span> <span class="utf_post_date"><i class="fa fa-clock-o"></i> 25 Jan, 2022</span> </div>
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

<?= $this->endSection() ?>
<?= $this->section('jsPlugins') ?>

<?= $this->endSection() ?>
<?= $this->section('customjs') ?>

<?= $this->endSection() ?>