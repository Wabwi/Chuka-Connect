<?php
require_once 'includes/header.php';
if (!$loggedin) {
	echo "<script> location.replace('index.php'); </script>";
}
?>


<div id="content">
	<?php require_once 'includes/upper_buttons.php'; ?>
	<div class="p-4 p-md-5 pt-5">
		<h2>Course Connect</h2>

		<div class="courses">
			<p>
				View Students Taking:<br>
				<form action="" method="POST">
					<div class="form-group w-50 w-sm-100 w-xs-100">
						
						<select name="course_code" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						<?php
						$result_course = queryMysql("SELECT * FROM courses");
						$rows_courses = $result_course -> fetch_all(MYSQLI_ASSOC);

						foreach ($rows_courses as $row_course) {
						?>

							<option <?php if( $row_course['course_code'] == $row['course_code'] ){ echo "selected = ".$row['course_code']; } $selected_course = $row_course['course_name']; ?> value="<?php echo $row_course['course_code']; ?>"><?php echo $row_course['course_name']; ?></option>
							
						<?php	
						}
						?>	
						</select>
					</div>

					<div class="form-group">
						<input type="submit" value="VIEW" name="students_course_btn" class="btn btn_beauty">
					</div>
				</form>
			</p>
			
			
		</div>
		<?php
		//DISPLAY SEARCH RESULTS FOR A COURSE
		if (isset($_POST['students_course_btn'])) {
			$course_code = sanitizeString($_POST['course_code']);
			$result_course_n = queryMysql("SELECT course_name FROM courses WHERE course_code = '$course_code'");

			$course_array = $result_course_n -> fetch_array(MYSQLI_ASSOC);
			$course_name = $course_array['course_name'];
			//echo "<script>alert('".$course_code."');</script>";
			echo '<div class="row">';
				$result_same_course = queryMysql("SELECT * FROM profile WHERE course_code = '$course_code' AND reg_no != '".$_SESSION['reg_no']."'");
				$rows_courses = $result_same_course -> num_rows;

				if( $rows_courses ){
					$rows_same_course = $result_same_course -> fetch_all(MYSQLI_ASSOC);
					?>
					<div class="col-lg-6 col-sm-4">
						<p>The following students study <b><u><?php echo $course_name; ?></u></b> <?php if($rows_courses > 10) echo " and " .($rows_courses - 10). " more..."; ?> </p>
						

					<?php
					foreach ($rows_same_course as $row_same_course) { 
						
						$profile_image = profileImage( $row_same_course);
						?>

							<div class="student_output mb-2">
								<a href="profile_display.php?reg_no=<?php echo $row_same_course['reg_no']; ?>">
								<div class="student_output_img">
									<img src="<?php echo $profile_image; ?>" class="rounded-circle" width="50" height="60">
								</div>
								
								<div class="clearfix">
									<div class="student_output_details float-left">
										<span ><?php echo $row_same_course['nick_name']; ?></span><br>
										<span><?php echo $course_name; ?> </span>
										
									</div>
									</a>

									<?php
									connect_button($row_same_course);
									?>
								</div>
								
							</div><hr>
						
					<?php	

					}
					echo "</div>";
				}
				
			echo '</div><!-- div row -->';
		}


		?>
		<div class="row">
			<?php
			//DISPLAY STUDENTS FROM THE SAME COURSE
			$result_same_course = queryMysql("SELECT * FROM profile WHERE course_code = '".$row['course_code']."' AND reg_no != '".$_SESSION['reg_no']."'");
			$r_course_name = queryMysql("SELECT course_name FROM courses WHERE course_code = '".$row['course_code']."'");
			$course_name = $r_course_name -> fetch_array(MYSQLI_ASSOC);
			$rows_same_course = $result_same_course -> num_rows;
			if ($row['course_code'] == null) {
				echo "<script>location.replace('create_profile.php?school_details');</script>";
			}
			if( $rows_same_course ){
				?>
				<div class="col-lg-6 col-sm-4">
					<p>Students from your course study <b><u><?php echo $course_name['course_name']; ?></u></b> <?php if($rows_same_course > 10) echo " and " .($rows_same_course - 10). " more..."; ?></p>
					

				<?php
				for ($i=0; $i < $rows_same_course; $i++) { 
					$result_same_course -> data_seek($i);
					$row_same_course = $result_same_course -> fetch_array(MYSQLI_ASSOC);
					$profile_image = profileImage( $row_same_course);
					?>

						<div class="student_output mb-2">
							<a href="profile_display.php?reg_no=<?php echo $row_same_course['reg_no']; ?>">
							<div class="student_output_img">
								<img src="<?php echo $profile_image; ?>" class="rounded-circle" width="50" height="60">
							</div>
							
							<div class="clearfix">
								<div class="student_output_details float-left">
									<span ><?php echo $row_same_course['nick_name']; ?></span><br>
									<span><?php echo $course_name['course_name']; ?> </span>
									
								</div>
								</a>

								<?php
								connect_button($row_same_course);
								?>
							</div>
							
						</div><hr>
					
				<?php	

				}
				echo "</div>";
			} else {
				echo "<div class='col-lg-6 col-sm-4'>
						There are no Registered Students from your Course yet...
					</div>";
			}


			?>
			
		</div><!-- div row -->
		
	</div>
	
</div>


<?php
require_once 'includes/footer.php';
?>