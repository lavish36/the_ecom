<?php 
require('top.php');

$resBanner=mysqli_query($con,"select * from banner where status='1' order by order_no asc");

?>
        <main class="main">
        <?php if(mysqli_num_rows($resBanner)>0){?>
            <div class="intro-slider-container">
            <?php while($rowBanner=mysqli_fetch_assoc($resBanner)){?>
                <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl" data-owl-options='{
                        "dots": false,
                        "nav": false, 
                        "responsive": {
                            "992": {
                                "nav": true
                            }
                        }
                    }'>
                    <div class="intro-slide" style="background-image: url(assets/images/demos/demo-6/slider/slide-1.jpg);">
                        <div class="container intro-content text-center">
                            <h3 class="intro-subtitle text-white">You're Looking Good</h3><!-- End .h3 intro-subtitle -->
                            <h1 class="intro-title text-white">New Lookbook</h1><!-- End .intro-title -->

                            <a href="category.html" class="btn btn-outline-white-4">
                                <span>Discover More</span>
                            </a>
                        </div><!-- End .intro-content -->
                    </div><!-- End .intro-slide -->

                    <div class="intro-slide"  >
                    
                    <img src="<?php echo BANNER_SITE_PATH.$rowBanner['image']?>" >
                        <div class="container intro-content text-center">
                            
                            <h3 class="intro-subtitle text-white"><?php echo $rowBanner['heading1']?></h3><!-- End .h3 intro-subtitle -->
                            <h1 class="intro-title text-white"><?php echo $rowBanner['heading2']?></h1><!-- End .intro-title -->
                            <?php
										if($rowBanner['btn_txt'] !='' && $rowBanner['btn_link']!=''){
											?>
											<div class="cr__btn">
												<a href="<?php echo $rowBanner['btn_link']?>"><?php echo $rowBanner['btn_txt']?></a>
                                                
											</div>
											<?php
										}
										?>
                            <a href="category.html" class="btn btn-outline-white-4">
                                <span>Discover More</span>
                            </a>
                        </div><!-- End .intro-content -->
                    </div><!-- End .intro-slide -->
                </div><!-- End .intro-slider owl-carousel owl-theme -->

                <span class="slider-loader"></span><!-- End .slider-loader -->
                <?php } ?>
            </div><!-- End .intro-slider-container -->
            <?php } ?>
            <div class="pt-2 pb-3">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="banner banner-overlay">
                                <a href="#">
                                    <img src="assets/images/demos/demo-6/banners/banner-1.jpg" alt="Banner">
                                </a>

                                <div class="banner-content banner-content-center">
                                    <h4 class="banner-subtitle text-white"><a href="#">New in</a></h4><!-- End .banner-subtitle -->
                                    <h3 class="banner-title text-white"><a href="#"><strong>Women’s</strong></h3><!-- End .banner-title -->
                                    <a href="#" class="btn btn-outline-white banner-link underline">Shop Now</a>
                                </div><!-- End .banner-content -->
                            </div><!-- End .banner -->
                        </div><!-- End .col-sm-6 -->

                        <div class="col-sm-6">
                            <div class="banner banner-overlay">
                                <a href="#">
                                    <img src="assets/images/demos/demo-6/banners/banner-2.jpg" alt="Banner">
                                </a>

                                <div class="banner-content banner-content-center">
                                    <h4 class="banner-subtitle text-white"><a href="#">New in</a></h4><!-- End .banner-subtitle -->
                                    <h3 class="banner-title text-white"><a href="#"><strong>Men’s</strong></a></h3><!-- End .banner-title -->
                                    <a href="#" class="btn btn-outline-white banner-link underline">Shop Now</a>
                                </div><!-- End .banner-content -->
                            </div><!-- End .banner -->
                        </div><!-- End .col-sm-6 -->
                    </div><!-- End .row -->
                    <hr class="mt-0 mb-0">
                </div><!-- End .container -->
            </div><!-- End .bg-gray -->

            <div class="mb-5"></div><!-- End .mb-5 -->
            <div class="container">
                <div class="heading heading-center mb-3">
                    <h2 class="title">Trending</h2><!-- End .title -->
                </div><!-- End .heading -->

                <div class="tab-content tab-content-carousel">
                    <div class="tab-pane p-0 fade show active" id="trending-all-tab" role="tabpanel" aria-labelledby="trending-all-link">
                        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                            data-owl-options='{
                                "nav": false, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1200": {
                                        "items":4,
                                        "nav": true,
                                        "dots": false
                                    }
                                }
                            }'>
                            <?php
							$get_product=get_product($con,4);
							foreach($get_product as $list){
							?>
                            <div class="product product-7 text-center">
                            
                                <figure class="product-media">
                                    <a href="product.php?id=<?php echo $list['id']?>">
                                        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image']?>" alt="product images">
                                    </a>

                                    <div class="product-action-vertical">
                                        <!-- <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a> -->
                                        <a href="javascript:void(0)" class="btn-product-icon btn-wishlist btn-expandable" onclick="wishlist_manage('<?php echo $list['id']?>','add')"><span>add to wishlist</span></a>
                                       
                                    </div><!-- End .product-action-vertical -->

                                    <div class="product-action">
                                        <!-- <a href="#" class="btn-product btn-cart"><span>add to cart</span></a> -->
                                        <a href="product.php?id=<?php echo $list['id']?>" class="btn-product btn-cart" ><span>add to cart</span></a>
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">Clothing</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a href="product.php?id=<?php echo $list['id']?>"><?php echo $list['name']?></a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                    <?php echo $list['mrp']?>
                                    <?php echo $list['price']?>
                                    </div><!-- End .product-price -->
                                </div><!-- End .product-body -->
                            </div><!-- End .product -->
                          
                            <?php } ?>
                        </div><!-- End .owl-carousel -->
                    </div><!-- .End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .container -->

            <div class="mb-5"></div><!-- End .mb-5 -->

            <div class="deal bg-image pt-8 pb-8" style="background-image: url(assets/images/demos/demo-6/deal/bg-1.jpg);">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-8 col-lg-6">
                            <div class="deal-content text-center">
                                <h4>Limited quantities. </h4>
                                <h2>Deal of the Day</h2>
                                <div class="deal-countdown" data-until="+10h"></div><!-- End .deal-countdown -->
                            </div><!-- End .deal-content -->
                            <div class="row deal-products">
                                <div class="col-6 deal-product text-center">
                                    <figure class="product-media">
                                        <a href="product.html">
                                            <img src="assets/images/demos/demo-6/deal/product-1.jpg" alt="Product image" class="product-image">
                                        </a>

                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <h3 class="product-title"><a href="product.html">Elasticated cotton shorts</a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            <span class="new-price">Now $24.99</span>
                                            <span class="old-price">Was $30.99</span>
                                        </div><!-- End .product-price -->
                                    </div><!-- End .product-body -->
                                    <a href="category.html" class="action">shop now</a>
                                </div>
                                <div class="col-6 deal-product text-center">
                                    <figure class="product-media">
                                        <a href="product.html">
                                            <img src="assets/images/demos/demo-6/deal/product-2.jpg" alt="Product image" class="product-image">
                                        </a>

                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <h3 class="product-title"><a href="product.html">Fine-knit jumper</a></h3><!-- End .product-title -->
                                        <div class="product-price">
                                            <span class="new-price">Now $8.99</span>
                                            <span class="old-price">Was $17.99</span>
                                        </div><!-- End .product-price -->
                                    </div><!-- End .product-body -->
                                    <a href="category.html" class="action">shop now</a>
                                </div>
                            </div>
                        </div><!-- End .col-lg-5 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .deal -->

            <div class="pt-4 pb-3" style="background-color: #222;">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-sm-6">
                            <div class="icon-box text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-truck"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Payment & Delivery</h3><!-- End .icon-box-title -->
                                    <p>Free shipping for orders over $50</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-lg-3 col-sm-6 -->

                        <div class="col-lg-3 col-sm-6">
                            <div class="icon-box text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-rotate-left"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Return & Refund</h3><!-- End .icon-box-title -->
                                    <p>Free 100% money back guarantee</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-lg-3 col-sm-6 -->

                        <div class="col-lg-3 col-sm-6">
                            <div class="icon-box text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-unlock"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Secure Payment</h3><!-- End .icon-box-title -->
                                    <p>100% secure payment</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-lg-3 col-sm-6 -->

                        <div class="col-lg-3 col-sm-6">
                            <div class="icon-box text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-headphones"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Quality Support</h3><!-- End .icon-box-title -->
                                    <p>Alway online feedback 24/7</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-lg-3 col-sm-6 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .bg-light pt-2 pb-2 -->

            <div class="mb-6"></div><!-- End .mb-5 -->

            <div class="container">
                <h2 class="title text-center mb-4">New Arrivals</h2><!-- End .title text-center -->
                        <?php
							$get_product=get_product($con,4,'','','','','yes');
							foreach($get_product as $list){
						?>
                <div class="products">
                    <div class="row justify-content-center">
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="product product-7 text-center">
                                <figure class="product-media">
                                    <span class="product-label label-sale">Sale</span>
                                    <a href="product.php?id=<?php echo $list['id']?>">
                                        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image']?>" alt="product images">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="javascript:void(0)" class="btn-product-icon btn-wishlist btn-expandable" onclick="wishlist_manage('<?php echo $list['id']?>','add')"><span>add to wishlist</span></a>
                                    </div><!-- End .product-action-vertical -->

                                    <div class="product-action">
                                        <a href="product.php?id=<?php echo $list['id']?>" class="btn-product btn-cart" ><span>add to cart</span></a>
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">Clothing</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a href="product.php?id=<?php echo $list['id']?>"><?php echo $list['name']?></a></h3><!-- End .product-title -->
                                    <div class="product-price">
                                        <span class="new-price"><?php echo $list['price']?></span>
                                        <span class="old-price"><?php echo $list['mrp']?></span>
                                    </div><!-- End .product-price -->
                                </div><!-- End .product-body -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->  
                    </div><!-- End .row -->
                </div><!-- End .products -->
                <?php } ?>
                <!-- <div class="more-container text-center mt-2">
                    <a href="#" class="btn btn-outline-dark-2 btn-more"><span>show more</span></a>
                </div> -->
            </div><!-- End .container -->

            <div class="pb-3">
                <div class="container brands pt-5 pt-lg-7 ">

                    <h2 class="title text-center mb-4">shop by brands</h2><!-- End .title text-center -->

                    <div class="owl-carousel owl-simple" data-toggle="owl" 
                        data-owl-options='{
                            "nav": false, 
                            "dots": false,
                            "margin": 30,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":2
                                },
                                "420": {
                                    "items":3
                                },
                                "600": {
                                    "items":4
                                },
                                "900": {
                                    "items":5
                                },
                                "1024": {
                                    "items":6
                                }
                            }
                        }'>
                        <a href="#" class="brand">
                            <img src="assets/images/brands/1.png" alt="Brand Name">
                        </a>

                        <a href="#" class="brand">
                            <img src="assets/images/brands/2.png" alt="Brand Name">
                        </a>

                        <a href="#" class="brand">
                            <img src="assets/images/brands/3.png" alt="Brand Name">
                        </a>

                        <a href="#" class="brand">
                            <img src="assets/images/brands/4.png" alt="Brand Name">
                        </a>

                        <a href="#" class="brand">
                            <img src="assets/images/brands/5.png" alt="Brand Name">
                        </a>

                        <a href="#" class="brand">
                            <img src="assets/images/brands/6.png" alt="Brand Name">
                        </a>

                        <a href="#" class="brand">
                            <img src="assets/images/brands/7.png" alt="Brand Name">
                        </a>
                    </div><!-- End .owl-carousel -->
                </div><!-- End .container -->

                <div class="mb-5 mb-lg-7"></div><!-- End .mb-5 -->

                <div class="container newsletter">
                    <div class="row">
                        <div class="col-lg-6 banner-overlay-div">
                            <div class="banner banner-overlay">
                                <a href="#">
                                    <img src="assets/images/demos/demo-6/banners/banner-3.jpg" alt="Banner">
                                </a>

                                <div class="banner-content banner-content-center">
                                    <h4 class="banner-subtitle text-white"><a href="#">Limited time only.</a></h4><!-- End .banner-subtitle -->
                                    <h3 class="banner-title text-white"><a href="#">End of Season<br>save 50% off</a></h3><!-- End .banner-title -->
                                    <a href="#" class="btn btn-outline-white banner-link underline">Shop Now</a>
                                </div><!-- End .banner-content -->
                            </div><!-- End .banner -->
                        </div><!-- End .col-lg-6 -->

                        <div class="col-lg-6 d-flex align-items-stretch subscribe-div">
                            <div class="cta cta-box">
                                <div class="cta-content">
                                    <h3 class="cta-title">Subscribe To Our Newsletter</h3><!-- End .cta-title -->
                                    <p>Sign up now for <span class="primary-color">10% discount</span> on first order. Customise my news:</p>

                                    <form action="#">
                                        <input type="email" class="form-control" placeholder="Enter your Email Address" aria-label="Email Adress" required>
                                        <div class="text-center">
                                            <button class="btn btn-outline-dark-2" type="submit"><span>subscribe</span></i></button>
                                        </div><!-- End .text-center -->
                                    </form>
                                </div><!-- End .cta-content -->
                            </div><!-- End .cta -->
                        </div><!-- End .col-lg-6 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .bg-gray -->

            <div class="mb-2"></div><!-- End .mb-5 -->
            
            <div class="container">
            </div><!-- End .container -->
            
            <div class="blog-posts mb-5">
                <div class="container">
                    <h2 class="title text-center mb-4">From Our Blog</h2><!-- End .title text-center -->

                    <div class="owl-carousel owl-simple mb-3" data-toggle="owl" 
                        data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "items": 3,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "600": {
                                    "items":2
                                },
                                "992": {
                                    "items":3
                                }
                            }
                        }'>
                        <article class="entry">
                            <figure class="entry-media">
                                <a href="single.html">
                                    <img src="assets/images/demos/demo-6/blog/post-1.jpg" alt="image desc">
                                </a>
                            </figure><!-- End .entry-media -->

                            <div class="entry-body text-center">
                                <div class="entry-meta">
                                    <a href="#">Nov 22, 2018</a>, 1 Comments
                                </div><!-- End .entry-meta -->

                                <h3 class="entry-title">
                                    <a href="single.html">Sed adipiscing ornare.</a>
                                </h3><!-- End .entry-title -->

                                <div class="entry-content">
                                    <a href="single.html" class="read-more">Read More</a>
                                </div><!-- End .entry-content -->
                            </div><!-- End .entry-body -->
                        </article><!-- End .entry -->

                        <article class="entry">
                            <figure class="entry-media">
                                <a href="single.html">
                                    <img src="assets/images/demos/demo-6/blog/post-2.jpg" alt="image desc">
                                </a>
                            </figure><!-- End .entry-media -->

                            <div class="entry-body text-center">
                                <div class="entry-meta">
                                    <a href="#">Dec 12, 2018</a>, 0 Comments
                                </div><!-- End .entry-meta -->

                                <h3 class="entry-title">
                                    <a href="single.html">Fusce lacinia arcuet nulla.</a>
                                </h3><!-- End .entry-title -->

                                <div class="entry-content">
                                    <a href="single.html" class="read-more">Read More</a>
                                </div><!-- End .entry-content -->
                            </div><!-- End .entry-body -->
                        </article><!-- End .entry -->

                        <article class="entry">
                            <figure class="entry-media">
                                <a href="single.html">
                                    <img src="assets/images/demos/demo-6/blog/post-3.jpg" alt="image desc">
                                </a>
                            </figure><!-- End .entry-media -->

                            <div class="entry-body text-center">
                                <div class="entry-meta">
                                    <a href="#">Dec 19, 2018</a>, 2 Comments
                                </div><!-- End .entry-meta -->

                                <h3 class="entry-title">
                                    <a href="single.html">Quisque volutpat mattis eros.</a>
                                </h3><!-- End .entry-title -->

                                <div class="entry-content">
                                    <a href="single.html" class="read-more">Read More</a>
                                </div><!-- End .entry-content -->
                            </div><!-- End .entry-body -->
                        </article><!-- End .entry -->
                    </div><!-- End .owl-carousel -->
                </div><!-- End .container -->
            </div><!-- End .blog-posts -->
        </main><!-- End .main -->
        <input type="hidden" id="qty" value="1"/>
<?php
include('footer.php');
?>