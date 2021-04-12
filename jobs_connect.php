<?php
require_once 'includes/header.php';

if( $loggedin ){
?>

<div id="content">
	<?php require_once 'includes/upper_buttons.php'; ?>
	<div class="p-4 p-md-5 pt-5">
		
	</div>
</div>

<?php
} else{
	header( "Location: index.php?error=notloggedin");
	exit();
}

require_once 'includes/footer.php';
?>