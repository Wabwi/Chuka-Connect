<?php
require_once 'includes/header.php';

if( $loggedin ){
?>

<div id="content">
	<?php require_once 'includes/upper_buttons.php'; ?>
	<div class="p-4 p-md-5 pt-5">
		<div class="row">
			<div class="col-lg-6">
				<div>
					<?php

					$reg_no = $_SESSION['reg_no'];
					$result_requested_friends = queryMysql("SELECT * FROM connected WHERE connected_to = '$reg_no' AND connection_status = 'Pending' ORDER BY id DESC");
					$rows_result_requested_friends = $result_requested_friends -> fetch_all(MYSQLI_ASSOC);

					foreach ($rows_result_requested_friends as $row_result_requested_friends) {

						$result_profile_data = queryMysql("SELECT reg_no, profile_img, nick_name FROM profile WHERE reg_no = '".$row_result_requested_friends['connection_from']."'");
						$row_result_profile_data = $result_profile_data -> fetch_array(MYSQLI_ASSOC);

						$profile_img = profileImage($row_result_profile_data);

						echo '
						<div class="p-2">
							<div class="student_output pl-2">
								<div class="student_output_img">
									<img src="'.$profile_img.'" class="rounded-circle float-left mr-0" width="40" height="40">
								</div>

								<div class="student_output_details clearfix">
									<span >'.$row_result_profile_data['nick_name'].'</span>
									<button class="btn btn-sm font-weight-light btn_beauty pl-3 pr-3 float-right accept_connection_btn" data-requested_reg_no="'.$row_result_profile_data['reg_no'].'" data-id="'.$row_result_requested_friends['id'].'" data-user_reg_no="'.$reg_no.'" id="accept_connection_btn_'.$row_result_requested_friends['id'].'"><i class="fa fa-plus" aria-hidden="true"></i> Accept</button>
								</div>	
							</div>
						</div>';
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