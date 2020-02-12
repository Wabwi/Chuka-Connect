<?php
require_once 'functions.php';

if ( isset( $_POST['create_account_btn']) ) {
	if (!empty( $_POST['email']) && !empty( $_POST['reg_no']) && !empty( $_POST['password']) && !empty( $_POST['re_password'])) {
		$email = sanitizeString($_POST['email']); 
		$reg_no = sanitizeString($_POST['reg_no']);
		$password = sanitizeString($_POST['password']);
		$re_password = sanitizeString($_POST['re_password']);

		$result_exist = queryMysql("SELECT * FROM users WHERE email = '$email' OR reg_no = '$reg_no'");
		if ($result_exist -> num_rows) {
			header( 'Location: ../create_account.php?error=accountexist');
			exit();
		} else{
			if ($password == $re_password) {
				$result = queryMysql("INSERT INTO `users`(`reg_no`, `email`, `password`) VALUES ('$reg_no', '$email','$password')");
				header('Location: ../index.php?accountcreated=success');
				exit();

			} else {
				header( 'Location: ../create_account.php?error=passwordsnotmatch' );
				exit();
			}
			
		}


	}
}