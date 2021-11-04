<?php 
require('top.php');
if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']=='yes'){
	?>
	<script>
	window.location.href='my_order.php';
	</script>
	<?php
}
?>

        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Login</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('assets/images/backgrounds/login-bg.jpg')">
            	<div class="container">
            		<div class="form-box">
            			<div class="form-tab">
	            			<ul class="nav nav-pills nav-fill" role="tablist">
							    <li class="nav-item">
							        <a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Sign In</a>
							 
							</ul>
							
							    <div class="tab-pane fade show active" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
								
								<form id="login-form" method="post">
							    		<div class="form-group">
							    			<label for="singin-email-2">Username or email address *</label>
											
											
											<input type="email"class="form-control" name="login_email" id="login_email" placeholder="Your Email*" required>
							    		</div><!-- End .form-group -->

							    		<div class="form-group">
							    			<label for="singin-password-2">Password *</label>
							    			<input type="password" class="form-control" name="login_password" id="login_password" placeholder="Your Password*" required>
											
							    		</div><!-- End .form-group -->

							    		<div class="form-footer">
										<button  class="" onclick="user_login()">Login</button>
										<a href="forgot_password.php" class="forgot_password">Forgot Password</a>
										<br>
										

			            						<i class="icon-long-arrow-right"></i>
			                				</button>

			                				<div class="custom-control custom-checkbox">
											</div><!-- End .custom-checkbox -->

							    		</div><!-- End .form-footer -->
							    	</form>
									<div class="form-output login_msg">
									<p class="form-messege field_error"></p>
									
									<a href="register.php" class="forgot_password">Register</a>
								</div>
							   	
            		</div><!-- End .form-box -->
            	</div><!-- End .container -->
            </div><!-- End .login-page section-bg -->
        </main><!-- End .main -->
<?php
require('footer.php');
?>