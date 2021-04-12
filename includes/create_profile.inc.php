<?php
require_once 'functions.php';
session_start();

if (isset($_SESSION['reg_no'])) {
	$reg_no = $_SESSION['reg_no'];


	if (isset($_POST['sport_btn'])) {
		$sport_id = sanitizeString($_POST['sport_id']);

		$result_favorites = queryMysql("UPDATE profile SET sports_id = '$sport_id' WHERE reg_no = '$reg_no'" );

		header("Location: ../profile.php?msg=profilecreationcomplete");
		exit();
	}


	if (isset($_POST['religion_btn'])) {
		$religion_id = sanitizeString($_POST['religion_id']);

		queryMysql("UPDATE profile SET religion_id = '$religion_id' WHERE reg_no = '$reg_no'" );

		header("Location: ../create_profile.php?sports");
		exit();
	}

	if (isset($_POST['favorites_btn'])) {
		$favorite_food = sanitizeString($_POST['favorite_food']);
		$favorite_song = sanitizeString($_POST['favorite_song']);
		$favorite_place = sanitizeString($_POST['favorite_place']);
		$favorite_lecturer = sanitizeString($_POST['favorite_lecturer']);
		$hobby = sanitizeString($_POST['hobby']);

		$result_favorites = queryMysql("UPDATE profile SET favorite_food = '$favorite_food', favorite_song = '$favorite_song', favorite_place = '$favorite_place', favorite_lecturer = '$favorite_lecturer', hobby = '$hobby' WHERE reg_no = '$reg_no'" );

		header("Location: ../create_profile.php?religion");
		exit();
	}

	if (isset($_POST['relationship_status_btn'])) {

		$relationship_status = sanitizeString($_POST['relationship_status']);

		$result_relationship_status = queryMysql("UPDATE profile SET relationship_status_id = '$relationship_status' WHERE reg_no = '$reg_no'" );
		
		header("Location: ../create_profile.php?favorites");
		exit();
	}

	if (isset($_POST['highschool_btn'])) {
		$highschool = sanitizeString($_POST['highschool']);
		$highschool_county = sanitizeString($_POST['highschool_county']);

		$result_hometown = queryMysql("UPDATE profile SET former_highschool = '$highschool', highschool_county = '$highschool_county' WHERE reg_no = '$reg_no'" );
		
		header("Location: ../create_profile.php?relationship_status");
		exit();
	}

	if (isset($_POST['hometown_btn'])) {
		$county = sanitizeString($_POST['county']);
		$hometown = sanitizeString($_POST['hometown']);

		$result_hometown = queryMysql("UPDATE profile SET county_id = '$county', hometown = '$hometown' WHERE reg_no = '$reg_no'" );
		
		header("Location: ../create_profile.php?highschool");
		exit();
	}


	if (isset($_POST['school_details_btn'])) {
		$campus = sanitizeString($_POST['campus']);
		$course = sanitizeString($_POST['course']);
		$year_of_study = sanitizeString($_POST['year_of_study']);
		$hostel = sanitizeString($_POST['hostel']);


		$result_school_details = queryMysql("UPDATE profile SET campus_id = '$campus', course_code = '$course', year_of_study = '$year_of_study', hostel = '$hostel'  WHERE reg_no = '$reg_no'" );

		header("Location: ../create_profile.php?hometown");
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
		
		header("Location: ../create_profile.php?school_details");
		exit();
	}



	if (isset($_POST['create_profile_btn'])) {
		if (!empty($_POST['first_name']) && !empty($_POST['date_of_birth']) && !empty($_POST['gender'])) {
			$first_name = sanitizeString($_POST['first_name']);
			$middle_name = sanitizeString($_POST['middle_name']);
			$last_name = sanitizeString($_POST['last_name']);
			$nick_name = sanitizeString($_POST['nick_name']);
			$date_of_birth = sanitizeString($_POST['date_of_birth']);
			$gender = sanitizeString($_POST['gender']);


			//File upload path
			$targetDir = "../img/user_profile/";
			$file_name = basename( $_FILES['image']['name'] );
			$target_file_path = $targetDir. $file_name;
			$file_type = pathinfo( $target_file_path, PATHINFO_EXTENSION );
			//$date_registered = date("Y-M-D h:i:s");
			//$date_registered = $date -> getTimestamp();

			if ( !empty( $_FILES['image']['name'])) {
				//Allow certain file formats
				$allow_types = array( 'jpg', 'png', 'jpeg', 'gif', 'pdf' );
				if( in_array( $file_type, $allow_types) ) {
					//Upload file to sever

					if ( move_uploaded_file($_FILES['image']['tmp_name'] , $target_file_path) ) {


						// list($w, $h) = getimagesize($target_file_path);

						// $max = 100;
						// $tw = $w;
						// $th = $h;

						// if( $w > $h && $max < $w) {
						// 	$th = $max / $w * $h;
						// 	$tw = $max;

						// }elseif ($h > $w && $max < $h) {
						// 	$tw = $max / $h * $w;
						// 	$th = $max;

						// }elseif ($max < $w ) {
						// 	$tw = $th = $max;
						// }

						// $tmp = imagecreatetruecolor($tw, $th);
						// imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
						// imageconvolution($tmp, array(array(-1, -1, -1), array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
						// imagejpeg( $tmp, $target_file_path );
						
						//Insert img file name into database
						$result = queryMysql("INSERT INTO `profile`(`reg_no`, `profile_Img`, `first_name`, `middle_name`, `last_name`, `nick_name`, `date_of_birth`, `gender`) VALUES('$reg_no', '".$file_name."', '$first_name', '$middle_name', '$last_name', '$nick_name', '$date_of_birth', '$gender')");

						if ( $result ) {
							echo "<script>alert( 'profile added' );</script>";
							
							
						} else {
							header( "location: ../create_profile.php?error=fileuploadfailedsql" );
							exit();
						}
					} else {
						header( "location: ../create_profile.php?error=fileuploadfailed" );
						exit();
					} 

				} else {
					header( "location: ../create_profile.php?error=wrongfileformat" );
					exit();
				}

			} else {
				header("Location: ../create_profile.php?error=imgempty");
				exit();
			}



			// if( isset( $_FILES['image']['name']) ) {
			// 	$saveto = "image/$first_name.jpg";
			// 	move_uploaded_file($_FILES['image']['tmp_name'], $saveto );
			// 	$typeok = TRUE;

			// 	switch ($_FILES['image']['type']) {
			// 		case 'image/gif':
			// 			$src = imagecreatefromgif($saveto);
			// 			break;

			// 		case 'image/jpeg':
			// 		case 'image/pjpeg':
			// 			$src = imagecreatefromjpeg($saveto);
			// 			break;

			// 		case 'image/png':
			// 			$src = imagecreatefrompng($saveto);
			// 			break;		
					
			// 		default:
			// 			$typeok = FALSE;
			// 			break;
			// 	}

			// 	if( $typeok ) {
			// 		list($w, $h) = getimagesize($saveto);

			// 		$max = 100;
			// 		$tw = $w;
			// 		$th = $h;

			// 		if( $w > $h && $max < $w) {
			// 			$th = $max / $w * $h;
			// 			$tw = $max;

			// 		}elseif ($h > $w && $max < $h) {
			// 			$tw = $max / $h * $w;
			// 			$th = $max;

			// 		}elseif ($max < $w ) {
			// 			$tw = $th = $max;
			// 		}

			// 		$tmp = imagecreatetruecolor($tw, $th);
			// 		imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
			// 		imageconvolution($tmp, array(array(-1, -1, -1), array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
			// 		imagejpeg( $tmp, $saveto );
			// 		imagedestroy($tmp );
			// 		imagedestroy($src );	

					
			// 	}
			// }//inserting pic
			header( "Location: ../create_profile.php?contacts&msg=personal_info_success");
			exit();

		}else{
			header("Location: ../create_profile.php?error=emptyfields");
			exit();
		}
	}
}else{
	header( "Location: ../index.php?error=notloggedin");
			exit();
}
?> 