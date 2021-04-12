<?php
require_once 'includes/header.php';

if( $loggedin ){
?>

<div id="content">
	<?php require_once 'includes/upper_buttons.php'; ?>
	<div class="p-4 p-md-5 pt-5">
		<div class="container">
			<h2>Religion Connect</h2>

			<?php   if ( $row['religion_id'] != ''){ ?>
			<div class="religion">
				<section>
					View Students From:<br>
					<form action="" method="POST">
						<div class="form-group w-50">
							<select name="religion_id" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
							<?php
							$result_religions = queryMysql("SELECT * FROM religion");
							$rows_religion = $result_religions -> num_rows;

							for ($i=0; $i < $rows_religion; $i++) { 
								$result_religions -> data_seek($i);
								$row_religion = $result_religions -> fetch_array(MYSQLI_ASSOC);
							?>
								<option <?php if( $row_religion['religion_id'] == $row['religion_id'] ){ echo "selected = ".$row['religion_id']; $religion_selected = $row_religion['religion_name']; } ?> value="<?php echo $row_religion['religion_id']; ?>"><?php echo $row_religion['religion_name']; ?></option>
							<?php	
							}
							?>	
							</select>
						</div>

						<div class="form-group">
							<input type="submit" value="VIEW" name="religion_btn" class="btn btn_beauty">
						</div>
					</form>

				</section>
			</div><!--  div religions -->

			<div class="row">

				<?php
				if (isset( $_POST['religion_btn'])) {
					if (!empty($_POST['religion_id'])) {
						$religion_id = sanitizeString($_POST['religion_id']);

						//pagination code
						$limit = 10;
						$page = isset($_GET['page']) ? $_GET['page'] : 1;
						$start = ($page - 1) * $limit;
						$result_c = queryMysql("SELECT * FROM profile WHERE religion_id = '$religion_id' AND reg_no != '".$_SESSION['reg_no']."' ");
						$total = $result_c -> num_rows;
						$pages = ceil( $total / $limit );

						if($page > 1) $Previous = $page - 1; else $Previous = 1;
						if($pages > 1 ) $Next = $page + 1; else $Next = 1;
						//pagination code

						//$result_users_same_religion = queryMysql("SELECT * FROM profile WHERE religion_id = '$religion_id' AND reg_no != '".$_SESSION['reg_no']."'");
						$result_religions = queryMysql("SELECT * FROM religion WHERE religion_id = '$religion_id'");
						$row_of_religion = $result_religions -> fetch_array(MYSQLI_ASSOC);

						
						if ($result_c -> num_rows) {
							$rows_same_searched_religion = $result_c -> fetch_all(MYSQLI_ASSOC);
							?>
							<div class="col-lg-6 col-md-6">
								<p>The following students are from <b><u><?php echo $row_of_religion['religion_name']; ?></u></b> Religion and 67 more...</p>

								<?php
								foreach ($rows_same_searched_religion as $row_same_religion) { 
									$profile_image = profileImage($row_same_religion);	
								?>
								
									<div class="student_output mb-2">
										<a href="profile_display.php?reg_no=<?php echo $row_user_county['reg_no']; ?>">
										<div class="student_output_img">
											<img src="<?php echo $profile_image; ?>" class="rounded-circle float-left mr-0" width="50" height="60">
										</div>
										
										<div class="clearfix">
											<div class="student_output_details float-left">
												<span ><?php echo $row_same_religion['nick_name']; ?></span><br>
												<span><?php echo $row_of_religion['religion_name']; ?> </span>
												
											</div>
											</a>

											<?php
											connect_button($row_same_religion);
											?>
										</div>
										

									</div><hr>
								
								<?php	
								}
								paginationBtn('religion_connect.php', $Previous, $Next, $pages);
							echo '</div>';
							
						} else{
							echo "<p>No Students from " . $row_of_religion['religion_name'] . " </p>";
						}
					}
				}
			echo "</div> <!-- div row -->";

				
							
			echo '<div class="row pt-4">';	
				
				//pagination code
				$limit = 10;
				$page = isset($_GET['page']) ? $_GET['page'] : 1;
				$start = ($page - 1) * $limit;
				$result_r = queryMysql("SELECT * FROM profile WHERE religion_id = '".$row['religion_id']."' AND reg_no != '".$_SESSION['reg_no']."' ");
				$total = $result_r -> num_rows;
				$pages = ceil( $total / $limit );

				if($page > 1) $Previous = $page - 1; else $Previous = 1;
				if($pages > 1 ) $Next = $page + 1; else $Next = 1;

				//checking religion name of user
				$result_religion = queryMysql("SELECT * FROM religion WHERE religion_id = '".$row['religion_id']."'");
				$row_religion = $result_religion -> fetch_array(MYSQLI_ASSOC);

				//if the number of rows returned is TRUE(tha is greater than 1)
				if ($result_r -> num_rows) {
					$rows_same_religion = $result_r -> fetch_all(MYSQLI_ASSOC);
					?>
					<div class="col-lg-6 col-md-6">
						<p>Students from <b><u><?php echo $row_religion['religion_name']; ?></u></b> Religion</p>

						<?php
						foreach ($rows_same_religion as $same_religion) {
							$profile_image = profileImage($same_religion);
							?>

							<div class="student_output mb-2">
								<a href="profile_display.php?reg_no=<?php echo $same_religion['reg_no']; ?>">
								<div class="student_output_img">
									<img src="<?php echo $profile_image; ?>" class="rounded-circle" width="50" height="60">
								</div>
								<div class="clearfix">
									<div class="student_output_details float-left">
										<span ><?php echo $same_religion['nick_name']; ?></span><br>
										<span><?php echo $row_religion['religion_name']; ?> </span>
										
									</div>
									</a>
									<?php
									connect_button($same_religion);
									?>
								</div>
							</div><hr>

							<?php
						}
						paginationBtn('religion_connect.php', $Previous, $Next, $pages);
					echo "</div>";
				}

				?>
			</div> <!-- div row -->
		<?php }else{
			echo 'Please <a href="create_profile.php?religion">Click Here</a> and Enter Your Religion name to get Connected';
		}



		?>





		</div>			
		
	</div>
</div>

<?php
} else{
	header( "Location: index.php?error=notloggedin");
	exit();
}

require_once 'includes/footer.php';
?>