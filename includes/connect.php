<?php
require_once 'functions.php';

if (isset($_POST['action'])) {

	if ($_POST['action'] == 'send_request') {
		//get the reg_no
		$reg_no = sanitizeString($_POST['reg_no']);
		$reg_no_from = sanitizeString($_POST['reg_no_from']);
		$conn_status = 'Pending';

		//insert the reg_no into the connected table as a fellow connected student
		$result_connected = queryMysql("INSERT INTO `connected`(`connection_from`, `connected_to`, `connection_status`) VALUES ('$reg_no_from', '$reg_no', '$conn_status')");
	}

	if ($_POST['action'] == 'load_connection_request_list' ) {
		//sleep(5);
		$reg_no = $_POST['user_reg_no'];
		$result_requested_friends = queryMysql("SELECT * FROM connected WHERE connected_to = '$reg_no' AND connection_status = 'Pending' ORDER BY id DESC");
		$rows_result_requested_friends = $result_requested_friends -> fetch_all(MYSQLI_ASSOC);

		$output = '';
		foreach ($rows_result_requested_friends as $row_result_requested_friends) {

			$result_profile_data = queryMysql("SELECT reg_no, profile_img, nick_name FROM profile WHERE reg_no = '".$row_result_requested_friends['connection_from']."'");
			$row_result_profile_data = $result_profile_data -> fetch_array(MYSQLI_ASSOC);

			$profile_img = profileImage($row_result_profile_data);

			$output .= '
			<li class="p-2">
				<div class="student_output pl-2">
					<div class="student_output_img">
						<img src="'.$profile_img.'" class="rounded-circle float-left mr-0" width="40" height="40">
					</div>

					<div class="student_output_details clearfix">
						<span >'.$row_result_profile_data['nick_name'].'</span>
						<button name="accept_connection_btn" onclick="accept_connection('.$row_result_requested_friends['id'].')" class="btn btn-sm font-weight-light btn_beauty pl-3 pr-3 float-right accept_connection_btn" data-requested_reg_no="'.$row_result_profile_data['reg_no'].'" data-id="'.$row_result_requested_friends['id'].'" data-user_reg_no="'.$reg_no.'" id="accept_connection_btn_'.$row_result_requested_friends['id'].'"><i class="fa fa-plus" aria-hidden="true"></i> Accept</button>
					</div>	
				</div>
			</li>';
		}
		echo $output;
	}

	if ($_POST['action'] == 'accept_connection') {
		sleep(2);
		$id = $_POST['id'];

		queryMysql("UPDATE `connected` SET `connection_status` = 'Confirm', `connection_notification_status`= 1 WHERE `connected`.`id` = '$id';");
		echo 'connected';
		// UPDATE `connected` SET `id`=[value-1],`connection_from`=[value-2],`connected_to`=[value-3],`connection_status`=[value-4],`connection_notification_status`=[value-5],`date`=[value-6] WHERE 1
	}


}

?>