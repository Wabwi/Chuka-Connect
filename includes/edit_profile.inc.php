<?php
require_once 'functions.php';
session_start();

$reg_no = $_SESSION['reg_no'];
 

if (isset($_POST['personal_info'])) {

	$first_name = sanitizeString($_POST['first_name']);
	//$middle_name = sanitizeString($_POST['middle_name']);
	$last_name = sanitizeString($_POST['last_name']);
	$nick_name = sanitizeString($_POST['nick_name']);
	$date_of_birth = sanitizeString($_POST['date_of_birth']);
	$gender = sanitizeString($_POST['gender']);

	$result_personal_info = queryMysql("UPDATE profile SET first_name = '$first_name', last_name = '$last_name', nick_name = '$nick_name', date_of_birth = '$date_of_birth', gender = '$gender' WHERE reg_no = '$reg_no'" );

	header("Location: ../edit_profile.php?msg=personalinfoupdatesuccess");
	exit();
}

if(isset($_POST['contacts_btn'])){
	$phone_no = sanitizeString($_POST['phone_no']);
	$facebook_name = sanitizeString($_POST['facebook_name']);
	$twitter_handle = sanitizeString($_POST['twitter_handle']);
	$instagram = sanitizeString($_POST['instagram']);

	$check_contacts = queryMysql("SELECT * FROM contacts WHERE reg_no = '$reg_no' ");
	$rows_contacts = $check_contacts -> num_rows;
	if( $rows_contacts ){
			$result_contacts = queryMysql("UPDATE contacts SET phone_no = '$phone_no', facebook_name = '$facebook_name', twitter_handle = '$twitter_handle', instagram = '$instagram' WHERE reg_no = '$reg_no'");
	} else{
			$result_contacts = queryMysql("INSERT INTO contacts(phone_no, facebook_name, twitter_handle, instagram, reg_no) VALUES('$phone_no', '$facebook_name', '$twitter_handle', '$instagram', '$reg_no')  ");
	}
	
	header("Location: ../edit_profile.php?msg=contactsupdatesuccess");
	exit();
}

if (isset($_POST['relationship_status_btn'])) {

	$relationship_status = sanitizeString($_POST['relationship_status']);

	$result_relationship_status = queryMysql("UPDATE profile SET relationship_status_id = '$relationship_status' WHERE reg_no = '$reg_no'" );
	
	header("Location: ../edit_profile.php?msg=relationshipstatusupdatesuccess");
	exit();
}

if (isset($_POST['hometown_btn'])) {

	$county = sanitizeString($_POST['county']);
	$hometown = sanitizeString($_POST['hometown']);

	$result_hometown = queryMysql("UPDATE profile SET county_id = '$county', hometown = '$hometown' WHERE reg_no = '$reg_no'" );
	
	header("Location: ../edit_profile.php?msg=hometownupdatesuccess");
	exit();
}

if (isset($_POST['personal_project_btn'])) {

	$personal_project = sanitizeString($_POST['personal_project']);

	$result_personal_project = queryMysql("UPDATE profile SET personal_project = '$personal_project' WHERE reg_no = '$reg_no'" );
	
	header("Location: ../edit_profile.php?msg=personalprojectupdatesuccess");
	exit();
}

if (isset($_POST['school_details_btn'])) {

	$campus = sanitizeString($_POST['campus']);
	$course = sanitizeString($_POST['course']);
	$year_of_study = sanitizeString($_POST['year_of_study']);
	$hostel = sanitizeString($_POST['hostel']);


	$result_school_details = queryMysql("UPDATE profile SET campus_id = '$campus', course_code = '$course', year_of_study = '$year_of_study', hostel = '$hostel'  WHERE reg_no = '$reg_no'" );

	header("Location: ../edit_profile.php?msg=schooldetailsupdatesuccess");
	exit();
}

if (isset($_POST['favorites_btn'])) {

	$favorite_food = sanitizeString($_POST['favorite_food']);
	$favorite_song = sanitizeString($_POST['favorite_song']);
	$favorite_place = sanitizeString($_POST['favorite_place']);
	$favorite_lecturer = sanitizeString($_POST['favorite_lecturer']);
	$hobby = sanitizeString($_POST['hobby']);

	$result_favorites = queryMysql("UPDATE profile SET favorite_food = '$favorite_food', favorite_song = '$favorite_song', favorite_place = '$favorite_place', favorite_lecturer = '$favorite_lecturer', hobby = '$hobby' WHERE reg_no = '$reg_no'" );

	header("Location: ../edit_profile.php?msg=favoriteupdatesuccess");
	exit();
}

if (isset($_POST['sport_btn'])) {
	$sport_id = sanitizeString($_POST['sport_id']);

	$result_favorites = queryMysql("UPDATE profile SET sports_id = '$sport_id' WHERE reg_no = '$reg_no'" );

	header("Location: ../edit_profile.php?msg=sportsupdatesuccess");
	exit();
}

if (isset($_POST['religion_btn'])) {
	$religion_id = sanitizeString($_POST['religion_id']);

	queryMysql("UPDATE profile SET religion_id = '$religion_id' WHERE reg_no = '$reg_no'" );

	header("Location: ../edit_profile.php?msg=religionupdatedsuccess");
	exit();
}

if (isset($_POST['highschool_btn'])) {
	$highschool = sanitizeString($_POST['highschool']);
	$highschool_county = sanitizeString($_POST['highschool_county']);

	$result_hometown = queryMysql("UPDATE profile SET former_highschool = '$highschool', highschool_county = '$highschool_county' WHERE reg_no = '$reg_no'" );
	
	header("Location: ../edit_profile.php?msg=highschoolupdatedsuccess");
	exit();
}


?>