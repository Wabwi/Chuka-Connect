<?php
require_once 'includes/header.php';

if( $loggedin ){
?>

<div id="content">
	<?php require_once 'includes/upper_buttons.php'; ?>
	<div class="p-4 p-md-5 pt-5">
		<div class="sport">
			<h2>Sports Connect</h2>
			<div class="row">
				<?php
				$user_sport = $row['sports_id'];
				$result_sport_name = queryMysql("SELECT * FROM sports WHERE sport_id = '$user_sport'");
				$row_sport_name = $result_sport_name -> fetch_array(MYSQLI_ASSOC);

				if( $row_sport_name ){
				?>
				<div class="col-lg-6 col-md-6">
					<p>People you share interest in <b><?php echo $row_sport_name['sport_name'] ?></b></p>

					<?php
					$result_same_sport = queryMysql("SELECT * FROM profile WHERE sports_id = '$user_sport' AND reg_no != '".$_SESSION['reg_no']."'");
					$rows_same_sport = $result_same_sport -> num_rows;
					if ($rows_same_sport) {
						for ($i = 0; $i < $rows_same_sport; $i++) { 
							$result_same_sport -> data_seek($i);
							$row_same_sport = $result_same_sport -> fetch_array(MYSQLI_ASSOC);

							$profile_image = profileImage($row_same_sport);
						?>
							<div class="student_output mb-2">
								<a href="profile_display.php?reg_no=<?php echo $row_same_sport['reg_no']; ?>">
								<div class="student_output_img">
									<img src="<?php echo $profile_image; ?>" class="rounded-circle" width="50" height="60">
								</div>
								<div class="clearfix">
									<div class="student_output_details float-left">
										<span ><?php echo $row_same_sport['nick_name']; ?></span><br>
										<span><?php echo $row_sport_name['sport_name'] ?> </span>
										
									</div>
									</a>
									<?php
									connect_button($row_same_sport);
									?>

								</div>
							</div><hr>
						

						<?php	
						}
						
					} else{
						echo "<p>Your friends have not registered their interest in ".$user_sport. "</p>";
						echo '<p><b><a href="#">Click here</a></b> to invite them</p>';
					}

					?>
			
				
				<?php
			    } else{
			    	echo '<div class="student_output"><h4>Choose Your Sport and get Connected!</h4><br>
			    	<p><b><a href="create_profile.php?sports"> Click here</a></b> to Enter your favorite sports or the one you are a member</p></div>';
			    } 

				?>
				</div>
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