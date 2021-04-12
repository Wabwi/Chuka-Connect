<?php
session_start();
require_once 'includes/functions.php';
$error = $msg = '';
if (isset($_SESSION['reg_no'])) {
	echo "<script> location.replace('home.php'); </script>";
	
}else{
	if (isset($_GET['error'])) {
		if ($_GET['error'] == 'passwordoremailcombination') {
			$error = 'Wrong Email and Password Combination';
		} elseif ($_GET['error'] == 'emptyfields') {
			$error = 'Empty Fields';
		}
		
	}

	if (isset($_GET['msg'])) {
		if ($_GET['msg'] == 'accountcreatedsuccess') {
			$msg = 'Account Created Successfully! You can now login.';
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Chuka Connect</title>

	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<style type="text/css">
		.heading_logo {
			background-color: #3445b4;
		}
		
		.btn_c {
		  background-color: #3445b4;
		  border-radius: 20px;
		  width: 80px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-6 col-lg-4 mx-auto">
				<a href="home.php">
				<div class="pb-5 pt-5">
					<h1 class="text-center heading_logo rounded text-white shadow-sm">CC</h1>
				</div></a>
				<!-- div heading_logo -->

				<div class="login_form_panel shadow-sm p-2">
					<div class="mx-auto text-center">
						<h4>Login</h4>
					</div>
					<?php

					if(!empty($error)) echo "<div class='alert alert-warning mb-10' role='alert'>
		              <h5 class='alert-heading'>Error</h5><span class='text-danger'>$error</span></div>";

		            if(!empty($msg)) echo "<div class='alert alert-success alert-dismissible mb-10' role='alert'>
      					<h5 class='alert-heading'>Message</h5><span class='text-success'>$msg</span></div>";  

					?>
					<form action="includes/login.inc.php" method="POST">
						<div class="form-group mb-5">
							<!--<label for="email">Email:</label>-->
							<input type="email" name="email" placeholder="Enter Email" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						</div>

						<div class="form-group mb-5">
							<!--<label for="password">Password:</label>-->
							<input type="password" name="password" placeholder="Enter Password" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						</div>

						<div class="form-group">
							<input type="submit" name="login_btn" value="login" class="btn btn_c text-white ml-5">

							<input type="button" value="cancel" class="btn btn_c text-white ml-5 mr-0">
						</div>

						<div class="form-group">
							<a href="forgot_password.php" class="ml-3"><i>forgot password?</i></a>
							<a href="create_account.php" class="ml-3 ml-sm-2"><i>create account</i></a>
						</div>

					</form>
				</div><!-- div login_form_panel -->
			</div>
		</div>
	</div><!-- div container -->
	
</body>
</html>

<?php
}
?>