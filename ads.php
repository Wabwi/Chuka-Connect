<?php
require_once 'includes/header.php';
if (!$loggedin) {
	echo "<script>location.replace('index.php');</script>";
}
?>

<div id="content">
	<?php require_once 'includes/upper_buttons.php' ?>
	<div class="p-md-5 py-3 px-1 pt-5">
		
		<div class="container">
			<h2>Adverts</h2>
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#phones">Phones </a></li><span class="pr-3">|</span>
				<li><a data-toggle="tab" href="#laptops"> Laptops</a></li><span class="pr-3">|</span>
				<li><a data-toggle="tab" href="#clothes"> Clothes</a></li><span class="pr-3">|</span>
				<li><a data-toggle="tab" href="#shoes">Shoes </a></li><span class="pr-3">|</span>
				<li><a data-toggle="tab" href="#house_staff">House Staff </a></li><span class="pr-3">|</span>
				<li><a data-toggle="tab" href="#services">Services</a></li><span class="pr-3">|</span>
			</ul>

			<div class="tab-content">

				<div id="phones" class="tab-pane in active mt-2">
					<h4>Phones</h4>
					<div class="row mt-1">
						<?php

						$result_phones = queryMysql("SELECT * FROM ads WHERE category_id = 1");
						$rows_phones = $result_phones -> fetch_all(MYSQLI_ASSOC);
						foreach($rows_phones as $row_phone):
							$ad_img = 'img/ads/'.$row_phone['ad_img'];

							$if_already_interested = queryMysql("SELECT * FROM interested_buyers WHERE product_id = '".$row_phone['ads_id']."' AND buyer_id = '".$_SESSION['reg_no']."'");
							//$buyer_reg_no = preg_replace('/[\/]+/', '_', $_SESSION['reg_no']);
							//echo "<script>alert($buyer_reg_no);</script>";
						?>
							<div class="card card_product float-left p-2 mt-3 shadow">
								<!-- <span onclick="" data-toggle='modal' data-target='#buyModal'> -->
								<img src="<?php echo $ad_img; ?>" class="w-100" height="110"  alt="">
								<div class="details pt-2">
									<?php echo $row_phone['ad_name']; ?>
									<span><?php echo $row_phone['description']; ?></span><br>
								</div>
								<div class="">
									<span class="text-primary"><b>Price:</b>Ksh.<?php echo $row_phone['price']; ?></span><br>
									<button type="button" <?php if($if_already_interested -> num_rows > 0) echo 'disabled'; ?> data-buyer_reg_no="<?php echo $_SESSION['reg_no'] ?>" data-ads_id="<?php echo $row_phone['ads_id']; ?>" class="btn btn_buy btn_buy_<?php echo $row_phone['ads_id']; ?> btn_beauty w-100"><?php if($if_already_interested -> num_rows > 0) echo 'Request Sent'; else echo 'Buy'; ?></button>
								</div>
							</div>
					<?php endforeach ?>
						
					</div> <!-- div row -->
				</div> <!-- div #phones -->

				<div id="laptops" class="tab-pane fade">
					<h4>Laptops</h4>
					<div class="row mt-1">
						<?php
						$result_laptop = queryMysql("SELECT * FROM ads WHERE category_id = 2");
						$rows_laptops = $result_laptop -> fetch_all(MYSQLI_ASSOC);
						if ($rows_laptops) {
							foreach($rows_laptops as $row_laptop):
								$ad_img = 'img/ads/'.$row_laptop['ad_img'];
								$if_already_interested = queryMysql("SELECT * FROM interested_buyers WHERE product_id = '".$row_laptop['ads_id']."' AND buyer_id = '".$_SESSION['reg_no']."'");
								?>
								<div class="card card_product float-left p-2 mt-3 shadow">
									<img src="<?php echo $ad_img; ?>" width="100" height="110" alt="<?php echo $row_laptop['ad_name']; ?>">
									<div class="details pt-1">
										<?php echo $row_laptop['ad_name']; ?>
										<span><?php echo $row_laptop['description']; ?></span><br>
										
									</div>

									<div class="">
										<span class="text-primary"><b>Price:</b>Ksh.<?php echo $row_laptop['price']; ?></span><br>
										<button type="button" <?php if($if_already_interested -> num_rows > 0) echo 'disabled'; ?> data-buyer_reg_no="<?php echo $_SESSION['reg_no'] ?>" data-ads_id="<?php echo $row_laptop['ads_id']; ?>" class="btn btn_buy btn_buy_<?php echo $row_laptop['ads_id']; ?> btn_beauty w-100"><?php if($if_already_interested -> num_rows > 0) echo 'Request Sent'; else echo 'Buy'; ?></button>
									</div>
								</div>
						<?php endforeach;
						}else {
							echo "<h6 class='col-md-6'>No products or service posted yet</h6>";;
						}
						?>
						
					</div> <!-- div row -->
				</div><!-- div laptops -->

				<div id="clothes" class="tab-pane fade">
						<h4>Clothes</h4>
				</div><!-- div clothes -->

				<div id="shoes" class="tab-pane fade">
						<h4>Shoes</h4>
				</div><!-- div shoes -->

				<div id="house_staff" class="tab-pane fade">
						<h4>House Staff</h4>
				</div><!-- div house_staff -->

				<div id="services" class="tab-pane fade">
						<h4>Services</h4>
				</div><!-- div services -->

			</div> <!-- div tab-content -->
			
			
		</div> <!-- div container -->
	</div> <!-- div padding -->

</div> <!-- div content -->



<?php
require_once 'includes/footer.php';
?>