<?php
require_once 'includes/header.php';
if($loggedin){
	
?>
<div id="content" class="p-4 p-md-5 pt-5">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<?php
				if ($_REQUEST == array()) {
					if ($row['nick_name']) {
						header("location: create_profile.php?contacts");
						exit();
					}
					?>
				 
				<h4>Create Profile</h4>
				<div class="p-2">
					<form action="includes/create_profile.inc.php" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<img src="img/icons8_Ninja_Head_96px.png" class="img-circle" width="150">
						</div>

						<div class="form-group">
							<label for="image">Choose Profile Picture:</label>
							<input type="file" name="image" class="form-control" required>
							
						</div>

						<div class="form-group mb-5">
							<!-- <label for="nick_name">Nick name :</label> -->
							<input type="text" name="nick_name" placeholder="User Name" class="form-control border border-primary border-top-0 border-right-0 border-left-0" required>
						</div>

						<div class="form-group mb-5">
							<!-- <label for="first_name">First name:</label> -->
							<input type="text" name="first_name" placeholder="First name" required="required" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						</div>

						<div class="form-group mb-5">
							<!-- <label for="middle_name">Middle Name:</label> -->
							<input type="text" name="middle_name" placeholder="Surname" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						</div>

						<div class="form-group mb-5">
							<!-- <label for="last_name">Last Name:</label> -->
							<input type="text" name="last_name" placeholder="Last name" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						</div>

						<div class="form-group">
							<label for="date_of_birth">Date Of Birth:</label>
							<input type="date" name="date_of_birth" class="form-control" required>
						</div>

						<div class="form-group mb-5">
							Gender:<br>
							<input type="radio" name="gender" value="F" required="required">
							<label for="female">Female</label><br>

							<input type="radio" name="gender" value="M" required="required">
							<label for="male">Male</label>
								
						</div>


						<div class="form-group">
							<input type="submit" name="create_profile_btn" value="SAVE" class="btn btn_beauty">

							<input type="button" value="CANCEL" class="btn btn_beauty ml-5 mr-0">
						</div>
					</form>
				</div> <!-- Personal Info -->

				<?php	
				 }

				 if (isset($_REQUEST['contacts'])) {
				 	$result_contact_exist = queryMysql("SELECT * FROM contacts WHERE reg_no = '$reg_no'");
				 	if ($result_contact_exist -> num_rows > 0) {
						header("location: create_profile.php?school_details");
						exit();
					}
				 ?>
				 	<div id="contacts" class="">
						<h4>Contacts</h4>
						<form method="POST" action="includes/create_profile.inc.php">
							<div class="form-group">
								<label for="phone_no">Phone no:</label>
								<input type="text" required="required" name="phone_no" class="form-control border border-primary border-top-0 border-right-0 border-left-0" >
							</div>

							<div class="form-group">
								<label for="facebook_name">Facebook Name:</label>
								<input type="text" name="facebook_name" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
							</div>

							<div class="form-group">
								<label for="twitter_handle">Twitter Handle:</label>
								<input type="text" name="twitter_handle" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
							</div>

							<div class="form-group">
								<label for="instagram">Instagram:</label>
								<input type="text" name="instagram" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
							</div>

							

							<div class="form-group">
								<input type="submit" value="SAVE" name="contacts_btn" class="btn btn-primary">
							</div>
							
						</form>
					</div><!-- div contacts -->

				 <?php
				 }

				if (isset($_REQUEST['school_details'])) {
					if ($row['campus_id'] && $row['course_code'] && $row['hostel']) {
						header("location: create_profile.php?hometown");
						exit();
					}
					?>
					<div id="school_details" class="">
						<h4>School Details</h4>
						<form action="includes/create_profile.inc.php" method="POST">

							<div class="form-group">
								<label for="campus">Campus</label>
								<select name="campus" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
								<?php
								$result_campus = queryMysql("SELECT * FROM campus");
								$rows_campus = $result_campus -> num_rows;

								for ($i=0; $i < $rows_campus; $i++) { 
									$result_campus -> data_seek($i);
									$row_campus = $result_campus -> fetch_array(MYSQLI_ASSOC);
								?>
									<option <?php if( $row_campus['campus_id'] == $row['campus_id'] ) echo "selected = ".$row['campus_id']; ?> value="<?php echo $row_campus['campus_id']; ?>"><?php echo $row_campus['campus_name']; ?></option>
								<?php	
								}
								?>	
								</select>
							</div>

							<div class="form-group">
								<label for="course">Course</label>
								<select name="course" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
									<option selected="selected" disabled>--select course--</option>
								<?php
								$result_course = queryMysql("SELECT * FROM courses");
								$rows_courses = $result_course -> num_rows;

								for ($i=0; $i < $rows_courses; $i++) { 
									$result_course -> data_seek($i);
									$row_course = $result_course -> fetch_array(MYSQLI_ASSOC);
								?>
									<option <?php if( $row_course['course_code'] == $row['course_code'] ) echo "selected = ".$row['course_code']; ?> value="<?php echo $row_course['course_code']; ?>"><?php echo $row_course['course_name']; ?></option>
								<?php	
								}
								?>	
								</select>
							</div>

							<div class="form-group">
								<label for="year_of_study">Year of Study</label>
								<input type="text" name="year_of_study" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
							</div>

							<div class="form-group">
								<label for="hostel">Hostel</label>
								<input type="text" name="hostel" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
							</div>

							

							<div class="form-group">
								<input type="submit" value="SAVE" name="school_details_btn" class="btn btn-primary">
							</div>
						</form>
					</div><!-- div school_deatils -->
				<?php
				}

				if (isset($_REQUEST['hometown'])) {
					if ($row['county_id']) {
						header("location: create_profile.php?highschool");
						exit();
					}
					?>
					<div id="hometown" class="">
					<h4>Hometown</h4>
					<form action="includes/create_profile.inc.php" method="POST">
						<div class="form-group">
							<label for="county">County</label>
							<select name="county" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
								<option selected="selected" disabled>--Select County--</option>
							<?php
							$result_counties = queryMysql("SELECT * FROM counties");
							$rows_counties= $result_counties -> num_rows;

							for ($i=0; $i < $rows_counties; $i++) { 
								$result_counties -> data_seek($i);
								$row_county = $result_counties -> fetch_array(MYSQLI_ASSOC);
							?>
								<option <?php if( $row_county['county_id'] == $row['county_id'] ) echo "selected = ".$row['county_id']; ?> value="<?php echo $row_county['county_id']; ?>"><?php echo $row_county['county_name']; ?></option>
							<?php	
							}
							?>	
							</select>
						</div>

						<div class="form-group">
							<label for="hometown">Hometown</label>
							<input type="text" name="hometown" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						</div>
						
						<div class="form-group">
							<input type="submit" value="SAVE" name="hometown_btn" class="btn btn-primary">
						</div>
					</form>
				</div><!-- div hometown -->
				<?php
				}

				if (isset($_REQUEST['highschool'])) {
					if ($row['former_highschool']) {
						header("location: create_profile.php?relationship_status");
						exit();
					}
					?>
					<div id="highschool" class="">
					<h4>Former High School </h4>
					<form action="includes/create_profile.inc.php" method="POST">

						<div class="form-group">
							<label for="personal_project">High School Name:</label>
							<input type="text" name="highschool" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
							
						</div>

						<div class="form-group">
							<label for="highschool_county">High School County</label>
							<select name="highschool_county" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
								<option selected="selected" disabled>--Select County--</option>
							<?php
							$result_counties = queryMysql("SELECT * FROM counties");
							$rows_counties= $result_counties -> num_rows;

							for ($i=0; $i < $rows_counties; $i++) { 
								$result_counties -> data_seek($i);
								$row_county = $result_counties -> fetch_array(MYSQLI_ASSOC);
							?>
								<option value="<?php echo $row_county['county_id']; ?>"><?php echo $row_county['county_name']; ?></option>
							<?php	
							}
							?>	
							</select>
						</div>

						<div class="form-group">
							<input type="submit" value="SAVE" name="highschool_btn" class="btn btn-primary">
						</div>
					</form>
				</div><!-- div highschool -->
				<?php
				}

				if (isset($_REQUEST['relationship_status'])) {
					if ($row['relationship_status_id']) {
						header("location: create_profile.php?favorites");
						exit();
					}
					?>
					<div id="relationship_status" class="">
					<h4>Relationship Status</h4>
					<form action="includes/create_profile.inc.php" method="POST">
						
						<div class="form-group">
							<label for="relationship_status">Relationship Status</label>
							<select name="relationship_status" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
								<option selected="selected" disabled>--select relationship status--</option>
							<?php
							$result_relationship = queryMysql("SELECT * FROM relationship");
							$rows_relation = $result_relationship -> fetch_all(MYSQLI_ASSOC);
							foreach ($rows_relation as $row_relation) { 
							?>
								<option value="<?php echo $row_relation['relationship_id']; ?>"><?php echo $row_relation['relationship_name']; ?></option>
							<?php	
							}
							?>	
							</select>
						</div>
						
						<div class="form-group">
							<input type="submit" value="SAVE" name="relationship_status_btn" class="btn btn-primary">
						</div>
					</form>
				</div><!-- div relationship_status -->
				<?php
				}

				if (isset($_REQUEST['favorites'])) {
					if ($row['favorite_food']) {
						header("location: create_profile.php?religion");
						exit();
					}
					?>
					<div id="favorites" class="">
					<h4>Favorites</h4>
					<form action="includes/create_profile.inc.php" method="POST">
						<div class="form-group">
							<label for="favorite_food">Favorite Food</label>
							<input type="text" name="favorite_food" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						</div>

						<div class="form-group">
							<label for="favorite_song">Favorite Song</label>
							<input type="text" name="favorite_song" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						</div>

						<div class="form-group">
							<label for="favorite_place">Favorite Place</label>
							<input type="text" name="favorite_place" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						</div>

						<div class="form-group">
							<label for="favorite_lecturer">Favorite Lecturer</label>
							<input type="text" name="favorite_lecturer" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						</div>

						<div class="form-group">
							<label for="hobby">Hobbies</label>
							<input type="text" name="hobby" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						</div>
						
						<div class="form-group">
							<input type="submit" value="SAVE" name="favorites_btn" class="btn btn-primary">
						</div>
					</form>
				</div><!-- div favorites -->
				<?php
				}

				if (isset($_REQUEST['religion'])) {
					if ($row['religion_id']) {
						header("location: create_profile.php?sports");
						exit();
					}
					?>
					<div id="religion" class="">
					<h4>Religion</h4>
					<form action="includes/create_profile.inc.php" method="POST">
						
						<div class="form-group">
							<label for="religion">Religion</label>
							<select name="religion_id" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
								<option selected="selected" disabled>--select religion--</option>
							<?php
							$result_religion = queryMysql("SELECT * FROM religion");
							$rows_religions = $result_religion -> fetch_all(MYSQLI_ASSOC);
							foreach ($rows_religions as $row_religion) {
							?>
								<option value="<?php echo $row_religion['religion_id']; ?>"><?php echo $row_religion['religion_name']; ?></option>
							<?php	
							}
							?>	
							</select>
						</div>
						
						<div class="form-group">
							<input type="submit" value="SAVE" name="religion_btn" class="btn btn-primary">
						</div>
					</form>
				</div><!-- div religion -->
				<?php
				}

				if (isset($_REQUEST['sports'])) {
					if ($row['sports_id']) {
						header("location: edit_profile.php");
						exit();
					}
					?>
					<div id="sports" class="">
					<h4>Sports</h4>
					<form action="includes/create_profile.inc.php" method="POST">

						<div class="form-group">
							<label for="sports">Sports</label>
							<select name="sport_id" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
								<option selected="selected" disabled>--Select sport--</option>
							<?php

							$result_sport = queryMysql("SELECT * FROM sports");
							$rows_sport = $result_sport -> num_rows;

							for ($i = 0; $i < $rows_sport; $i++) { 
								$result_sport -> data_seek($i);
								$row_sport = $result_sport -> fetch_array(MYSQLI_ASSOC);
							?>
							<option value="<?php echo $row_sport['sport_id']; ?>"><?php echo $row_sport['sport_name']; ?></option>

							<?php	
							}
							?>
							
							</select>
						</div>

						<div class="form-group">
							<input type="submit" value="SAVE" name="sport_btn" class="btn btn-primary">
						</div>
					</form>
				</div><!-- div sport -->
				<?php
				}
				?>



			</div>
		</div><!-- row div -->
	</div><!-- container div -->
</div><!-- content div -->




<?php
} else{
	header("Location: index.php?error=usernotloggedin");
	exit();
}
require_once 'includes/footer.php';
?> 