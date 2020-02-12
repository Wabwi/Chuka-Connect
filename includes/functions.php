<?php
$dbhost = 'localhost';
$dbusername = 'root';
$dbname = 'chukaconnect';
$dbpass = '';

$conn = new mysqli( $dbhost, $dbusername, $dbpass, $dbname);
if( $conn -> connect_error ) die( $conn -> connect_error);

function queryMysql( $query ) {
	global $conn;
	$result = $conn -> query( $query );
	if ( !$result ) die( $conn -> error );
	return $result;
}

function sanitizeString( $var ) {
	global $conn;
	$var = strip_tags( $var );
	$var = htmlentities( $var );
	$var = stripslashes( $var );
	return $conn -> real_escape_string( $var );
}

function destroySession() {
	$_SESSION = array();
	if ( session_id() != "" || isset($_COOKIE[session_name()])) {
		setcookie( session_name(), '', time()-2592000, '/');
	}
	session_destroy();
}