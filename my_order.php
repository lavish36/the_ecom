<?php 
require('top.php');
if(!isset($_SESSION['USER_LOGIN'])){
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}
?>
 <main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">MY ORDER<span>Personal</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="profile.php">Profile</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Orders</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="cart">
	                <div class="container">
	                	<div class="row">
	                		<div class="col-lg-12 col-md-3">
	                			<table class="table table-cart table-mobile">
									<thead>
										<tr>
											<th>Order ID</th>
											<th>Order Date</th>
											<th>Address</th>
											<th>Payment Type</th>
											<th>Payment Status</th>
											<th>Order Status</th>
                                            <th></th>
										</tr>
									</thead>

									<tbody>
											<?php
											$uid=$_SESSION['USER_ID'];
											$res=mysqli_query($con,"select `order`.*,order_status.name as order_status_str from `order`,order_status where `order`.user_id='$uid' and order_status.id=`order`.order_status order by `order`.id desc");
											while($row=mysqli_fetch_assoc($res)){
											?>
										<tr>
											<td class="product-col">
												<div class="product">
													<h3 class="product-title">
													<a href="my_order_details.php?id=<?php echo $row['id']?>"> <?php echo $row['id']?></a>
													</h3><!-- End .product-title -->
												</div><!-- End .product -->
											</td>
											<td ><?php echo $row['added_on']?></td>
											<td class="product">
												<?php echo $row['address']?><br/>
												<?php echo $row['city']?><br/>
												<?php echo $row['pincode']?>
											</td>
											<td class="product-name"><?php echo $row['payment_type']?></td>
												<td class="product-name"><?php echo ucfirst($row['payment_status'])?></td>
												<td class="product-name"><?php echo $row['order_status_str']?></td>

										
											<td><a href="order_pdf.php?id=<?php echo $row['id']?>"> PDF</a></td>
										</tr>
										<?php } ?>
									</tbody>
								</table><!-- End .table table-wishlist -->
	                		</div><!-- End .col-lg-9 -->
	                	</div><!-- End .row -->
	                </div><!-- End .container -->
                </div><!-- End .cart -->
            </div><!-- End .page-content -->

</main><!-- End .main -->
<input type="hidden" id="sid">
<input type="hidden" id="cid">				
<?php require('footer.php')?>        