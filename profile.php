<?php
require_once 'includes/header.php';
?>
<div id="content" class="p-4 p-md-5 pt-5">
	<div class="container">
		<?php
		$reg_no = $_SESSION['reg_no'];

		//confirming if user has a profile
		$result_profile = queryMysql("SELECT * FROM profile WHERE reg_no = '$reg_no'");
		if ( $result_profile -> num_rows ) {
			$row = $result_profile -> fetch_array(MYSQLI_ASSOC);
		?>
		<div class="jumbotron">
			<h1><?php echo $row['nick_name']; ?></h1>
		</div>

		<?php
		}else {
			header( 'Location: create_profile.php');
			exit();
		}

		?>	
	</div>
</div>




<?php
require_once 'includes/footer.php';
?> 