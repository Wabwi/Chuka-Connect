<?php
require_once 'includes/header.php';
if (!$loggedin) {
	echo "<script> location.replace('about.php'); </script>";
}
?>


<div id="content"><?php require_once 'includes/upper_buttons.php' ?>
<div class="p-4 p-md-5 pt-5">

	<div class="container">
		<?php
		if ( isset($_GET['reg_no']) ) {
			$reg_no_for_display = sanitizeString($_GET['reg_no']);
			$result_profile = queryMysql("SELECT * FROM profile WHERE reg_no = '$reg_no_for_display'");
			$row_profile = $result_profile -> fetch_array(MYSQLI_ASSOC);
			$profile_image = "img/user_profile/".$row_profile['profile_img'];
		?>

		<div class="jumbotron-fluid">
			<h1><?php echo $row_profile['nick_name']; ?></h1>
			<?php
			if ( $row_profile['profile_img'] ) {
				?>
				<div class="profile_pic">
					<img src="<?php echo $profile_image; ?>" width="150">
				</div>

				<?php

			}else{
				?>
				<div class="profile_pic">
					<img src="img/icons8_Ninja_Head_96px.png" class="img-circle" width="150">
				</div>
			<?php	

			}
			?>

				<div class="row">
					<div class="col-lg-6 shadow pt-3 mt-3">
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#personal_info">Personal Info</a></li><span class="pr-3">|</span>
							<li><a data-toggle="tab" href="#contacts">Contacts</a></li><span class="pr-3">|</span>
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
							<div id="personal_info" class="tab-pane in active">
								<h4>Personal Info</h4>
								<label for="nick_name">User Name:</label>
								<b><?php echo $row_profile['nick_name'];?></b><br>

								<label for="first_name">First Name:</label>
								<b><?php echo $row_profile['first_name'];?></b><br>

								<label for="last_name">Last Name:</label>
								<b><?php echo $row_profile['last_name'];?></b><br>

								<label for="date_of_birth">Date of Birth:</label>
								<b><?php echo $row_profile['date_of_birth'];?></b><br>


								<label for="date_of_birth">Gender:</label>
								<b><?php echo $row_profile['gender'];?></b><br>

							</div><!-- div personal_info -->

							<div id="contacts" class="tab-pane fade">
								<?php

								$result_contacts = queryMysql("SELECT * FROM contacts WHERE reg_no = '".$row_profile['reg_no']."' ");
								$row_contact = $result_contacts -> fetch_array(MYSQLI_ASSOC);
								?>
								<h4>Contacts</h4>
									<label for="phone_no">Phone Number:</label>
									<b><?php echo '0'.$row_contact['phone_no'];?></b><br>

									<label for="facebook_name">Facebook Name:</label>
									<b><?php echo $row_contact['facebook_name'];?></b><br>

									<label for="twitter_handle">Twitter-handle:</label>
									<b><?php echo $row_contact['twitter_handle'];?></b><br>

									<label for="instagram">Instagram:</label>
									<b><?php echo $row_contact['instagram'];?></b><br>

							</div><!-- div contacts -->

							<div id="relationship_status" class="tab-pane fade">
								<h4>Relationship Status</h4>
								<label>Status:</label>
								<?php
								$relation_id = $row_profile['relationship_status_id'];
								$result_relationship = queryMysql("SELECT relationship_name FROM relationship WHERE relationship_id = '$relation_id'");
								$row_relation = $result_relationship -> fetch_array(MYSQLI_ASSOC);
								echo "<b>".$row_relation['relationship_name']."</b>";

								?>	
							</div><!-- div relationship_status -->

							<div id="hometown" class="tab-pane fade">
								<h4>Hometown</h4>
									<label for="county">County:</label>
									<?php
									$result_counties = queryMysql("SELECT * FROM counties WHERE county_id = '".$row_profile['county_id']."' ");
									
									$row_county = $result_counties -> fetch_array(MYSQLI_ASSOC);
									
									echo "<b>".$row_county['county_name']."</b>";
									
									?><br>
										

									<label for="hometown">Hometown:</label>
									<b><?php echo $row_profile['hometown']; ?></b><br>

							</div><!-- div hometown -->

							<div id="personal_project" class="tab-pane fade">
								<h4>Personal Projects </h4>
									<label for="personal_project">Personal Project:</label>
									<b><?php echo $row_profile['personal_project']; ?></b>
							</div><!-- div personal_project -->

							<div id="school_details" class="tab-pane fade">
								<h4>School Details</h4>
					
									<label for="campus">Campus:</label>
									<?php
									$result_campus = queryMysql("SELECT * FROM campus WHERE campus_id = '".$row_profile['campus_id']."' ");
									
									$row_campus = $result_campus -> fetch_array(MYSQLI_ASSOC);
								
									echo "<b>".$row_campus['campus_name']."</b><br>";
									
									echo '<label for="campus">Course:</label>';
									$result_course = queryMysql("SELECT * FROM courses WHERE course_code = '".$row_profile['course_code']."'");
									
									$row_course = $result_course -> fetch_array(MYSQLI_ASSOC);
			
									echo "<b>".$row_course['course_name']."</b><br>";
								
									?>	

									<label for="year_of_study">Year of Study:</label>
									<b><?php echo $row_profile['year_of_study']; ?></b><br>

									<label for="hostel">Hostel:</label>
									<b><?php echo $row_profile['hostel']; ?></b><br>

							</div><!-- div school_deatils -->

							<div id="favorites" class="tab-pane fade">
								<h4>Favorites</h4>
									<label for="favorite_food">Favorite Food:</label>
									<b><?php echo $row_profile['favorite_food']; ?></b><br>

									<label for="favorite_song">Favorite Song:</label>
									<b><?php echo $row_profile['favorite_song']; ?></b><br>

									<label for="favorite_place">Favorite Place:</label>
									<b><?php echo $row_profile['favorite_place']; ?></b><br>


									<label for="favorite_lecturer">Favorite Lecturer:</label>
									<b><?php echo $row_profile['favorite_lecturer']; ?></b><br>

									<label for="hobby">Hobbies:</label>
									<b><?php echo $row_profile['hobby']; ?></b><br>
									
							</div><!-- div favorites -->

							<div id="sports" class="tab-pane fade">
								<h4>Sports</h4>
									<label for="sports">Sports:</label>
									<?php

									$result_sports = queryMysql("SELECT * FROM sports WHERE sport_id = '".$row_profile['sports_id']."'");
									$row_sports = $result_sports -> fetch_array(MYSQLI_ASSOC);
									?>
									<b><?php echo $row_sports['sport_name']; ?></b>
							</div><!-- div personal_project -->

							<div id="religion" class="tab-pane fade">
								<h4>Religion</h4>
									<label for="sports">Religion:</label>
									<?php

									$result_religion = queryMysql("SELECT religion_name FROM religion WHERE religion_id = '".$row_profile['religion_id']."'");
									$row_religion = $result_religion -> fetch_array(MYSQLI_ASSOC);
									?>
									<b><?php echo $row_religion['religion_name']; ?></b>
							</div><!-- div religion -->


							<div id="highschool" class="tab-pane fade">
								<h4>High School</h4>
									<label for="highschool">School Name:</label>
									<b><?php echo $row_profile['former_highschool']; ?></b><br>

									<label for="county_from">From:</label>
									<?php
									$result_county = queryMysql("SELECT county_name FROM counties WHERE county_id = '".$row_profile['highschool_county']."' ");

									$row_county = $result_county -> fetch_array(MYSQLI_ASSOC);
									?>
									<b><?php echo $row_county['county_name'] ?> County</b>
							</div><!-- div highschool -->

						</div>



					</div><!-- div col-lg-6 -->
				</div><!-- div row -->

			
		</div>

		<?php
		}else {
			header( 'Location: create_profile.php');
			exit();
		}

		?>	
	</div>
</div>
</div> <!-- div content -->


<?php
require_once 'includes/footer.php';
?>