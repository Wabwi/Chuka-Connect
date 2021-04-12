<?php
require_once 'includes/header.php';

if (isset($_POST['btn_post_ad'])) {
	$msg = $err = '';
	if (!empty($_POST['type']) && !empty($_POST['ad_name']) && !empty($_POST['price'])) {
		$ad_name = sanitizeString($_POST['ad_name']);
		$description = sanitizeString($_POST['description']);
		$price = sanitizeString($_POST['price']);
		$status = sanitizeString($_POST['status']);
		$type = sanitizeString($_POST['type']);
		$category_id = sanitizeString($_POST['ad_category']);


		//File upload path
		$targetDir = "img/ads/";
		$file_name = basename( $_FILES['ad_img']['name'] );
		$target_file_path = $targetDir. $file_name;
		$file_type = pathinfo( $target_file_path, PATHINFO_EXTENSION );

		if ( !empty( $_FILES['ad_img']['name'])) {
			//Allow certain file formats
			$allow_types = array( 'jpg', 'png', 'jpeg', 'gif', 'pdf' );
			if( in_array( $file_type, $allow_types) ) {
				//Upload file to sever

				if ( move_uploaded_file($_FILES['ad_img']['tmp_name'] , $target_file_path) ) {
					
					//Insert img file name into database
					$result = queryMysql("INSERT INTO `ads`(`ad_name`, `ad_img`, `description`, `price`, `status`, `type`, `category_id`, `seller_id`) VALUES ('$ad_name','$file_name','$description','$price','$status','$type','$category_id','".$_SESSION['reg_no']."')");

					if ( $result ) {
						echo "<script>alert( 'Ad posted Successful' );</script>";
						
						
					} else {
						header( "location: advertise.php?error=fileuploadfailedsql" );
						exit();
					}
				} else {
					header( "location: advertise.php?error=fileuploadfailed" );
					exit();
				} 

			} else {
				header( "location: advertise.php?error=wrongfileformat" );
				exit();
			}
		}
	}
}
?>

