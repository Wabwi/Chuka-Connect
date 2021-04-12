<?php
require_once 'includes/header.php';

if( $loggedin ){
?>

<div id="content">
	<?php require_once 'includes/upper_buttons.php'; ?>
	<div class="p-4 p-md-5 pt-5">
		<h2>Relationship Connect</h2>

		<div class="relationship">
			<p>
				View Students with Relationship status:<br>
				<form action="" method="POST">
					<div class="form-group w-50">
						<select name="relationship" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
						<?php
						$result_relationship = queryMysql("SELECT * FROM relationship");
						$rows_relationship = $result_relationship -> num_rows;

						for ($i=0; $i < $rows_relationship; $i++) { 
							$result_relationship -> data_seek($i);
							$row_relationship = $result_relationship -> fetch_array(MYSQLI_ASSOC);
						?>
							<option <?php if( $row_relationship['relationship_id'] == $row['relationship_status_id'] ){ echo "selected = ".$row['relationship_status_id']; $relationship_selected = $row_relationship['relationship_name']; } ?> value="<?php echo $row_relationship['relationship_id']; ?>"><?php echo $row_relationship['relationship_name']; ?></option>
						<?php	
						}
						?>	
						</select>
					</div>

					<div class="form-group">
						<input type="submit" value="VIEW" name="relationship_search_btn" class="btn btn_beauty">
					</div>
				</form>
			</p>

			<div class="row">
			<?php
			if (isset( $_POST['relationship_search_btn'])) {
				if (!empty($_POST['relationship'])) {
					$relationship = sanitizeString($_POST['relationship']);

					$result_same_relationship = queryMysql("SELECT * FROM profile WHERE relationship_status_id = '$relationship' AND reg_no != '".$_SESSION['reg_no']."'");
					//this query is used to get the relationship names since the column in profile table has only relationship id
					$result_relationship_name = queryMysql("SELECT * FROM relationship WHERE relationship_id = '$relationship'");
					$row_of_relationship = $result_relationship_name -> fetch_array(MYSQLI_ASSOC);

					$rows_users_same_relationship = $result_same_relationship -> num_rows;
					if ($rows_users_same_relationship) {
						?>
						<div class="col-lg-6 col-md-6">
							<p>Search Result of <b><u><?php echo $row_of_relationship['relationship_name']; ?></u></b> students</p>

							<?php
							for ($i = 0; $i < $rows_users_same_relationship; $i++) { 
								$result_same_relationship -> data_seek($i);
								$row_user_same_relationship = $result_same_relationship -> fetch_array(MYSQLI_ASSOC);
								$profile_image = profileImage($row_user_same_relationship);
							?>
							
								<div class="student_output mb-2">
									<a href="profile_display.php?reg_no=<?php echo $row_user_same_relationship['reg_no']; ?>">
									<div class="student_output_img">
										<img src="<?php echo $profile_image; ?>" class="rounded-circle float-left mr-0" width="50" height="60">
									</div>
									<div class="clearfix">
										<div class="student_output_details float-left">
											<span ><?php echo $row_user_same_relationship['nick_name']; ?></span><br>
											<span><?php echo $row_of_relationship['relationship_name']; ?> </span>
											
										</div>
										</a>
										<?php
										connect_button($row_user_same_relationship);
										?>

									</div>
								</div><hr>
						
							<?php	
							}
						echo "</div>";
					} else{
						echo "<p>No Students from ".$row_of_relationship['relationship_name']." Relationship. </p>";
					}
				}
			}

			?>
			</div>


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