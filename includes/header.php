<?php
ob_start();
session_start();
require_once 'functions.php';

if (isset($_SESSION['reg_no'])) {
	$reg_no = $_SESSION['reg_no'];
	$loggedin = TRUE;
}else{
	$loggedin = FALSE;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CC</title>
    <link rel="icon" href="img/logo/cc_2_removebg_preview_5Lg_icon.ico" type="image/favicon">

    <!-- Bootstrap core CSS -->
  	<link rel="stylesheet" href="assets/fontawesome-free/css/all.min.css">
  	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  	<link rel="stylesheet" href="assets/css/mystyle.css">
  	<link href="assets/fonts/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  	<!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/> -->


  	<script src="assets/jquery/jquery.min.js"></script>
  	
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
				if ($loggedin) {
					//confirming if user has a profile
					$result_profile = queryMysql("SELECT * FROM profile WHERE reg_no = '$reg_no'");
					//$rows = $result_profile -> num_rows;
					$row = $result_profile -> fetch_array(MYSQLI_ASSOC);
					if ( $row['profile_img'] ) {
						
						$_SESSION['profile_image'] = $profile_image = "img/user_profile/".$row['profile_img'];

					?>	
						<div class="profile_pic">
							<img src="<?php echo $profile_image; ?>" class="img-circle rounded-circle" width="90">
							
							<a class="nick_name text-white font-weight-bolder ml-1" href="profile.php"><?php echo $row['nick_name']; ?>
							</a>
						</div>
						
					<?php	
					}else{
					?>	
						<div class="profile_pic rounded-circle">
							<img src="img/icons8_Ninja_Head_96px.png" class="img-circle rounded-circle" width="100">
							<a class="nick_name text-white font-weight-bolder" href="profile.php"><?php echo $row['nick_name']; ?>
							</a>

						</div>
					<?php	
					}
				?>


				<?php
				}else {
					echo '
						<h1><a href="home.php" class="logo"><!-- CC <span>Chuka Connect</span> --><img src="img/logo/cc_2_removebg_preview_5Lg_icon.ico" alt=""></a></h1>
					';
				}

				?>
		        <ul class="list-unstyled components mb-5">
		          	<li class="active">
		            	<a href="home.php"><span class="fa fa-home mr-3"></span> Home</a>
		          	</li>
		          	<?php
		          	if ($loggedin ) {
		          	?>

			          	<li>
			               <a href="profile.php"><span class="fa fa-user mr-3"></span> Profile</a>
			          	</li>

			          	<li class="hidden-sm-down dropdown" >
			          		
				    		<a href="#connection_request_list" class="dropdown-toggle dropdown_click" data-user_reg_no="<?php echo $_SESSION['reg_no'] ?>" data-toggle="collapse">
				    			<span id="unseen_friend_request_area"></span>
				    			<i class="fa fa-user-plus fa-2 pr-4" aria-hidden="true"></i>
				    			<span class="caret"></span>
				    		</a>
				    		
				    		<li class="collapse" id="connection_request_list"  style="width: 300px; max-height: 350px;">
				    			
				    		</li>
				    	</li>

			          	

				        <li>
			               <a href="campus_connect.php"><span class="fas fa-university mr-3"></span> Campus Connect</a>
				        </li>
			          	<li>
		                    <a href="course_connect.php"><span class="fas fa-book mr-3"></span> Course Connect</a>
			          	</li>
			          	<li>
		              		<a href="county_connect.php"><span class="fas fa-address-card mr-3"></span> County Connect</a>
			          	</li>
			          	<li>
		              		<a href="hostel_connect.php"><span class="fas fa-h-square mr-3"></span> Hostel Connect</a>
			          	</li>
			          	<li>
		              		<a href="relationship_connect.php"><span class="fas fa-heart mr-3"></span> Relationship Connect</a>
			          	</li>
			          	<li>
		              		<a href="sports_connect.php"><span class="fas fa-running mr-3"></span> Sports Connect</a>
			          	</li>
			          	<!-- <li>
		              		<a href="internship_connect.php"><span class="fa fa-suitcase mr-3"></span> Internship Connect</a>
			          	</li> -->

			          	<li>
		              		<a href="religion_connect.php"><span class="fas fa-pray mr-3"></span> Religion Connect</a>
			          	</li>
			          	
			          	<li>
		              		<a href="project_connect.php"><span class="fas fa-project-diagram mr-3"></span> Project Connect</a>
			          	</li>
			          	<li>
		              		<a href="jobs_connect.php"><span class="fa fa-suitcase mr-3"></span> Jobs Connect</a>
			          	</li>



		          	<?php
		          	} else {
		          	?>

			          	<li>
		              		<a href="events.php"><span class="fas fa-calendar-check mr-3"></span> Events</a>
			          	</li>

			          	<li>
		              		<a href="ads.php"><span class="fab fa-buysellads mr-3"></span> Adverts</a>
			          	</li>

			          	<li>
		              		<a href="index.php"><span class="fas fa-sign-in-alt mr-3"></span> Login</a>
			          	</li>
			          	<li>
		              		<a href="create_account.php"><span class="fas fa-user-plus mr-3"></span> Create Account</a>
			          	</li>

		          	<?php
		          	}

		          	?>

		          	<li>
	              		<a href="about.php"><span class="fas fa-info-circle mr-3"></span> About</a>
		          	</li>
		          	<li>
	              		<a href="#"><span class="fas fa-envelope mr-3"></span> Contacts</a>
		          	</li>
		          	<?php if( $loggedin ) 
		          			echo "<li><a href='includes/logout_model.php'  data-toggle='modal' data-target='#logoutModal'><span class='fas fa-sign-out-alt mr-3'></span> Logout</a></li>"; 
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
		        	<p>
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <u>WabWi's Production</u>.
					</p>
		        </div>
	      	</div>
    	</nav>