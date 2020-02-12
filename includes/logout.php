<?php
require_once 'functions.php';
session_start();

if( isset($_SESSION['reg_no']) ){
	destroySession();
	header( 'Location: ../home.php?logout=success' );
	exit();

} else{
	header('Location: home.php?logout=failed' );
	exit();
}

?>