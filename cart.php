<?php 
require('top.php');
?>

        <main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">Shopping Cart<span>Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="cart">
	                <div class="container">
	                	<div class="row">
	                		<div class="col-lg-9">
	                			<table class="table table-cart table-mobile">
									<thead>
										<tr>
											<th>Product</th>
											<th>Price</th>
											<th>Quantity</th>
											<th>Total</th>
											<th></th>
										</tr>
									</thead>

									<tbody>
                                    <?php
										if(isset($_SESSION['cart'])){
											foreach($_SESSION['cart'] as $key=>$val){
												
											foreach($val as $key1=>$val1)	{


$resAttr=mysqli_fetch_assoc(mysqli_query($con,"select product_attributes.*,color_master.color,size_master.size from product_attributes 
	left join color_master on product_attributes.color_id=color_master.id and color_master.status=1 
	left join size_master on product_attributes.size_id=size_master.id and size_master.status=1
	where product_attributes.id='$key1'"));

												
											$productArr=get_product($con,'','',$key,'','','','',$key1);
											$pname=$productArr[0]['name'];
											$mrp=$productArr[0]['mrp'];
											$price=$productArr[0]['price'];
											$image=$productArr[0]['image'];
											$qty=$val1['qty'];
											?>
											<tr>
                                            <td class="product-col">
												<div class="product">
													<figure class="product-media">
														<a href="#">
															<img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image?>" alt="Product image">
														</a>
													</figure>

													<h3 class="product-title">
														<a href="#"><?php echo $pname?></a>
														<?php
if(isset($resAttr['color']) && $resAttr['color']!=''){
	echo "<br/>color-".$resAttr['color'].''; 
}
if(isset($resAttr['size']) && $resAttr['size']!=''){
	echo "<br/> size-".$resAttr['size'].''; 
}
?>
                                                    <ul  class="pro__prize">
														<li class="old__prize"><?php echo $mrp?></li>
														<li class="price-col"><?php echo $price?></li>
													</ul>
													</h3><!-- End .product-title -->
												</div><!-- End .product -->
											</td>				
												<td class="price-col"><span class="amount"><?php echo $price?></span></td>
												<td class="quantity-col"><input type="number" id="<?php echo $key?>qty" value="<?php echo $qty?>" min="1" max="10" step="1" data-decimals="0" />
												<br/><a href="javascript:void(0)" onclick="manage_cart_update('<?php echo $key?>','update','<?php echo $resAttr['size_id']?>','<?php echo $resAttr['color_id']?>')">update</a>
												</td>
												<td class="total-col"><?php echo $qty*$price?></td>
												
												<td class="remove-col"><a href="javascript:void(0)" onclick="manage_cart_update('<?php echo $key?>','remove','<?php echo $resAttr['size_id']?>','<?php echo $resAttr['color_id']?>')"><i class="icon-close"></i></a></td>
											</tr>
										<?php } } } ?>
									</tbody>
								</table><!-- End .table table-wishlist -->

	                			<div class="cart-bottom">
			            			<div class="cart-discount">
			            				<form action="#">
			            					<div class="input-group">
				        						<input type="text" class="form-control" required placeholder="coupon code">
				        						<div class="input-group-append">
													<button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
												</div><!-- .End .input-group-append -->
			        						</div><!-- End .input-group -->
			            				</form>
			            			</div><!-- End .cart-discount -->

			            			<a href="cart.php" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i class="icon-refresh"></i></a>
		            			</div><!-- End .cart-bottom -->
	                		</div><!-- End .col-lg-9 -->
	                		<aside class="col-lg-3">
	                			<div class="summary summary-cart">
	                				<!-- <h3 class="summary-title">Cart Total</h3> -->

	                				<!-- <table class="table table-summary">
	                					<tbody>
	                						<tr class="summary-subtotal">
	                							<td>Subtotal:</td>
	                							<td>&#x20B9; <?php echo $qty*$price?></td>
	                						</tr>
	                						<tr class="summary-shipping">
	                							<td>Shipping:</td>
	                							<td>&nbsp;</td>
	                						</tr>

	                						<tr class="summary-shipping-row">
	                							<td>
													<div class="custom-control custom-radio">
														<input type="radio" checked="checked" id="free-shipping" name="shipping" class="custom-control-input">
														<label class="custom-control-label" for="free-shipping">Free Shipping</label>
													</div>
	                							</td>
	                							<td>Free</td>
	                						</tr>
	                						<tr class="summary-total">
	                							<td>Total:</td>
	                							<td>&#x20B9;  <?php echo $qty*$price?></td>
	                						</tr>
	                					</tbody>
	                				</table> -->

	                				<a href="checkout.php" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
	                			</div><!-- End .summary -->

		            			<a href="category.php" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
	                		</aside><!-- End .col-lg-3 -->
	                	</div><!-- End .row -->
	                </div><!-- End .container -->
                </div><!-- End .cart -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
        <input type="hidden" id="sid">
		<input type="hidden" id="cid">
		
										
<?php require('footer.php')?>   