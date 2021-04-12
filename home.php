<?php
require_once 'includes/header.php';
$msg = $err = '';
if (isset($_GET['login'])) {
	if( $_GET['login'] == 'success'){
		$msg = 'You have Logged in Successfully!';
		
	}
}

if (isset($_SESSION['reg_no'])) {
	if (!$row['nick_name']) {
		echo "<script>location.replace('create_profile.php');</script>";
	}
	
}
?>
<div id="content">
	<?php require_once 'includes/upper_buttons.php' ?>

	<div class="p-md-0 pt-5 pl-0 pr-0 ml-0 mr-0">
		<?php messageError($msg, $err); ?>
	<h2 class="text-center">Events</h2>
	<div class="row p-0 m-0">
		<div class="col-lg-12 p-0 m-0">
			<section>
				<div id="carouselFull" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
						<li data-target="#carouselIndicators" data-slide-to="1"></li>
						<li data-target="#carouselIndicators" data-slide-to="2"></li>
						<li data-target="#carouselIndicators" data-slide-to="3"></li>
						<li data-target="#carouselIndicators" data-slide-to="4"></li>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner">
						
						<div class="carousel-item active">
							<img class="d-block img-fluid" src="img/events_posters/cheers.jpg" >					
						</div> <!--slider 0 -->


						<div class="carousel-item">
							<img class="d-block img-fluid" src="img/events_posters/concert.jpg">
						</div> <!--slider 1 -->


						<div class="carousel-item">
							<img class="d-block img-fluid" src="img/events_posters/audience.jpg">
						</div> <!-- slider 2 -->


						<div class="carousel-item">
							<img class="d-block img-fluid" src="img/events_posters/audience.jpg">
						</div> <!-- slider 3 -->


						<div class="carousel-item">
							<img class="d-block img-fluid" src="img/events_posters/cheers.jpg">
						</div> <!-- slider 4 -->
					</div> <!-- div carousel-inner -->

					<a href="#carouselFull" class="carousel-control-prev" role= "button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden = "true"></span>
					<span class="sr-only">Previous</span></a>
						

					<a href="#carouselFull" class="carousel-control-next" role="button" data-slide="next"><span class="carousel-control-next-icon"></span>
					<span class="sr-only">Next</span></a>
					
				</div>
			</section>

		</div>
	</div> <!-- div_row -->
    </div>

	<div class="container mt-5 mb-4">
		
		<h3 class="text-center">Products & Services</h3>

		<!-- Slider -->
		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<div class="row">
						<div class="col-3"><img class="d-block w-100" src="img/ads/dell-xps-15-01.jpg" alt=""></div>
						<div class="col-3"><img class="d-block w-100" src="img/ads/inspiron-24-5000-aio-3.jpg" alt=""></div>
						<div class="col-3"><img class="d-block w-100" src="img/ads/Vive_featured-796x417.jpg" alt=""></div>
						<div class="col-3"><img class="d-block w-100" src="img/ads/14-01-dell-xps-15.jpg" alt=""></div>
					</div>
				</div> <!-- div_carousel-item -->

				<div class="carousel-item">
					<div class="row">
						<div class="col-3"><img class="d-block w-100" src="img/ads/dell-xps-15-01.jpg" alt=""></div>
						<div class="col-3"><img class="d-block w-100" src="img/ads/inspiron-24-5000-aio-3.jpg" alt=""></div>
						<div class="col-3"><img class="d-block w-100" src="img/ads/Vive_featured-796x417.jpg" alt=""></div>
						<div class="col-3"><img class="d-block w-100" src="img/ads/14-01-dell-xps-15.jpg" alt=""></div>
					</div>
				</div> <!-- div_carousel-item -->
				
			</div> <!-- div_carousel-inner -->

			<a href="#carouselExampleControls" class="carousel-control-prev" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden = "true"></span>
				<span class="sr-only">Previous</span>
			</a>

			<a href="#carouselExampleControls" class="carousel-control-next" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden = "true"></span>
				<span class="sr-only">Next</span>
			</a>
			
		</div> <!-- div_carouselExampleControls -->
	</div><!-- div container -->


	<div class="container university_life">
		<h3 class="text-center">University Life</h3>
		<div class="row">
			
			<div class="card p-3 m-3 col-md-5 shadow social">
				<span>
					<h4 class="h2">Social Connect</h4>
					<p>Meet a New or an Old Friend</p>
				</span>
			</div>
			
			<div class="card p-3 m-3 col-md-5 shadow love">
				<span>
					<h4>Love Connect</h4>
					<p>Here is your perfect match!</p>
				</span>
		
			</div>
		</div>

		<div class="row">

			<div class="card p-3 m-3 col-md-5 shadow sports">
				<span>
					<h4>Sports Connect</h4>
					<p>Best way to become physically fit.</p>
				</span>
		
	        </div>

	        <div class="card p-3 m-3 col-md-5 shadow academics">
	        	<span>
	        		<h4>Projects Connect</h4>
	        		<p>Share your projects with the World.</p>
	        	</span>
		
			</div>
			
		</div>
		
	</div> <!-- div container -->



</div> <!-- div_content -->




<?php
require_once 'includes/footer.php';
?>