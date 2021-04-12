<?php
require_once 'functions.php';
if ( isset( $_POST['login_btn']) ) {
	if ( !empty( $_POST['email']) && !empty( $_POST['password']) ) {
		if (isEmail($email) ) {
			$email = sanitizeString($_POST['email']);
			$password = sanitizeString($_POST['password']);

			$result = queryMysql("SELECT * FROM users WHERE email = '$email' AND password = '$password'");
			if ( $result -> num_rows ) {
				$row = $result -> fetch_array( MYSQLI_ASSOC );
				$result -> close();

				session_start();
				$_SESSION['reg_no'] = $row['reg_no'];
				$_SESSION['user_name'] = $row['nick_name'];
				

				header( 'Location: ../home.php?login=success');
				exit();
			}else {
				header( 'Location: ../index.php?error=passwordoremailcombination');
				exit();
			}
		}else {
			header( 'Location: ../index.php?error=wrongemailformat');
			exit();
		}
		

	}else{
		header( 'Location: ../index.php?error=emptyfields' );
		exit();

	}
	
}


?>