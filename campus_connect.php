<?php
require_once 'includes/header.php';
if (!$loggedin) {
	echo "<script> location.replace('index.php'); </script>";
}
?>

<div id="content">
	<?php require_once 'includes/upper_buttons.php'; ?>
	<div class="p-4 p-md-5 pt-5">
		<h2>Campus Connect</h2>
		<div class="campuses pb-4">
			<div>
				<span class="h4">View</span> <div>-<a href="?main_campus"> Chuka Main Campus</a> Students</div>
					  <div>-<a href="?embu_campus"> Embu Campus</a> Students</div>
			</div>
		</div>

		<?php
		if (isset($_REQUEST['embu_campus'])) {
			?>
			<div class="row">
				<?php
				$limit = 10;
				$page = isset($_GET['page']) ? $_GET['page'] : 1;
				$start = ($page - 1) * $limit;
				$result_c = queryMysql("SELECT * FROM profile WHERE campus_id = '2' AND reg_no != '".$_SESSION['reg_no']."' ");
				$total = $result_c -> num_rows;
				$pages = ceil( $total / $limit );

				if($page > 1) $Previous = $page - 1; else $Previous = 1;
				if($pages > 1 ) $Next = $page + 1; else $Next = 1;

				$result_same_campus = queryMysql("SELECT * FROM profile WHERE campus_id = '2' AND reg_no != '".$_SESSION['reg_no']."' LIMIT $start, $limit ");
				$rows_users = $result_same_campus -> num_rows;
				
				if( $rows_users ){
					$rows_same_campus = $result_same_campus -> fetch_all(MYSQLI_ASSOC);
					?>
					<div class="col-lg-6 col-md-6">
						<p>The following students belong to <b>Embu Campus</b> <?php if($total > 10) echo " and " .($total - 10). " more..."; ?></p>					

						<?php
						foreach ($rows_same_campus as $row_same_campus) { 
							$profile_image = profileImage($row_same_campus);
							?>

								<div class="student_output mb-2">
									<a href="profile_display.php?reg_no=<?php echo $row_same_campus['reg_no']; ?>">
										<div class="student_output_img">
											<img src="<?php echo $profile_image; ?>" class="rounded-circle" width="50" height="60">
										</div>

										<div class="clearfix">
											<div class="student_output_details float-left">
												<span ><?php echo $row_same_campus['nick_name']; ?></span><br>
												<span><?php if ($row_same_campus['gender'] == 'F') echo 'Female'; else echo 'Male'; ?> </span>
												
											</div>
									</a>

											<?php
											connect_button($row_same_campus);
											?>
										</div>
								</div><hr>
						<?php	
						}
					echo "</div>";			
				}

				?>
				
			</div> <!-- row div -->
			
		<?php
		paginationBtnExt('campus_connect.php?embu_campus&', $Previous, $Next, $pages);
		}
		if (isset($_REQUEST['main_campus'])) {
			?>
			<div class="row">
				<?php
				$limit = 10;
				$page = isset($_GET['page']) ? $_GET['page'] : 1;
				$start = ($page - 1) * $limit;
				$result_c = queryMysql("SELECT * FROM profile WHERE campus_id = '1' AND reg_no != '".$_SESSION['reg_no']."' ");
				$total = $result_c -> num_rows;
				$pages = ceil( $total / $limit );

				if($page > 1) $Previous = $page - 1; else $Previous = 1;
				if($pages > 1 ) $Next = $page + 1; else $Next = 1;

				$result_same_campus = queryMysql("SELECT * FROM profile WHERE campus_id = '1' AND reg_no != '".$_SESSION['reg_no']."' LIMIT $start, $limit ");
				$rows_same_campus = $result_same_campus -> num_rows;

				if( $rows_same_campus ){
					?>
					<div class="col-lg-6 col-md-6">
						<p>The following students belong to <b>Main Campus</b> <?php if($rows_same_campus >= 10){ echo " and " .($total - (10*$page)). " more...";} ?></p>					

						<?php
						for ($i=0; $i < $rows_same_campus; $i++) { 
							$result_same_campus -> data_seek($i);
							$row_same_campus = $result_same_campus -> fetch_array(MYSQLI_ASSOC);
							$profile_image = profileImage($row_same_campus);
							?>

								<div class="student_output mb-2">
									<a href="profile_display.php?reg_no=<?php echo $row_same_campus['reg_no']; ?>">
										<div class="student_output_img">
											<img src="<?php echo $profile_image; ?>" class="rounded-circle" width="50" height="60">
										</div>

										<div class="clearfix">
											<div class="student_output_details float-left">
												<span ><?php echo $row_same_campus['nick_name']; ?></span><br>
												<span><?php if ($row_same_campus['gender'] == 'F') echo 'Female'; else echo 'Male'; ?> </span>
												
											</div>
									</a>

											<?php
											connect_button($row_same_campus);
											?>
										</div>
								</div><hr>
						<?php	
						}
					echo "</div>";			
				}

				?>
			
			</div> <!-- row div -->
		<?php
		paginationBtnExt('campus_connect.php?main_campus&', $Previous, $Next, $pages);	
		}
		?>

		<div class="row">
			<?php
			$limit = 10;
			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$start = ($page - 1) * $limit;
			$result_c = queryMysql("SELECT * FROM profile WHERE campus_id = '".$row['campus_id']."' AND reg_no != '".$_SESSION['reg_no']."' ");
			$total = $result_c -> num_rows;
			
			$pages = ceil( $total / $limit );

			if($page > 1) $Previous = $page - 1; else $Previous = 1;
			if($pages > 1 ) $Next = $page + 1; else $Next = 1;

			$result_same_campus = queryMysql("SELECT * FROM profile WHERE campus_id = '".$row['campus_id']."' AND reg_no != '".$_SESSION['reg_no']."' LIMIT $start, $limit ");
			$rows_same_campus = $result_same_campus -> num_rows;
			
			if( $rows_same_campus ){
				?>
				<div class="col-lg-6 col-md-6">
					<p>The following students belong to your Campus <?php if($rows_same_campus >= 10) echo " and " .($total - (10*$page)). " more..."; ?></p>					

					<?php
					for ($i=0; $i < $rows_same_campus; $i++) { 
						$result_same_campus -> data_seek($i);
						$row_same_campus = $result_same_campus -> fetch_array(MYSQLI_ASSOC);
						$profile_image = profileImage($row_same_campus);
						?>

							<div class="student_output mb-2">
								<a href="profile_display.php?reg_no=<?php echo $row_same_campus['reg_no']; ?>">
									<div class="student_output_img">
										<img src="<?php echo $profile_image; ?>" class="rounded-circle" width="50" height="60">
									</div>

									<div class="clearfix">
										<div class="student_output_details float-left">
											<span ><?php echo $row_same_campus['nick_name']; ?></span><br>
											<span><?php if ($row_same_campus['gender'] == 'F') echo 'Female'; else echo 'Male'; ?> </span>
											
										</div>
								</a>

										<?php
										connect_button($row_same_campus);
										?>
									</div>
							</div><hr>
					<?php	
					}
				echo "</div>";			
			}

			?>
			
		</div> <!-- row div -->
		<?php
		paginationBtn('campus_connect.php', $Previous, $Next, $pages);
		?>
		
	</div>
	
</div>


<?php
require_once 'includes/footer.php';
?>