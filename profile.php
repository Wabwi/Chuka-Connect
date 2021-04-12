<?php
require_once 'includes/header.php';
if (!$loggedin) {
	echo "<script> location.replace('about.php'); </script>";
}
?>

<div id="content" class="profile_page"><?php //require_once 'includes/upper_buttons.php' ?>
<div class="p-4 p-md-5 pt-5">

	<div class="container">
		<?php
		if ( $row['nick_name'] ) {
			$result_interested_buyers = queryMysql("SELECT * FROM interested_buyers WHERE product_id IN(SELECT ads_id FROM ads WHERE seller_id = '".$_SESSION['reg_no']."')");
			$no_interested_buyers = $result_interested_buyers -> num_rows;
			
		?>
		<div class="row">
			<div class="col-lg-6">
				<div class="clearfix">
					<a href="edit_profile.php" class="btn float-left upper_btn ml-3 mt-2 p-1 pr-2"><span class="pl-2 fa fa-cogs mr-2"></span> Edit Profile</a>

					<a href="advertise.php" class="btn float-right upper_btn ml-3 mt-2 p-1 pr-2"><span class="badge badge-spill badge-danger pl-1"><?php if($no_interested_buyers > 0) echo $no_interested_buyers; ?></span> Advertise</a>
					
					<!-- <div class="dropright float-right">
			    		<a href="#" class="dropdown-toggle dropdown_menu_connection_request_list" data-toggle="dropdown" data-user_reg_no="<?php //echo $_SESSION['reg_no'] ?>" id="">
			    			<span id="unseen_friend_request_area"></span>
			    			<i class="fa fa-user-plus fa-2 pr-4" aria-hidden="true"></i>
			    			<span class="caret"></span>
			    		</a>
			    		<ul class="dropdown-menu dropdown-menu-md-right" id="connection_request_list"  style="width: 300px; max-height: 350px;">

			    		</ul>
			    	</div> -->
			    	
				</div>
			</div>
		</div>
		
		
		<div class="jumbotron-fluid">
			<h3 class="pt-2"><?php echo $row['nick_name']; ?></h3>
			<?php
			$total = 0;
			$result_contacts = queryMysql("SELECT * FROM contacts WHERE reg_no = '".$_SESSION['reg_no']."' ");
			$row_contacts = $result_contacts -> fetch_array(MYSQLI_ASSOC);
			if ($result_contacts -> num_rows > 0) {
				foreach ($row_contacts as $contact) {
					if ($contact == '') {
						$GLOBALS['total'] = $GLOBALS['total'] + 1;

					}
				}
			} else {
				$GLOBALS['total'] = 4;
			}
			

			foreach ($row as $value) {
				if ($value == '') {
					$GLOBALS['total'] = $GLOBALS['total'] + 1;

				}
			}
			if ( isset($_SESSION['profile_image']) && $row['profile_img'] ) {
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
			$filled_out = 29 - $total;
			$percent = ceil(($filled_out / 29) * 100);
			?>
			<div class="row ">
				<div class="w-100">
					<!-- <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5"></div> -->
					<div class="col-lg-4">
						<span class="percent_status mt-2 w-25 " > <b class="pr-1"><?php echo $percent; ?>%</b><progress  value="<?php echo $percent; ?>" min="0" max="100"></progress></span>
					</div>
				</div>
			</div>
			<?php
			?>


				<div class="row">
					<div class="col-lg-6 shadow pt-3 mt-3">
						<ul class="nav nav-tabs">
							<?php //print_r($row_total); ?>
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

								<label for="nick_name">User name:</label>
								<b><?php echo $row['nick_name'];?></b><br>

								<label for="first_name">First Name:</label>
								<b><?php echo $row['first_name'];?></b><br>

								<label for="last_name">Last Name:</label>
								<b><?php echo $row['last_name'];?></b><br>

								<label for="date_of_birth">Date of Birth:</label>
								<b><?php echo $row['date_of_birth'];?></b><br>


								<label for="date_of_birth">Gender:</label>
								<b><?php echo $row['gender'];?></b><br>

							</div><!-- div personal_info -->

							<div id="contacts" class="tab-pane fade">
								<?php

								$result_contacts = queryMysql("SELECT * FROM contacts WHERE reg_no = '$reg_no' ");
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
								$relation_id = $row['relationship_status_id'];
								$result_relationship = queryMysql("SELECT relationship_name FROM relationship WHERE relationship_id = '$relation_id'");
								$row_relation = $result_relationship -> fetch_array(MYSQLI_ASSOC);
								echo "<b>".$row_relation['relationship_name']."</b>";

								?>	
							</div><!-- div relationship_status -->

							<div id="hometown" class="tab-pane fade">
								<h4>Hometown</h4>
									<label for="county">County:</label>
									<?php
									$result_counties = queryMysql("SELECT * FROM counties WHERE county_id = '".$row['county_id']."' ");
									
									$row_county = $result_counties -> fetch_array(MYSQLI_ASSOC);
									
									echo "<b>".$row_county['county_name']." County</b>";
									
									?><br>
										

									<label for="hometown">Hometown:</label>
									<b><?php echo $row['hometown']; ?></b><br>

							</div><!-- div hometown -->

							<div id="personal_project" class="tab-pane fade">
								<h4>Personal Projects </h4>
									<label for="personal_project">Personal Project:</label>
									<b><?php echo $row['personal_project']; ?></b>
							</div><!-- div personal_project -->

							<div id="school_details" class="tab-pane fade">
								<h4>School Details</h4>
					
									<label for="campus">Campus:</label>
									<?php
									$result_campus = queryMysql("SELECT * FROM campus WHERE campus_id = '".$row['campus_id']."' ");
									
									$row_campus = $result_campus -> fetch_array(MYSQLI_ASSOC);
								
									echo "<b>".$row_campus['campus_name']."</b><br>";
									
									echo '<label for="campus">Course:</label>';
									$result_course = queryMysql("SELECT * FROM courses WHERE course_code = '".$row['course_code']."'");
									
									$row_course = $result_course -> fetch_array(MYSQLI_ASSOC);
			
									echo "<b>".$row_course['course_name']."</b><br>";
								
									?>	

									<label for="year_of_study">Year of Study:</label>
									<b><?php echo $row['year_of_study']; ?></b><br>

									<label for="hostel">Hostel:</label>
									<b><?php echo $row['hostel']; ?></b><br>

							</div><!-- div school_deatils -->

							<div id="favorites" class="tab-pane fade">
								<h4>Favorites</h4>
									<label for="favorite_food">Favorite Food:</label>
									<b><?php echo $row['favorite_food']; ?></b><br>

									<label for="favorite_song">Favorite Song:</label>
									<b><?php echo $row['favorite_song']; ?></b><br>

									<label for="favorite_place">Favorite Place:</label>
									<b><?php echo $row['favorite_place']; ?></b><br>


									<label for="favorite_lecturer">Favorite Lecturer:</label>
									<b><?php echo $row['favorite_lecturer']; ?></b><br>

									<label for="hobby">Hobbies:</label>
									<b><?php echo $row['hobby']; ?></b><br>
									
							</div><!-- div favorites -->

							<div id="sports" class="tab-pane fade">
								<h4>Sports</h4>
									<label for="sports">Sports:</label>
									<?php

									$result_sp = queryMysql("SELECT * FROM sports WHERE sport_id = '".$row['sports_id']."'");
									$row_sp = $result_sp -> fetch_array(MYSQLI_ASSOC);
									?>
									<b><?php echo $row_sp['sport_name']; ?></b>
							</div><!-- div personal_project -->


							<div id="religion" class="tab-pane fade">
								<h4>Religion</h4>
									<label for="sports">Religion:</label>
									<?php

									$result_religion = queryMysql("SELECT religion_name FROM religion WHERE religion_id = '".$row['religion_id']."'");
									$row_religion = $result_religion -> fetch_array(MYSQLI_ASSOC);
									?>
									<b><?php echo $row_religion['religion_name']; ?></b>
							</div><!-- div religion -->


							<div id="highschool" class="tab-pane fade">
								<h4>High School</h4>
									<label for="highschool">School Name:</label>
									<b><?php echo $row['former_highschool']; ?></b><br>

									<label for="county_from">From:</label>
									<?php
									$result_county = queryMysql("SELECT county_name FROM counties WHERE county_id = '".$row['highschool_county']."' ");

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