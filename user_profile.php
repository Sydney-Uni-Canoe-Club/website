<?php include_once "./admin/config.php";

if (isset($_SESSION["usr_id"]) == false) {
	$_SESSION["redirect"] = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	unset($_SESSION['usr_id']);
	header('Location: ./admin/login.php');

}

?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>

	<script src="./admin/dist/js/jquery-3.7.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="Site keywords here">
	<meta name="description" content="">
	<meta name='copyright' content=''>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Title -->
	<title>Sydney Uni Canoe Club</title>

	<!-- Favicon -->
	<link rel="icon" href="img/favicon.png">

	<!-- Google Fonts -->
	<link
		href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
		rel="stylesheet">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Nice Select CSS -->
	<link rel="stylesheet" href="css/nice-select.css">
	<!-- Font Awesome CSS -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- icofont CSS -->
	<link rel="stylesheet" href="css/icofont.css">
	<!-- Slicknav -->
	<link rel="stylesheet" href="css/slicknav.min.css">
	<!-- Owl Carousel CSS -->
	<link rel="stylesheet" href="css/owl-carousel.css">
	<!-- Datepicker CSS -->
	<link rel="stylesheet" href="css/datepicker.css">
	<!-- Animate CSS -->
	<link rel="stylesheet" href="css/animate.min.css">
	<!-- Magnific Popup CSS -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Medipro CSS -->
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/responsive.css">
	<style>
		#calendar {
			max-width: 1100px;
			margin: 0 auto;
		}
	</style>

</head>

