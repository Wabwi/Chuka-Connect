<?php
require_once 'includes/header.php';
if (!$loggedin) {
	echo "<script> location.replace('about.php'); </script>";
}

if ($row['hometown'] == null) {
	echo "<script>location.replace('create_profile.php?hometown');</script>";
}
?>


<div id="content">
	<?php require_once 'includes/upper_buttons.php'; ?>
	<div class="p-4 p-md-5 pt-5">
		<h2>County Connect</h2>

		<div class="counties">
			<p>
				View Students From:<br>
				<form action="" method="POST">
					<div class="form-group w-50">
						<select name="county" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						<?php
						$result_county = queryMysql("SELECT * FROM counties");
						$rows_county = $result_county -> num_rows;

						for ($i=0; $i < $rows_county; $i++) { 
							$result_county -> data_seek($i);
							$row_county = $result_county -> fetch_array(MYSQLI_ASSOC);
						?>
							<option <?php if( $row_county['county_id'] == $row['county_id'] ){ echo "selected = ".$row['county_id']; $county_selected = $row_county['county_name']; } ?> value="<?php echo $row_county['county_id']; ?>"><?php echo $row_county['county_name']; ?></option>
						<?php	
						}
						?>	
						</select>
					</div>

					<div class="form-group">
						<input type="submit" value="VIEW" name="county_btn" class="btn btn_beauty">
					</div>
				</form>
			</p>

			<div class="row">
				<?php
				//DISPLAY STUDENTS FROM THE SEARCHED COUNTY
				if (isset( $_POST['county_btn'])) {
					if (!empty($_POST['county'])) {
						$county = sanitizeString($_POST['county']);

						//pagination code
						$limit = 10;
						$page = isset($_GET['page']) ? $_GET['page'] : 1;
						$start = ($page - 1) * $limit;
						$result_c = queryMysql("SELECT * FROM profile WHERE county_id = '$county' AND reg_no != '".$_SESSION['reg_no']."' ");
						$total = $result_c -> num_rows;
						$pages = ceil( $total / $limit );

						if($page > 1) $Previous = $page - 1; else $Previous = 1;
						if($pages > 1 ) $Next = $page + 1; else $Next = 1;
						//pagination code

						$result_users_same_county = queryMysql("SELECT * FROM profile WHERE county_id = '$county' AND reg_no != '".$_SESSION['reg_no']."'");
						$result_county_name = queryMysql("SELECT * FROM counties WHERE county_id = '$county'");
						$row_of_county = $result_county_name -> fetch_array(MYSQLI_ASSOC);

						$rows_users_county = $result_users_same_county -> num_rows;
						if ($rows_users_county) {
							?>
							<div class="col-lg-6 col-md-6">
							<p>The following students come from <b><u><?php echo $row_of_county['county_name']; ?></u></b> County <?php if($rows_users_county > 10) echo " and " .($rows_users_county - 10). " more..."; ?></p>

							<?php
							for ($i = 0; $i < $rows_users_county; $i++) { 
								$result_users_same_county -> data_seek($i);
								$row_user_county = $result_users_same_county -> fetch_array(MYSQLI_ASSOC);
								$profile_image_user_county = profileImage($row_user_county);
							?>
							
								<div class="student_output mb-2">
									<a href="profile_display.php?reg_no=<?php echo $row_user_county['reg_no']; ?>">
									<div class="student_output_img">
										<img src="<?php echo $profile_image_user_county; ?>" class="rounded-circle float-left mr-0" width="50" height="60">
									</div>
									
									<div class="clearfix">
										<div class="student_output_details float-left">
											<span ><?php echo $row_user_county['nick_name']; ?></span><br>
											<span><?php echo $row_of_county['county_name']; ?> </span>
											
										</div>
										</a>

										<?php
										connect_button($row_user_county);
										?>
									</div>
									

								</div><hr>
							
							<?php	
							}
							echo '</div>';

							
						} else{
							echo "<div class='col-lg-6 col-sm-4'>
									<p>No Registered Students from " . $row_of_county['county_name'] . " </p></hr>
							</div>";
						}
					echo "</div> <!-- div row -->";

					
					paginationBtn('county_connect.php', $Previous, $Next, $pages);
					

					}
				}

				?>
			
			
		</div><!--  div counties -->

		<div class="row">
			<?php
			//DISPLAY STUDENTS FROM SAME COUNTY AS USER
			$limit = 10;
			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$start = ($page - 1) * $limit;
			$result_c = queryMysql("SELECT * FROM profile WHERE county_id = '".$row['county_id']."' AND reg_no != '".$_SESSION['reg_no']."' ");
			$total = $result_c -> num_rows;
			$pages = ceil( $total / $limit );

			if($page > 1) $Previous = $page - 1; else $Previous = 1;
			if($pages > 1 ) $Next = $page + 1; else $Next = 1;


			$result_same_county = queryMysql("SELECT * FROM profile WHERE county_id = '".$row['county_id']."' AND reg_no != '".$_SESSION['reg_no']."'");
			$rows_same_county = $result_same_county -> num_rows;

			if( $rows_same_county ){
				?>
				<div class="col-lg-6 col-md-6">
					<p>The following students come from <b><u><?php echo $county_selected; ?></u></b> County <?php if($rows_same_county > 10) echo " and " .($rows_same_county - 10). " more..."; ?></p>
					
				<?php
				for ($i=0; $i < $rows_same_county; $i++) { 
					$result_same_county -> data_seek($i);
					$row_same_county = $result_same_county -> fetch_array(MYSQLI_ASSOC);
					$profile_image = profileImage($row_same_county);
					?>

						<div class="student_output mb-2">
							<a href="profile_display.php?reg_no=<?php echo $row_same_county['reg_no']; ?>">
							<div class="student_output_img">
								<img src="<?php echo $profile_image; ?>" class="rounded-circle float-left mr-0" width="50" height="60">
							</div>
							
							<div class="clearfix">
								<div class="student_output_details float-left">
									<span ><?php echo $row_same_county['nick_name']; ?></span><br>
									<span><?php echo $county_selected; ?> </span>
									
								</div>
							</a>
								<?php
								connect_button($row_same_county);
								?>

							</div>
							
						</div><hr>
					
				<?php	

				}
				echo "</div>";	
			} else {
				echo '<div class="col-lg-6 col-sm-4">
						There are no students registered from your county yet...<hr>
					</div>';
			}

			//DISPLAY STUDENTS FROM THE SAME HOMETOWN AS USER
			if ($row['hometown'] == null) {
				echo "<script>location.replace('create_profile.php?hometown');</script>";
			}
			$result_same_hometown = queryMysql("SELECT * FROM profile WHERE (hometown = '".$row['hometown']."' OR hometown LIKE '%".$row['hometown']."%' OR hometown LIKE '%".$row['hometown']."') AND reg_no != '".$_SESSION['reg_no']."'");
			$rows_same_hometown = $result_same_hometown -> num_rows;

			if( $rows_same_hometown ){
			?>
				<div class="col-lg-6 col-md-6">
					<p>The following students come from <b><u><?php echo $row['hometown']; ?></u></b> hometown <?php if($rows_same_hometown > 10) echo " and " .($rows_same_hometown - 10). " more..."; ?></p>
					
					<?php
					for ($j = 0; $j < $rows_same_hometown; $j++) { 
						$result_same_hometown -> data_seek($j);
						$row_same_hometown = $result_same_hometown -> fetch_array(MYSQLI_ASSOC);
						$profile_image = profileImage($row_same_hometown);
						?>

							<div class="student_output mb-2">
								<a href="profile_display.php?reg_no=<?php echo $row_same_hometown['reg_no']; ?>">
								<div class="student_output_img">
									<img src="<?php echo $profile_image; ?>" class="rounded-circle" width="50" height="60">
									
								</div>
								<div class="clearfix">
									<div class="student_output_details float-left">
										<span ><?php echo $row_same_hometown['nick_name']; ?></span><br>
										<span><?php echo $row_same_hometown['hometown'] ; ?> </span>
										
									</div>
								</a>

									<?php
									connect_button($row_same_hometown);
									?>

								</div>
							</div><hr>
						
					<?php	

					}
				echo "</div>";
			
			}

			?>
			
		</div><!-- div row -->
		
	</div>
	
</div>


<?php
require_once 'includes/footer.php';
?>