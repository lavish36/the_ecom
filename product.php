<?php 
ob_start();
require('top.php');
if(isset($_GET['id'])){
	$product_id=mysqli_real_escape_string($con,$_GET['id']);
	if($product_id>0){
		$get_product=get_product($con,'','',$product_id);
	}else{
		?>
		<script>
		window.location.href='index.php';
		</script>
		<?php
	}
	
	$resMultipleImages=mysqli_query($con,"select product_images from product_images where product_id='$product_id'");
	$multipleImages=[];
	if(mysqli_num_rows($resMultipleImages)>0){
		while($rowMultipleImages=mysqli_fetch_assoc($resMultipleImages)){
			$multipleImages[]=$rowMultipleImages['product_images'];
		}
	}
	
	$resAttr=mysqli_query($con,"select product_attributes.*,color_master.color,size_master.size from product_attributes 
	left join color_master on product_attributes.color_id=color_master.id and color_master.status=1 
	left join size_master on product_attributes.size_id=size_master.id and size_master.status=1
	where product_attributes.product_id='$product_id'");
	$productAttr=[];
	$colorArr=[];
	$sizeArr=[];
	if(mysqli_num_rows($resAttr)>0){
		while($rowAttr=mysqli_fetch_assoc($resAttr)){
			$productAttr[]=$rowAttr;
			$colorArr[$rowAttr['color_id']][]=$rowAttr['color'];
			$sizeArr[$rowAttr['size_id']][]=$rowAttr['size'];
			
			$colorArr1[]=$rowAttr['color'];
			$sizeArr1[]=$rowAttr['size'];
		}
	}
	$is_size=count(array_filter($sizeArr1));
	$is_color=count(array_filter($colorArr1));
	//$colorArr=array_unique($colorArr);
	//$sizeArr=array_unique($sizeArr1);
}else{
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}

if(isset($_POST['review_submit'])){
	$rating=get_safe_value($con,$_POST['rating']);
	$review=get_safe_value($con,$_POST['review']);
	
	$added_on=date('Y-m-d h:i:s');
	mysqli_query($con,"insert into product_review(product_id,user_id,rating,review,status,added_on) values('$product_id','".$_SESSION['USER_ID']."','$rating','$review','1','$added_on')");
	header('location:product.php?id='.$product_id);
	die();
}


$product_review_res=mysqli_query($con,"select users.name,product_review.id,product_review.rating,product_review.review,product_review.added_on from users,product_review where product_review.status=1 and product_review.user_id=users.id and product_review.product_id='$product_id' order by product_review.added_on desc");

?>
   <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                <div class="container d-flex align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="categories.php?id=<?php echo $get_product['0']['categories_id']?>"><?php echo $get_product['0']['categories']?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $get_product['0']['name']?></li>
                    </ol>
<!-- 
                    <nav class="product-pager ml-auto" aria-label="Product">
                        <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                            <i class="icon-angle-left"></i>
                            <span>Prev</span>
                        </a>

                        <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                            <span>Next</span>
                            <i class="icon-angle-right"></i>
                        </a>
                    </nav>End .pager-nav -->
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                    <div class="product-details-top">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-gallery product-gallery-vertical">
                                    <div class="row">
                                        <figure class="product-main-image">
                                            <img id="product-zoom"data-origin="<?php echo PRODUCT_IMAGE_SITE_PATH.$get_product['0']['image']?>" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$get_product['0']['image']?>" data-zoom-image="assets/images/products/single/1-big.jpg" alt="product image">

                                            <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                                <i class="icon-arrows"></i>
                                            </a>
                                        </figure><!-- End .product-main-image -->

                                        <div id="product-zoom-gallery" class="product-image-gallery">
                                        <?php if(isset($multipleImages[0])){?>
                                            <div  class="product-gallery-item" id="multiple_images">
											<?php
											foreach($multipleImages as $list){
												echo "<img src='".PRODUCT_MULTIPLE_IMAGE_SITE_PATH.$list."' onclick=showMultipleImage('".PRODUCT_MULTIPLE_IMAGE_SITE_PATH.$list."')>";
											}
											?>
											
										</div>
                                        <?php } ?>
                                        </div><!-- End .product-image-gallery -->
                                        
                                    </div><!-- End .row -->
                                </div><!-- End .product-gallery -->
                            </div><!-- End .col-md-6 -->

                            <div class="col-md-6">
                                <div class="product-details">
                                    <h1 class="product-title"><?php echo $get_product['0']['name']?></h1><!-- End .product-title -->

                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                        <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                                    </div><!-- End .rating-container -->

                                    <div class="product-price">
                                    <?php echo $get_product['0']['mrp']?>
                                    <?php echo $get_product['0']['price']?>
                                    </div><!-- End .product-price -->

                                    <div class="product-content">
                                        <p><?php echo $get_product['0']['short_desc']?>. </p>
                                    </div><!-- End .product-content -->
                                    <div class="ht__pro__desc">
									<?php 
									$cart_show='yes';
									$is_cart_box_show="hide";
									if($is_color==0 && $is_size==0){
										$is_cart_box_show="";
									?>
                                    <div class="sin__desc">
										<?php
											$getProductAttr=getProductAttr($con,$get_product['0']['id']);
										
											$productSoldQtyByProductId=productSoldQtyByProductId($con,$get_product['0']['id'],$getProductAttr);
											
											$pending_qty=$get_product['0']['qty']-$productSoldQtyByProductId;
											
											$cart_show='yes';
											if($get_product['0']['qty']>$productSoldQtyByProductId){
												$stock='In Stock';			
											}else{
												$stock='Not in Stock';
												$cart_show='';
											}
										
										?>
                                        <p><span>Availability:</span> <?php echo $stock?></p>
                                    </div>
									<?php } ?>
                                    <?php if($is_color>0){?>
									<div class="sin__desc align--left">
										<p><span>color:</span></p>
										<ul class="pro__color">
											<?php 
											foreach($colorArr as $key=>$val){
												echo "<li style='background:".$val[0]." none repeat scroll 0 0'><a href='javascript:void(0)' onclick=loadAttr('".$key."','".$get_product['0']['id']."','color')>".$val[0]."</a></li>";
											}
											?>
											
										</ul>
									</div>
									<?php } ?>

                                    <div class="details-filter-row details-row-size">
                                    <?php if($is_size>0){?>
									<div class="sin__desc align--left">
										<p><span>size</span></p>
										<select class="select__size" id="size_attr" onchange="showQty()">
											<option value="">Size</option>
											<?php 
											foreach($sizeArr as $key=>$val){
												echo "<option value='".$key."'>".$val[0]."</option>";
											}
											?>
											
										</select>
									</div>
									<?php } ?>
                                        <!-- <a href="#" class="size-guide"><i class="icon-th-list"></i>size guide</a> -->
                                    </div><!-- End .details-filter-row -->
                                    <?php
									$isQtyHide="hide";
									if($is_color==0 && $is_size==0){
										$isQtyHide="";
									}
									?>
                                    <div class="sin__desc align--left <?php echo $isQtyHide?>" id="cart_qty">
										<?php
										if($cart_show!=''){
										?>
                                        <p><span>Qty:</span> 
										<select id="qty"  class="select__size">
											<?php
											for($i=1;$i<=$pending_qty;$i++){
												echo "<option>$i</option>";
											}
											?>
										</select>
										</p>
										<?php } ?>
                                    </div>

                                    <div id="cart_attr_msg"></div>
									
                                    <div class="sin__desc align--left">
                                        <p><span>Categories:</span></p>
                                        <ul class="pro__cat__list">
                                            <li><a href="#"><?php echo $get_product['0']['categories']?></a></li>
                                        </ul>
                                    </div>

                                    <div id="is_cart_box_show" class="<?php echo $is_cart_box_show?>">
								
									<a class="fr__btn" href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id']?>','add')">Add to cart</a>
									
									<a class="fr__btn buy_now" href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id']?>','add','yes')">Buy Now</a>
								
								    </div>
                                    <!-- <div class="details-filter-row details-row-size"> -->
                                        <!-- <label for="qty">Qty:</label> -->
                                        <!-- <div class="product-details-quantity"> -->
                                            <!-- <input type="number" id="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required> -->
                                        <!-- </div>End .product-details-quantity -->
                                    <!-- </div>End .details-filter-row -->

                                    <!-- <div class="product-details-action">
                                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>

                                        <div class="details-action-wrapper">
                                            <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                            <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to Compare</span></a>
                                        </div>
                                    </div> -->

                                    <div class="product-details-footer">
                                        <div class="product-cat">
                                            <span>Category:</span>
                                            <a href="#">Women</a>,
                                            <a href="#">Dresses</a>,
                                            <a href="#">Yellow</a>
                                        </div><!-- End .product-cat -->

                                        <div class="social-icons social-icons-sm">
                                            <span class="social-label">Share:</span>
                                            <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                            <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                            <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                            <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                        </div>
                                    </div><!-- End .product-details-footer -->
                                </div><!-- End .product-details -->
                            </div><!-- End .col-md-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .product-details-top -->
        <input type="hidden" id="cid"/>
		<input type="hidden" id="sid"/>
                    <div class="product-details-tab">
                        <ul class="nav nav-pills justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                                <div class="product-desc-content">

                                    <p> <?php echo $get_product['0']['description']?>. </p>
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                                <div class="product-desc-content">
                                    <h3>Information</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum. Aliquam porttitor mauris sit amet orci. </p>

                                    <h3>Fabric & care</h3>
                                    <ul>
                                        <li>Faux suede fabric</li>
                                        <li>Gold tone metal hoop handles.</li>
                                        <li>RI branding</li>
                                        <li>Snake print trim interior </li>
                                        <li>Adjustable cross body strap</li>
                                        <li> Height: 31cm; Width: 32cm; Depth: 12cm; Handle Drop: 61cm</li>
                                    </ul>

                                    <h3>Size</h3>
                                    <p>one size</p>
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                                <div class="product-desc-content">
                                    <h3>Delivery & returns</h3>
                                    <p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a><br>
                                    We hope you’ll love every purchase, but if you ever need to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                                <div class="reviews">
                                <?php 
									if(mysqli_num_rows($product_review_res)>0){
									
									while($product_review_row=mysqli_fetch_assoc($product_review_res)){
									?>
                                    <h3>Reviews</h3>
                                    <div class="review">
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <h4><a href="#">Samanta J.</a></h4>
                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val" style="width: 80%;"> <?php echo $product_review_row['rating']?></span> (<?php echo $product_review_row['name']?>)</div><!-- End .ratings-val -->
                                                    </div><!-- End .ratings -->
                                                </div><!-- End .rating-container -->
                                                <span class="review-date"><?php
$added_on=strtotime($product_review_row['added_on']);
echo date('d M Y',$added_on);
?></span>
                                            </div><!-- End .col -->
                                            <div class="col">
                                                <h4>Good, perfect size</h4>

                                                <div class="review-content">
                                                    <p><?php echo $product_review_row['review']?></p>
                                                </div><!-- End .review-content -->

                                                <div class="review-action">
                                                    <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                                    <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                                </div><!-- End .review-action -->
                                            </div><!-- End .col-auto -->
                                        </div><!-- End .row -->
                                    </div><!-- End .review -->
                                    <?php } }else { 
										echo "<h3 class='submit_review_hint'>No review added</h3><br/>";
									}
									?>
                                    <h3 class="review_heading">Enter your review</h3><br/>
									<?php
									if(isset($_SESSION['USER_LOGIN'])){
									?>
									<div class="row" id="post-review-box" style=>
									   <div class="col-md-12">
										  <form action="" method="post">
											 <select class="form-control" name="rating" required>
												  <option value="">Select Rating</option>
												  <option>Worst</option>
												  <option>Bad</option>
												  <option>Good</option>
												  <option>Very Good</option>
												  <option>Fantastic</option>
											 </select>	<br/>
											 <textarea class="form-control" cols="50" id="new-review" name="review" placeholder="Enter your review here..." rows="5"></textarea>
											 <div class="text-right mt10">
												<button class="btn btn-success btn-lg" type="submit" name="review_submit">Submit</button>
											 </div>
										  </form>
									   </div>
									</div>
									<?php } else {
										echo "<span class='submit_review_hint'>Please <a href='login.php'>login</a> to submit your review</span>";
									}
									?>
                                </div><!-- End .reviews -->
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .product-details-tab -->
        <?php
		//unset($_COOKIE['recently_viewed']);
		if(isset($_COOKIE['recently_viewed'])){
			$arrRecentView=unserialize($_COOKIE['recently_viewed']);
			$countRecentView=count($arrRecentView);
			$countStartRecentView=$countRecentView-4;
			if($countStartRecentView>4){
				$arrRecentView=array_slice($arrRecentView,$countStartRecentView,4);
			}
			$recentViewId=implode(",",$arrRecentView);
			$res=mysqli_query($con,"select * from product where id IN ($recentViewId) and status=1");
			
		?>
                    <h2 class="title text-center mb-4">Recently Viewed</h2><!-- End .title text-center -->

                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                        data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
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
                        <?php while($list=mysqli_fetch_assoc($res)){?>
                        <div class="product product-7 text-center">
                            <figure class="product-media">
                                <span class="product-label label-new">New</span>
                                <a>
                                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image']?>" alt="Product image" >
                                </a>

                                <div class="product-action-vertical">
                                    <a href="javascript:void(0)" onclick="wishlist_manage('<?php echo $list['id']?>','add')" class="btn-product-icon btn-wishlist btn-expandable"><span>Add to wishlist</span></a>
                                    <a href="javascript:void(0)" onclick="manage_cart('<?php echo $list['id']?>','add')" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                </div><!-- End .product-action-vertical -->

                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">Women</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.php?id=<?php echo $list['id']?>"><?php echo $list['name']?></a></h3><!-- End .product-title -->
                                <div class="product-price">
                                <?php echo $list['mrp']?>
                                <?php echo $list['price']?>
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 2 Reviews )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                        <?php } ?>
                    </div><!-- End .owl-carousel -->
                    <?php 
			$arrRec=unserialize($_COOKIE['recently_viewed']);
			if(($key=array_search($product_id,$arrRec))!==false){
				unset($arrRec[$key]);
			}
			$arrRec[]=$product_id;
		}else{
			$arrRec[]=$product_id;
		}
		setcookie('recently_viewed',serialize($arrRec),time()+60*60*24*365);
		?>
		
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->

		
			<script>
			function showMultipleImage(im){
				jQuery('#img-tab-1').html("<img src='"+im+"' data-origin='"+im+"'/>");
				jQuery('.imageZoom').imgZoom();
			}
			let is_color='<?php echo $is_color?>';
			let is_size='<?php echo $is_size?>';
			let pid='<?php echo $product_id?>';
			</script>			
<?php 
require('footer.php');
ob_flush();
?>        