<div id="content">
	<?php require_once 'includes/upper_buttons.php'; ?>

	<div class="p-4 p-md-5 pt-5">
		<?php

		?>
		
		<div class="row">
			<div class="col-lg-8 p-3">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#post_ads">Post Ads</a></li><span class="pr-3 text-danger">|</span>
					<li><a data-toggle="tab" href="#potential_buyers">Buyers</a></li><span class="pr-3 text-primary">|</span>
					<li><a data-toggle="tab" href="#ads_posted">My Ads</a></li><span class="pr-3">|</span>
				</ul>

				<div class="tab-content pt-4">
					<div id="post_ads" class="tab-pane in active">
						<h3>Advertise Product/Service</h3>
						<form action="" method="POST" enctype="multipart/form-data">
							<div class="form-group mb-5">
								Type:<br>
								<input type="radio" name="type" value="Product" required="required">
								<label for="product">Product</label><br>

								<input type="radio" name="type" value="Service" required="required">
								<label for="service">Service</label>		
							</div>

							<div class="form-group">
								<label for="ad_name">Product/Serivice Name:</label>
								<input type="text" name="ad_name" class="form-control border border-primary border-top-0 border-right-0 border-left-0" required>
							</div>

							<div class="form-group">
								<label for="category_id">Choose Category</label>
								<?php
								$result_category = queryMysql("SELECT * FROM ad_category");
								$rows_category = $result_category -> fetch_all(MYSQLI_ASSOC);

								?>
								<select name="ad_category" class="form-control border border-primary border-top-0 border-right-0 border-left-0" required>
									<option selected="selected">--Select Category--</option>
									<?php
									foreach ($rows_category as $row_category): ?>
										<option value="<?php echo $row_category['category_id'] ?>"><?php echo $row_category['category_name'] ?></option>
									
									<?php endforeach ?>
									
								</select>
							</div>

							<div class="form-group">
								<label for="ad_img">Product Image</label>
								<input type="file" name="ad_img" class="form-control border border-primary border-top-0 border-right-0 border-left-0" required>
							</div>

							<div class="form-group">
								<label for="price">Price</label>
								<input type="text" name="price" class="form-control border border-primary border-top-0 border-right-0 border-left-0" required>
							</div>

							<div class="form-group">
								<label for="description">Description</label>
								<input type="text" name="description" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
							</div>

							<div class="form-group">
								<label for="status">Status</label>
								<select name="status" class="form-control border border-primary border-top-0 border-right-0 border-left-0">
									<option selected="selected">--Select Status--</option>
									<option value="New">New</option>
									<option value="Second-Hand">Second-hand</option>
								</select>
							</div>

							<div class="form-group pt-5">
								<input type="submit" class="form-control btn_beauty" value="POST" name="btn_post_ad">
							</div>


						</form>
					</div><!-- div post_ad -->

					<div id="potential_buyers" class="tab-pane fade">
						<h3>Potential Buyers</h3>
						<table class="table table-responsive">
							<tr>
								<th>Product</th>
								<th>Interested Buyer</th>
								<th>Date</th>
							</tr>
						<?php
						$result_interested_buyers = queryMysql("SELECT * FROM interested_buyers WHERE product_id IN(SELECT ads_id FROM ads WHERE seller_id = '".$_SESSION['reg_no']."')");
						if ($result_interested_buyers -> num_rows > 0) {
							$rows_interested_buyers = $result_interested_buyers -> fetch_all(MYSQLI_ASSOC);
							foreach ($rows_interested_buyers as $row_buyer ):
								//get potential buyer profile details
								$result_profile_buyer = queryMysql("SELECT * FROM profile WHERE reg_no = '".$row_buyer['buyer_id']."'");
								$row_profile_buyer = $result_profile_buyer -> fetch_array(MYSQLI_ASSOC);

								//get product details
								$result_ad = queryMysql("SELECT * FROM ads WHERE ads_id = '".$row_buyer['product_id']."'");
								$row_ad = $result_ad -> fetch_array(MYSQLI_ASSOC);
								$ad_img = 'img/ads/'.$row_ad['ad_img'];
								?>
								
								<tr>
									<td><img src="<?php echo $ad_img; ?>" width="50" alt="<?php echo $row_ad['ad_name']; ?>"><?php echo '<br>'.$row_ad['ad_name']; ?></td>
									<td><?php echo $row_profile_buyer['first_name'].'<br>'.$row_profile_buyer['reg_no']; ?></td>
									<td><?php echo $row_buyer['date_interested'] ?></td>
								</tr>
							<?php endforeach;
							
						}
						?>
						</table>
					</div><!-- div potential_buyers -->

					<div id="ads_posted" class="tab-pane fade">
						<h3>My Ads</h3>
						<table class="table table-responsive">
							<tr>
								<th>Product</th>
								<th>Description</th>
								<th>price</th>
								<th>Date Posted</th>
								<th></th>
							</tr>
						
						<?php
						$result_ads = queryMysql("SELECT * FROM ads WHERE seller_id = '".$_SESSION['reg_no']."'");
						if ($result_ads -> num_rows > 0) {
							$rows_ads = $result_ads -> fetch_all(MYSQLI_ASSOC);
							foreach ($rows_ads as $row_ads) {
								$ad_image = 'img/ads/'.$row_ads['ad_img'];
							?>
								<tr>
									<td><img src="<?php echo $ad_image; ?>" width="100" alt=""><br><?php echo $row_ads['ad_name']; ?></td>
									<td><?php echo $row_ads['description']; ?></td>
									<td><?php echo $row_ads['price']; ?></td>
									<td><?php echo $row_ads['date_posted']; ?></td>
									<td><button type="button" class="btn btn_beauty">Edit</button></td>
								</tr>
							<?php
							}
						}
						?>
						</table> 
					</div><!-- div ads_posted -->

				</div><!-- div tab-content -->

				
				
			</div>
			
		</div><!-- div row -->
	</div>
</div>			



<?php
require_once 'includes/footer.php';
?>