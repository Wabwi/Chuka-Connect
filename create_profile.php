<?php
require_once 'includes/header.php';
?>
<div id="content" class="p-4 p-md-5 pt-5">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<h4>Create Profile</h4>
				<div class="p-2">
					<form action="includes/create_profile.inc.php" method="POST">
						<div class="form-group mb-5">
							<!--<label for="first_name">First name:</label>-->
							<input type="text" name="first_name" placeholder="First name" required="required" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						</div>

						<div class="form-group mb-5">
							<!--<label for="email">Reg No.:</label>-->
							<input type="text" name="middle_name" placeholder="Surname" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						</div>

						<div class="form-group mb-5">
							<!--<label for="password">Password:</label>-->
							<input type="text" name="last_name" placeholder="Last name" required="required" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						</div>

						<div class="form-group mb-5">
							<!--<label for="password">Retype Password:</label>-->
							<input type="text" name="nick_name" placeholder="Nick name" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						</div>

						<div class="form-group mb-5">
							Gender:<br>
							<input type="radio" name="gender" value="F" required="required">
							<label for="female">Female</label><br>

							<input type="radio" name="gender" value="M" required="required">
							<label for="male">Male</label>
								
						</div>

						<div class="form-group">
							<label for="date_of_birth">Date Of Birth:</label>
							<input type="date" name="date_of_birth" class="form-control">
						</div>

						<div class="form-group">
							<input type="submit" name="create_account_btn" value="SAVE" class="btn btn-primary">

							<input type="button" value="CANCEL" class="btn btn-primary ml-5 mr-0">
						</div>
					</form>
				</div>
			</div>
		</div><!-- row div -->
	</div><!-- container div -->
</div><!-- content div -->




<?php
require_once 'includes/footer.php';
?> 