<?php
require_once 'includes/header.php';
if (!$loggedin) {
	echo "<script> location.replace('about.php'); </script>";
}
?>

<?php
if($loggedin) {
?>
	<div id="content">
		<?php require_once 'includes/upper_buttons.php'; ?>
		<div class="p-4 p-md-5 pt-5">
			<h2>Hostel Connect</h2>
	<?php   if ( $row['hostel'] != ''){ ?>
			<div class="hostels">
				<p>
					View Students From:<br>
					<form action="" method="POST">
						<div class="form-group w-50">
							<input type="text" placeholder="Enter Hostel name" name="hostel_name" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						</div>

						<div class="form-group">
							<input type="submit" value="Search" name="hostel_btn" class="btn btn_beauty">
						</div>
					</form>
				</p>
			</div><!--  div hostels -->

			<div class="row">

				<?php
				if( isset($_POST['hostel_btn'])){
					if(!empty($_POST['hostel_name'])){
						$hostel_name = sanitizeString($_POST['hostel_name']);
						$result_hostel_search = queryMysql("SELECT * FROM profile WHERE hostel LIKE '%$hostel_name%' AND reg_no != '".$_SESSION['reg_no']."'");
						$rows_hostels = $result_hostel_search -> num_rows;
						if ($rows_hostels) {
							?>
							<div class="col-lg-6 col-md-6">
								<p>Students from <b><u><?php echo $hostel_name; ?></u></b> Hostel</p>

								<?php
								for ($i = 0; $i < $rows_hostels; $i++) { 
									$result_hostel_search -> data_seek($i);
									$row_searched_hostel = $result_hostel_search -> fetch_array(MYSQLI_ASSOC);
									$profile_img = profileImage($row_searched_hostel);
								?>
								
									<div class="student_output mb-2">
										<a href="profile_display.php?reg_no=<?php echo $row_searched_hostel['reg_no']; ?>">
										<div class="student_output_img">
											<img src="<?php echo $profile_img; ?>" class="rounded-circle" width="50" height="60">
										</div>
										<div class="clearfix">
											<div class="student_output_details float-left">
												<span ><?php echo $row_searched_hostel['nick_name']; ?></span><br>
												<span><?php echo $row_searched_hostel['hostel']; ?> </span>
												
											</div>
											</a>

											<?php
											connect_button($row_searched_hostel);
											?>
										</div>
									</div><hr>

								<?php	

								}
							echo "</div>";	
							
						} else {
							echo "<p>No Students from ".$hostel_name."  Hostel. </p>";
						}
					}	
				}
							
				// $result_hostel_of_user = queryMysql("SELECT * FROM profile WHERE reg_no = '$reg_no'"); //returns hostel of loggedin user
				// $row_of_user = $result_hostel_of_user -> fetch_array(MYSQLI_ASSOC);
				$hostel_of_user = $row['hostel'];

				//searching for students with same hostel as loggedin user
				$result_same_hostel = queryMysql("SELECT * FROM profile WHERE hostel LIKE '%$hostel_of_user%' AND reg_no != '".$_SESSION['reg_no']."'");
				$rows_same_hostel = $result_same_hostel -> num_rows;

				//if the number of rows returned is TRUE(tha is greater than 1)
				if ($rows_same_hostel) {

					?>
					<div class="col-lg-6 col-md-6">
						<p>Students from <b><u><?php echo $hostel_of_user; ?></u></b> Hostel</p>

						<?php
						for ($i = 0; $i < $rows_same_hostel; $i++) { 
							$result_same_hostel -> data_seek($i);
							$row_same_hostel = $result_same_hostel -> fetch_array(MYSQLI_ASSOC);
							$profile_image = profileImage($row_same_hostel);

							?>

							<div class="student_output mb-2">
								<a href="profile_display.php?reg_no=<?php echo $row_same_hostel['reg_no']; ?>">
								<div class="student_output_img">
									<img src="<?php echo $profile_image; ?>" class="rounded-circle" width="50" height="60">
								</div>
								<div class="clearfix">
									<div class="student_output_details float-left">
										<span ><?php echo $row_same_hostel['nick_name']; ?></span><br>
										<span><?php echo $row_same_hostel['hostel']; ?> </span>
										
									</div>
									</a>
									<?php
									connect_button($row_same_hostel);
									?>
								</div>
							</div><hr>

							<?php
						}
					echo "</div>";
				}

				?>
			</div> <!-- div row -->
		<?php }else{
			echo 'Please <a href="create_profile.php?school_details">Click Here</a> and Enter Your Hostel name to get Connected';
		}



		?>
		</div>
		
	</div> <!-- div id content -->
<?php
} else{
	header( "Location: index.php?error=notloggedin");
	exit();
}


require_once 'includes/footer.php';
?>