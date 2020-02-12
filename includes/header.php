<?php
session_start();
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CC</title>

    <!-- Bootstrap core CSS -->
  	<link rel="stylesheet" href="assets/fontawesome-free/css/all.min.css">
  	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<div class="wrapper d-flex align-items-stretch">
		<nav id="sidebar">
			<div class="custom-menu">
				<button type="button" id="sidebarCollapse" class="btn btn-primary">
	           		<i class="fa fa-bars"></i>
	          		<span class="sr-only">Toggle Menu</span>
	        	</button>
        	</div>
			<div class="p-4">
				<?php
				if (isset($_SESSION['reg_no'])) {
				?>
				<div class="profile_pic">
					<img src="">
				</div>


				<?php
				}else {
					echo '
						<h1><a href="home.php" class="logo">CC <span>Chuka Connect</span></a></h1>
					';
				}

				?>
		        <ul class="list-unstyled components mb-5">
		          	<li class="active">
		            	<a href="home.php"><span class="fa fa-home mr-3"></span> Home</a>
		          	</li>
		          	<?php
		          	if (isset( $_SESSION['reg_no']) ) {
		          	?>
		          	<span><?php echo $_SESSION['reg_no'];?></span>

		          	<li>
		               <a href="profile.php"><span class="fa fa-user mr-3"></span> Profile</a>
		          	</li>
			        <li>
		               <a href="#"><span class="fa fa-briefcase mr-3"></span> Campus Connect</a>
			        </li>
		          	<li>
	                    <a href="#"><span class="fa fa-sticky-note mr-3"></span> Course Connect</a>
		          	</li>
		          	<li>
	              		<a href="#"><span class="fa fa-suitcase mr-3"></span> County Connect</a>
		          	</li>


		          	<?php
		          	} else {
		          	?>

		          	<li>
	              		<a href="index.php"><span class="fa fa-signin mr-3"></span> Login</a>
		          	</li>
		          	<li>
	              		<a href="create_account.php"><span class="fa fa-signup mr-3"></span> Create Account</a>
		          	</li>

		          	<?php
		          	}

		          	?>

		          	<li>
	              		<a href="#"><span class="fa fa-cogs mr-3"></span> About</a>
		          	</li>
		          	<li>
	              		<a href="#"><span class="fa fa-paper-plane mr-3"></span> Contacts</a>
		          	</li>
		          	<?php if( isset( $_SESSION['reg_no']) ) 
		          			echo "<li><a href='includes/logout.php'><span class='fa fa-logout mr-3'></span> Logout</a></li>"; 
		          	?>
		        </ul>

	        	<div class="mb-5">
					<h3 class="h6 mb-3">Subscribe for newsletter</h3>
					<form action="#" class="subscribe-form">
			            <div class="form-group d-flex">
			            	<div class="icon"><span class="icon-paper-plane"></span></div>
			              <input type="text" class="form-control" placeholder="Enter Email Address">
			            </div>
	          		</form>
				</div>

		        <div class="footer">
		        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib.com</a>
							  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
		        </div>
	      	</div>
    	</nav>