<body>

	<!-- Preloader -->
	<div class="preloader">
		<div class="loader">
			<div class="loader-outter"></div>
			<div class="loader-inner"></div>

			<div class="indicator">
				<svg width="16px" height="12px">
					<polyline id="back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
					<polyline id="front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline>
				</svg>
			</div>
		</div>
	</div>
	<!-- End Preloader -->



	<!-- Header Area -->
	<header class="header">

		<!-- End Topbar -->
		<!-- Header Inner -->
		<div class="header-inner">
			<div class="container">
				<div class="inner">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-12">
							<!-- Start Logo -->
							<div class="logo">
								<a href="index.php"><img src="img/logo2.png" alt="#"></a>Sydney Uni Canoe Club
							</div>

							<!-- End Logo -->
							<!-- Mobile Nav -->
							<div class="mobile-nav"></div>
							<!-- End Mobile Nav -->
						</div>
						<div class="col-lg-7 col-md-9 col-12">
						<!-- Main Menu -->
						<div class="main-menu">
								<nav class="navigation">
									<ul class="nav menu">
										<li><a href="#">Home </a></li>
										<li><a href="#trips">Trips <i class="icofont-rounded-down"></i></a>
											<ul class="dropdown">
												<li><a href="./past_trips.php">Past Trips</a></li>
											</ul></li>
										<li><a href="#join-club">Join CLub </a></li>
										<li><a href="#faqs">FAQs </a></li>
										
										
										<li><a href="#contact">Contact Us</a></li>
										<li ><a style="color:#ffc600" href="./admin/login.php" >
									<?php if(isset($_SESSION["usr_id"])==true)
									echo "My Account";
								else
								echo "Login";
																?>								
							
							</a></li>
									</ul>
								</nav>
							</div>
							<!--/ End Main Menu -->
						</div>
						<div class="col-lg-2 col-12">
							<div class="get-quote">
								<a href="./admin/login.php" class="btn login"> <?php if (isset($_SESSION["usr_id"]) == true)
									echo "My Account";
								else
									echo "Login";
								?> </a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
	</header>
	<!-- End Header Area -->


	<?php


	$sql = "SELECT  nombre, name_pre, avatar,telefono, correo,emergency_contact_name,emergency_contact_phone,fechalimite_suscripcion, comment FROM usuarios WHERE id=" . $_GET['id'];
	$result = mysqli_query($link, $sql);

	$row = mysqli_fetch_assoc($result);
	if ($row["name_pre"] != '') {

		$name = explode(" ", $row["nombre"]);


		$lastname = str_replace($name[0], "", $row["nombre"]);


		$row['nombre'] = $name[0] . ' "' . $row["name_pre"] . '"' . $lastname;
	}
	$comment=$row["comment"];

	?>


	<section class="portfolio section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						<img class="rounded-circle shadow"
							src="./admin/uploads/avatar/<?php echo $row["avatar"]; ?>"" alt=" #">
						<br> <br>
						<h2><?php echo $row["nombre"]; ?></h2>

						<?php if (isset($_SESSION["tipo_usuario"]) == true)
							if ($_SESSION["tipo_usuario"] != 2) { ?>
								Phone: <?php echo $row["telefono"]; ?><br>
								Email:
								<?php echo "<a href='mailto:" . $row['correo'] . "'>" . $row['correo'] . "</a>"; ?><br>

								Emergency contact name: <?php echo $row["emergency_contact_name"]; ?> <br>

								Emergency contact phone: <?php echo $row["emergency_contact_phone"]; ?><br>
								Payment expire date: <?php echo $row["fechalimite_suscripcion"]; ?><br>

							<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>



	<section class="why-choose section portfolio">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<!-- Start Choose Left -->
					<div class="choose-center">
						<h2>trips's history</h2>
						<table class="table table-hover">
							<thead>
							</thead>
							<tbody>
								<?php
								$sql = "SELECT *,(SELECT nombre  FROM eventos where id=eu.hevento) as name,
(SELECT  fecha_inicio FROM eventos where id=eu.hevento) as date_start FROM evento_usuario eu WHERE eu.husuario=" . $_GET['id'];
								$result = mysqli_query($link, $sql);

								while ($row = mysqli_fetch_assoc($result)) {

									?>
									<tr>
										<td> <br>

											<?php echo $row["date_start"] . " - " . $row["name"]; ?>

										</td>
										<td><br>
											<?php if ($row["type"] == 1)
												echo "Interested";
											else if ($row["type"] == 2)
												echo "Committed";
											else if ($row["type"] == 3)
												echo "Going";
											?>
										</td>
									</tr>
									<?php
								} ?>
							</tbody>
						</table>
					</div>
					<!-- End Choose Left -->
				</div>
				<?php
				if (isset($_SESSION["tipo_usuario"]) == true)
					if ($_SESSION["tipo_usuario"] != 2) { ?>
						<div class="col-md-6">

							<h2>Comments from the trips leaders</h2>
							<table class="table table-hover">
								<thead>
								</thead>
							
							
									<tr>
										
										<td><br>
											<?php echo $comment;
											?>
										</td>
									</tr>
								
							
								</tbody>
							</table>


						</div>
						<?php
					} ?>
			</div>
		</div>
	</section>
	</div>
	</div>
	</div>
	</div>
	<!-- Footer Area -->
	<footer id="footer" class="footer ">
		<!-- Footer Top -->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-12">
						<div class="single-footer">
							<h2>About Us</h2>
							<p>Lorem ipsum dolor sit am consectetur adipisicing elit do eiusmod tempor
								incididunt ut
								labore dolore magna.</p>
							<!-- Social -->
							<ul class="social">
								<li><a href="#"><i class="icofont-facebook"></i></a></li>
								<li><a href="#"><i class="icofont-google-plus"></i></a></li>
								<li><a href="#"><i class="icofont-twitter"></i></a></li>
								<li><a href="#"><i class="icofont-vimeo"></i></a></li>
								<li><a href="#"><i class="icofont-pinterest"></i></a></li>
							</ul>
							<!-- End Social -->
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<div class="single-footer f-link">
							<h2>Quick Links</h2>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-12">
									<ul>
										<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a>
										</li>
										<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>About
												Us</a>
										</li>
										<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Services</a>
										</li>
										<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Our
												Cases</a></li>
										<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Other
												Links</a></li>
									</ul>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
									<ul>
										<li><a href="#"><i class="fa fa-caret-right"
													aria-hidden="true"></i>Consuling</a></li>
										<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Finance</a>
										</li>
										<li><a href="#"><i class="fa fa-caret-right"
													aria-hidden="true"></i>Testimonials</a></li>
										<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>FAQ</a>
										</li>
										<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Contact
												Us</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<div class="single-footer">
							<h2>Open Hours</h2>
							<p>Lorem ipsum dolor sit ame consectetur adipisicing elit do eiusmod tempor
								incididunt.</p>
							<ul class="time-sidual">
								<li class="day">Monday - Fridayp <span>8.00-20.00</span></li>
								<li class="day">Saturday <span>9.00-18.30</span></li>
								<li class="day">Monday - Thusday <span>9.00-15.00</span></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<div class="single-footer">
							<h2>Newsletter</h2>
							<p>subscribe to our newsletter to get allour news in your inbox.. Lorem ipsum dolor
								sit
								amet, consectetur adipisicing elit,</p>
							<form action="add_newsletter.php" method="post" class="newsletter-inner">
								<input name="redirect" type="hidden"
									value="<?php echo (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
								<input name="email" placeholder="Email Address" class="common-input"
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your email address'"
									required="" type="email">

								<button type="submit" class="button"><i
										class="icofont icofont-paper-plane"></i></button>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Footer Top -->
		<!-- Copyright -->
		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-12">
						<div class="copyright-content">
							<p>© Copyright 2024 Sydney Uni Canoe Club</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Copyright -->
	</footer>
	<!--/ End Footer Area -->

	<!-- jquery Min JS -->
	<script>

		$(function () {
			console.log("readdssy!");
			<?php
			if (isset($_SESSION["newsletter"]) == true) {
				echo "alert('" . $_SESSION["newsletter"] . "');";
				unset($_SESSION["newsletter"]);

			}
			?>
			<?php
			if (isset($_SESSION["message"]) == true) {
				echo "alert('" . $_SESSION["message"] . "');";
				unset($_SESSION["message"]);

			}
			?>


			$(".expand-img").click(function () {
				Swal.fire({
					imageUrl: $(this).attr('src'),
					imageHeight: '80%',
					showCloseButton: true,
				});

			});

		});
	</script>
	<!-- jquery Migrate JS -->
	<script src="js/jquery-migrate-3.0.0.js"></script>
	<!-- jquery Ui JS -->
	<script src="js/jquery-ui.min.js"></script>
	<!-- Easing JS -->
	<script src="js/easing.js"></script>
	<!-- Color JS -->
	<script src="js/colors.js"></script>
	<!-- Popper JS -->
	<script src="js/popper.min.js"></script>
	<!-- Bootstrap Datepicker JS -->
	<script src="js/bootstrap-datepicker.js"></script>
	<!-- Jquery Nav JS -->
	<script src="js/jquery.nav.js"></script>
	<!-- Slicknav JS -->
	<script src="js/slicknav.min.js"></script>
	<!-- ScrollUp JS -->
	<script src="js/jquery.scrollUp.min.js"></script>
	<!-- Niceselect JS -->
	<script src="js/niceselect.js"></script>
	<!-- Tilt Jquery JS -->
	<script src="js/tilt.jquery.min.js"></script>
	<!-- Owl Carousel JS -->
	<script src="js/owl-carousel.js"></script>
	<!-- counterup JS -->
	<script src="js/jquery.counterup.min.js"></script>
	<!-- Steller JS -->
	<script src="js/steller.js"></script>
	<!-- Wow JS -->
	<script src="js/wow.min.js"></script>
	<!-- Magnific Popup JS -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<!-- Counter Up CDN JS -->
	<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Main JS -->
	<script src="js/main.js"></script>
</body>

</html>