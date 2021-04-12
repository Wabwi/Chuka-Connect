<?php
if (isset( $_POST['county_btn'])) {
	if (!empty($_POST['county'])) {
		$county = sanitizeString($_POST['county']);

		$result_users_same_county = queryMysql("SELECT * FROM profile WHERE county_id = '$county'");

		$rows_users_county = $result_users_same_county -> num_rows;
		if ($rows_users_county) {
			for ($i = 0; $i < $rows_users_county; $i++) { 
				$result_users_same_county -> data_seek($i);
				$row_user_county = $result_users_same_county -> fetch_array(MYSQLI_ASSOC);
			?>
			
				<div>
					<?php echo $row_user_county['nickname']; ?>
				</div>
			<?php	
			}
			
		}
	}
}

?>