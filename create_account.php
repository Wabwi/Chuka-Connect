<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Chuka Connect</title>

	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-6 col-lg-4 mx-auto">
				<div class="pb-5 pt-5 heading_logo">
					<h1 class="text-center  bg-primary rounded text-white shadow-sm">CC</h1>
				</div><!-- div heading_logo -->

				<div class="create_account_form_panel shadow-sm p-2">
					<div class="mx-auto text-center">
						<h4>Create Account</h4>
					</div>
					<form action="includes/create_account.inc.php" method="POST">
						<div class="form-group mb-5">
							<!--<label for="email">Email:</label>-->
							<input type="email" name="email" placeholder="Enter Email" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						</div>

						<div class="form-group mb-5">
							<!--<label for="email">Reg No.:</label>-->
							<input type="text" name="reg_no" placeholder="Enter Reg no." class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						</div>

						<div class="form-group mb-5">
							<!--<label for="password">Password:</label>-->
							<input type="password" name="password" placeholder="Enter Password" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						</div>

						<div class="form-group mb-5">
							<!--<label for="password">Retype Password:</label>-->
							<input type="password" name="re_password" placeholder="Retype Password" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						</div>

						<div class="form-group">
							<input type="submit" name="create_account_btn" value="create account" class="btn btn-primary ml-5">

							<input type="button" value="cancel" class="btn btn-primary ml-5 mr-0">
						</div>

						<div class="form-group">
							<a href="index.php" class="ml-5"><i>already have an account?</i></a>
						</div>

					</form>
				</div><!-- div login_form_panel -->
			</div>
		</div>
	</div><!-- div container -->
	
</body>
</html>