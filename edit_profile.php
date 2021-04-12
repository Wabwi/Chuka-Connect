<?php
require_once 'includes/header.php';
if (!$loggedin) {
	echo "<script> location.replace('about.php'); </script>";
}

$result_relationship = queryMysql("SELECT * FROM relationship");
$rows_relation = $result_relationship -> num_rows;
?>
<script>
	
</script>

<div id="content" class="">
	<?php require_once 'includes/upper_buttons.php' ?>
<div class="container-fluid p-4 p-md-5 pt-5">
	<h2>Edit Profile</h2>
	<div class="jumbotron-fluid">
	<div class="row">
		<div class="col-lg-6">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#profile_pic">Profile Picture</a></li><span class="pr-3">|</span>
				<li><a data-toggle="tab" href="#personal_info">Personal Info</a></li><span class="pr-3">|</span>
				<li><a data-toggle="tab" href="#contacts">Contacts</a></li><span class="text-warning pr-3">|</span>
				<li><a data-toggle="tab" href="#relationship_status">Relationship Status</a></li><span class="text-primary pr-3">|</span>
				<li><a data-toggle="tab" href="#hometown">Hometown</a></li><span class="pr-3">|</span>
				<li><a data-toggle="tab" href="#personal_project">Personal Projects</a></li><span class="text-danger pr-3">|</span>
				<li><a data-toggle="tab" href="#school_details">School Details</a></li><span class="text-success pr-3">|</span>
				<li><a data-toggle="tab" href="#favorites">Favorites</a></li><span class="text-warning pr-3">|</span>
				<li><a data-toggle="tab" href="#sports">Sports</a></li><span class="text-primary pr-3">|</span>
				<li><a data-toggle="tab" href="#religion">Religion</a></li><span class="text-danger pr-3">|</span>
				<li><a data-toggle="tab" href="#highschool">Highschool</a></li><span class="text-success pr-3">|</span>
			</ul>

			<div class="tab-content pt-4">
				<div id="profile_pic" class="tab-pane in active">
					<!-- <form action="includes/edit_profile.inc.php">
						
					</form> -->	
					<div class="form-group">
						<label for="image">Choose Profile Picture:</label>
						<input type="file" id="upload" accept=".jpg, .jpeg, .png, .gif" name="image" class="form-control">
					</div>

						<div class="mt-2">
							<button class="btn_beauty p-1 px-2 mb-2" id="process_image">Review Image</button>
						</div>

						

						<div class="processed_img m-2 circula">
							<img id="output" alt="" >
						</div>

						<div class="form-group">
							<input type="submit" value="Upload Image" name="profile_pic" class="btn_beauty p-1 px-2 mt-2">
						</div>
					
					
				</div>

				<div id="personal_info" class="tab-pane fade">
					<h4>Personal Info</h4>
					<form method="POST" action="includes/edit_profile.inc.php">
						<div class="form-group">
							<label for="nick_name">User-name:</label>
							<input type="text" name="nick_name" class="form-control border border-primary border-top-0 border-right-0 border-left-0" value="<?php echo $row['nick_name'];?>">
						</div>

						<div class="form-group">
							<label for="first_name">First Name:</label>
							<input type="text" name="first_name" class="form-control border border-primary border-top-0 border-right-0 border-left-0" value="<?php echo $row['first_name'];?>">
						</div>

						<div class="form-group">
							<label for="last_name">Last Name:</label>
							<input type="text" name="last_name" class="form-control border border-primary border-top-0 border-right-0 border-left-0" value="<?php echo $row['last_name'];?>">
						</div>

						<div class="form-group">
							<label for="date_of_birth">Date of Birth:</label>
							<input type="text" name="date_of_birth" class="form-control border border-primary border-top-0 border-right-0 border-left-0" value="<?php echo $row['date_of_birth'];?>">
						</div>

						<div class="form-group mb-5">
							Gender:<br>
							<input type="radio" name="gender" value="F" required="required">
							<label for="female">Female</label><br>

							<input type="radio" name="gender" value="M" required="required">
							<label for="male">Male</label>
								
						</div>

						<div class="form-group">
							<input type="submit" value="SAVE" name="personal_info" class="btn btn-primary">
						</div>
						
					</form>
				</div><!-- div personal_info -->


				<div id="contacts" class="tab-pane fade">
					<h4>Contacts</h4>
					<?php
					$result_contacts = queryMysql("SELECT * FROM contacts WHERE reg_no = '$reg_no' ");
					$row_contacts = $result_contacts -> fetch_array(MYSQLI_ASSOC);
					?>
					<form method="POST" action="includes/edit_profile.inc.php">
						<div class="form-group">
							<label for="phone_no">Phone no:</label>
							<input type="text" required="required" name="phone_no" class="form-control border border-primary border-top-0 border-right-0 border-left-0" value="<?php echo $row_contacts['phone_no'];?>">
						</div>

						<div class="form-group">
							<label for="facebook_name">Facebook Name:</label>
							<input type="text" name="facebook_name" class="form-control border border-primary border-top-0 border-right-0 border-left-0" value="<?php echo $row_contacts['facebook_name'];?>">
						</div>

						<div class="form-group">
							<label for="twitter_handle">Twitter Handle:</label>
							<input type="text" name="twitter_handle" class="form-control border border-primary border-top-0 border-right-0 border-left-0" value="<?php echo $row_contacts['twitter_handle'];?>">
						</div>

						<div class="form-group">
							<label for="instagram">Instagram:</label>
							<input type="text" name="instagram" class="form-control border border-primary border-top-0 border-right-0 border-left-0" value="<?php echo $row_contacts['instagram'];?>">
						</div>

						

						<div class="form-group">
							<input type="submit" value="SAVE" name="contacts_btn" class="btn btn-primary">
						</div>
						
					</form>
				</div><!-- div contacts -->

				<div id="relationship_status" class="tab-pane fade">
					<h4>Relationship Status</h4>
					<form action="includes/edit_profile.inc.php" method="POST">
						
						<div class="form-group">
							<label for="relationship_status">Relationship Status</label>
							<select name="relationship_status" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
							<?php
							for ($i=0; $i < $rows_relation; $i++) { 
								$result_relationship -> data_seek($i);
								$row_relation = $result_relationship -> fetch_array(MYSQLI_ASSOC);
							?>
								<option <?php if( $row_relation['relationship_id'] == $row['relationship_status_id'] ) echo "selected = ".$row['relationship_status_id']; ?> value="<?php echo $row_relation['relationship_id']; ?>"><?php echo $row_relation['relationship_name']; ?></option>
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

				<div id="hometown" class="tab-pane fade">
					<h4>Hometown</h4>
					<form action="includes/edit_profile.inc.php" method="POST">
						<div class="form-group">
							<label for="county">County</label>
							<select name="county" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
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
							<input type="text" name="hometown" class="form-control border border-primary border-top-0 border-right-0 border-left-0" value="<?php echo $row['hometown']; ?>">
						</div>
						
						<div class="form-group">
							<input type="submit" value="SAVE" name="hometown_btn" class="btn btn-primary">
						</div>
					</form>
				</div><!-- div hometown -->

				<div id="personal_project" class="tab-pane fade">
					<h4>Personal Projects </h4>
					<form action="includes/edit_profile.inc.php" method="POST">

						<div class="form-group">
							<label for="personal_project">Personal Project</label>
							<textarea name="personal_project" class="form-control border border-primary border-top-0 border-right-0 border-left-0"><?php echo $row['personal_project']; ?>
							</textarea>
						</div>

						<div class="form-group">
							<input type="submit" value="SAVE" name="personal_project_btn" class="btn btn-primary">
						</div>
					</form>
				</div><!-- div personal_project -->

				<div id="school_details" class="tab-pane fade">
					<h4>School Details</h4>
					<form action="includes/edit_profile.inc.php" method="POST">

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
							<input type="text" name="year_of_study" class="form-control border border-primary border-top-0 border-right-0 border-left-0" value="<?php echo $row['year_of_study']; ?>">
						</div>

						<div class="form-group">
							<label for="hostel">Hostel</label>
							<input type="text" name="hostel" class="form-control border border-primary border-top-0 border-right-0 border-left-0" value="<?php echo $row['hostel']; ?>">
						</div>

						

						<div class="form-group">
							<input type="submit" value="SAVE" name="school_details_btn" class="btn btn-primary">
						</div>
					</form>
				</div><!-- div school_deatils -->

				<div id="favorites" class="tab-pane fade">
					<h4>Favorites</h4>
					<form action="includes/edit_profile.inc.php" method="POST">
						<div class="form-group">
							<label for="favorite_food">Favorite Food</label>
							<input type="text" name="favorite_food" class="form-control border border-primary border-top-0 border-right-0 border-left-0" value="<?php echo $row['favorite_food']; ?>">
						</div>

						<div class="form-group">
							<label for="favorite_song">Favorite Song</label>
							<input type="text" name="favorite_song" class="form-control border border-primary border-top-0 border-right-0 border-left-0" value="<?php echo $row['favorite_song']; ?>">
						</div>

						<div class="form-group">
							<label for="favorite_place">Favorite Place</label>
							<input type="text" name="favorite_place" class="form-control border border-primary border-top-0 border-right-0 border-left-0" value="<?php echo $row['favorite_place']; ?>">
						</div>

						<div class="form-group">
							<label for="favorite_lecturer">Favorite Lecturer</label>
							<input type="text" name="favorite_lecturer" class="form-control border border-primary border-top-0 border-right-0 border-left-0" value="<?php echo $row['favorite_lecturer']; ?>">
						</div>

						<div class="form-group">
							<label for="hobby">Hobbies</label>
							<input type="text" name="hobby" class="form-control border border-primary border-top-0 border-right-0 border-left-0" value="<?php echo $row['hobby']; ?>">
						</div>
						
						<div class="form-group">
							<input type="submit" value="SAVE" name="favorites_btn" class="btn btn-primary">
						</div>
					</form>
				</div><!-- div favorites -->


				<div id="sports" class="tab-pane fade">
					<h4>Sports</h4>
					<form action="includes/edit_profile.inc.php" method="POST">

						<div class="form-group">
							<label for="sports">Sports</label>
							<select name="sport_id" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
								<option selected="selected" disabled>--Select sport--</option>
							<?php

							$result_sport = queryMysql("SELECT * FROM sports");
							$rows_sport = $result_sport -> num_rows;

							if ($rows_sport) {
								for ($i = 0; $i < $rows_sport; $i++) { 
									$result_sport -> data_seek($i);
									$row_sport = $result_sport -> fetch_array(MYSQLI_ASSOC);
								?>
								<option <?php if( $row_sport['sport_id'] == $row['sports_id'] ) echo "selected = ".$row['sports_id']; ?> value="<?php echo $row_sport['sport_id']; ?>"><?php echo $row_sport['sport_name']; ?></option>

								<?php	
								}
							}
							
							?>
							
							</select>
						</div>

						<div class="form-group">
							<input type="submit" value="SAVE" name="sport_btn" class="btn btn-primary">
						</div>
					</form>
				</div><!-- div sport -->

				<div id="religion" class="tab-pane fade">
					<h4>Religion</h4>
					<form action="includes/edit_profile.inc.php" method="POST">
						
						<div class="form-group">
							<label for="religion">Religion</label>
							<select name="religion_id" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
								<option selected="selected" disabled>--select religion--</option>
							<?php
							$result_religion = queryMysql("SELECT * FROM religion");
							$rows_religions = $result_religion -> fetch_all(MYSQLI_ASSOC);
							foreach ($rows_religions as $row_religion) {
							?>
								<option <?php if( $row_religion['religion_id'] == $row['religion_id'] ) echo "selected = ".$row['religion_id']; ?> value="<?php echo $row_religion['religion_id']; ?>"><?php echo $row_religion['religion_name']; ?></option>
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

				<div id="highschool" class="tab-pane fade">
					<h4>Former High School</h4>
					<form action="includes/edit_profile.inc.php" method="POST">

						<div class="form-group">
							<label for="highschool">School Name:</label>
							<input type="text" name="highschool" class="form-control border border-primary border-top-0 border-right-0 border-left-0" value="<?php echo $row['former_highschool']; ?>">
							
						</div>

						<div class="form-group">
							<label for="highschool_county">High School County</label>
							<select name="highschool_county" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
								<option selected="selected">--Select County--</option>
							<?php
							$result_counties = queryMysql("SELECT * FROM counties");
							$rows_counties = $result_counties -> fetch_all(MYSQLI_ASSOC);

							foreach ($rows_counties as $row_county) {	
							?>
								<option <?php if( $row_county['county_id'] == $row['county_id'] ) echo "selected = ".$row['county_id']; ?> value="<?php echo $row_county['county_id']; ?>"><?php echo $row_county['county_name']; ?></option>
							<?php	
							}
							?>	
							</select>
						</div>

						<div class="form-group">
							<input type="submit" value="SAVE" name="highschool_btn" class="btn btn-primary">
						</div>
					</form>
				</div><!-- div personal_project -->


			</div>



		</div><!-- div col-lg-6 -->
	</div><!-- div row -->
	</div>
</div><!-- div container-fluid -->
</div>

<?php
require_once 'includes/footer.php';
?>