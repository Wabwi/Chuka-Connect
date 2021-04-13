<?php
$dbhost = 'localhost';
$dbusername = 'root';
$dbname = 'chuka_connect';
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

function profileImage( $row_used ) {
	if ( $row_used['profile_img']) {
		$profile_image = "img/user_profile/".$row_used['profile_img'];
	}else{
		$profile_image = "img/icons8_Ninja_Head_96px.png";
	}

	return $profile_image;
}

function messageError($msg, $err){
    // if(!empty($err)) echo "<div class='alert alert-warning alert-dismissible mb-10' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>
    //   <h5 class='alert-heading'>Error</h5>$err</div>";

    // if(!empty($msg)) echo "<div class='alert alert-success alert-dismissible mb-10' role='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>
    //   <h5 class='alert-heading'>Message</h5>$msg</div>";
    if(!empty($msg)) {
    	echo '<script>
				swal({
				  title: "Message",
				  text: "'.$msg.'",
				  icon: "success",
				  button: "OK",
				});
				</script>'; }
	if(!empty($err)) {
		echo '<script>
				swal({
				  title: "Warning",
				  text: "'.$err.'",
				  icon: "danger",
				  button: "OK",
				});
				</script>'; }

}

function connect_button($row_to_be_used) { ?>
	<div class="float-right">
		<?php
		$result_connection_status = queryMysql("SELECT * FROM connected WHERE (connection_from = '".$_SESSION['reg_no']."' AND connected_to = '".$row_to_be_used['reg_no']."') OR (connection_from = '".$row_to_be_used['reg_no']."' AND connected_to = '".$_SESSION['reg_no']."')");
		if($result_connection_status) $status = $result_connection_status -> fetch_array(MYSQLI_ASSOC);

		$no = $row_to_be_used['reg_no'];
		$name = $row_to_be_used['nick_name'];

		if($status['connection_from'] == $row_to_be_used['reg_no'] && $status['connection_status'] == 'Pending') { 
			echo '<button class="btn_beauty pl-2 pr-2 w-20 accept_connection_btn" type="button"  data-id="'.$status['id'].'" data-user_reg_no="'.$_SESSION['reg_no'].'" id="accept_connection_btn_'.$status['id'].'"><i class="fa fa-plus" aria-hidden="true"></i> Accept</button>';
		} else {
		?>
			<button id="connect_btn_<?php echo $name; ?>" <?php if($status['connection_status'] == 'Pending' || $status['connection_status'] == 'Reject' || $status['connection_status'] == 'Confirm') echo 'disabled'; ?>  type="button" class="btn_beauty pl-2 pr-2 w-20 connect_btn connect_btn_<?php echo $no; ?>" data-name="<?php echo $name; ?>" data-no="<?php echo $no; ?>" data-reg_no_from="<?php echo $_SESSION['reg_no']; ?>" >

				<?php
				if ($status['connection_status'] == 'Pending') {
					 echo 'Request Sent';
				}elseif ($status['connection_status'] == 'Reject') {
					echo 'Connection Ignored';
				}elseif ($status['connection_status'] == 'Confirm') {
					
				}else{
					echo 'Connect';
				}
				?>
				
			</button>
	<?php } ?>
		
	</div>
<?php	
}

$rows_c = '';
function pagination($table){
	$limit = 10;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $limit;

	$result_c = queryMysql("SELECT * FROM $table LIMIT $start, $limit");
	$rows_c = $result_c -> fetch_all(MYSQLI_ASSOC);
	define('ROWS_TABLE', $rows_c);

	$result_c = queryMysql("SELECT * FROM $table");
	$total = $result_c -> num_rows;
	$pages = ceil( $total / $limit );

	if($page > 1) $Previous = $page - 1; else $Previous = 1;
	$Next = $page + 1;
				
}


function paginationBtn($url, $prev, $nxt, $pages){

	echo'<div class="row">
			<div class="col-md-10">
				
				<nav aria-label="Page navigation">
					<ul class="pagination">
						<li class="page-item">
							<a class="page-link" href="'.$url.'?page='.$prev.'" aria-label="Previous">
								<span aria-hidden="true">&laquo; Prev</span>
							</a>
						</li>';
						
						for($i = 1; $i <= $pages; $i++){
							echo '<li class="page-item"><a class="page-link" href="'.$url.'?page='.$i.'">'.$i.'</a></li>';
						}
						
						echo '<li class="page-item">
							<a class="page-link" href="'.$url.'?page='.$nxt.'" aria-label="Next">
								<span aria-hidden="true">Next &raquo;</span>
							</a>
						</li>
						
					</ul>
					
				</nav>
			</div>
		</div><!-- div row -->';

}

function paginationBtnExt($url, $prev, $nxt, $pages){

	echo'<div class="row">
			<div class="col-md-10">
				
				<nav aria-label="Page navigation">
					<ul class="pagination">
						<li class="page-item">
							<a class="page-link" href="'.$url.'page='.$prev.'" aria-label="Previous">
								<span aria-hidden="true">&laquo; Prev</span>
							</a>
						</li>';
						
						for($i = 1; $i <= $pages; $i++){
							echo '<li class="page-item"><a class="page-link" href="'.$url.'page='.$i.'">'.$i.'</a></li>';
						}
						
						echo '<li class="page-item">
							<a class="page-link" href="'.$url.'page='.$nxt.'" aria-label="Next">
								<span aria-hidden="true">Next &raquo;</span>
							</a>
						</li>
						
					</ul>
					
				</nav>
			</div>
		</div><!-- div row -->';

}

// Email address verification, do not edit.
function isEmail($email) {
	return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
}

?>