<?php
require_once 'functions.php';

if ( isset( $_POST['create_account_btn']) ) {
	if (!empty( $_POST['email']) && !empty( $_POST['reg_no']) && !empty( $_POST['password']) && !empty( $_POST['re_password'])) {
		$email = sanitizeString($_POST['email']); 
		$reg_no = sanitizeString($_POST['reg_no']);
		$password = sanitizeString($_POST['password']);
		$re_password = sanitizeString($_POST['re_password']);
		if (!isEmail($email) ) {
			header( 'Location: ../create_account.php?error=wrongemailformat' );
			exit();
		}

		$result_exist = queryMysql("SELECT * FROM users WHERE email = '$email' OR reg_no = '$reg_no'");
		if ($result_exist -> num_rows) {
			header( 'Location: ../create_account.php?error=accountexist');
			exit();
		} else{

			if ($password == $re_password) {
				$result = queryMysql("INSERT INTO `users`(`reg_no`, `email`, `password`) VALUES ('$reg_no', '$email','$password')");

				$result = queryMysql("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
				if ( $result -> num_rows ) {
					$row = $result -> fetch_array( MYSQLI_ASSOC );
					$result -> close();

					session_start();
					$_SESSION['reg_no'] = $row['reg_no'];
					$_SESSION['user_name'] = $row['nick_name'];
				

					header( 'Location: ../home.php?login=success');
					exit();
					// header('Location: ../index.php?msg=accountcreatedsuccess');
					// exit();
				}

			} else {
				header( 'Location: ../create_account.php?error=passwordsnotmatch' );
				exit();
			}
			
		}


	} else{
		header('Location: ../create_account.php?error=fieldsempty');
		exit();
	}
}