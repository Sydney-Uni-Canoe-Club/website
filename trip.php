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

										<li><a href="./index.php">Home </a></li>
										<li><a href="./index.php#trips">Trips <i class="icofont-rounded-down"></i></a>
											<ul class="dropdown">
												<li><a href="./past_trips.php">Past Trips</a></li>
											</ul>
										</li>

										<li><a href="./index.php#join-club">Join CLub </a></li>

										<li><a href="faqs.php">FAQs <i class="icofont-rounded-down"></i></a>
											<ul class="dropdown">
												<li><a href="blog-single.html">Blog Details</a></li>
											</ul>
										</li>
										<li><a href="./index.php#contact">Contact Us</a></li>
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
	$sql = "SELECT *, (select name from events_category ec where ec.id=hcategory) as category  FROM eventos WHERE id=" . $_GET['id'];
	$result = mysqli_query($link, $sql);

	$row = mysqli_fetch_assoc($result);
	$hcategory = $row["hcategory"];
	$date_start = $row["fecha_inicio"];
	$trip_leader = $row["husuario"];
	?>


	<!-- Start Why choose -->
	<section class="why-choose section portfolio">
		<div class="container">

			<div class="row">
				<div class="col-lg-12 col-12">
					<!-- Start Choose Left -->
					<div class="choose-left">


						<h3><?php echo $row["nombre"]; ?></h3>

						<h4>Date: <?php echo $row["fecha_inicio"]; ?></h4> <br>
						<h4>Hour: <?php echo $row["hour"]; ?></h4> <br>
						<?php if ($row["fecha_fin"] != '0000-00-00')
							echo "<h4>Date end: " . $row['fecha_fin'] . "</h4>";
						?>
						<h4>Hour End: <?php echo $row["hour_end"]; ?></h4> <br>
						<h4>Location: <?php echo $row["location"]; ?></h4> <br>
						<p><?php echo $row["descripcion"]; ?> </p>


					</div>
					<!-- End Choose Left -->
				</div>

			</div>
		</div>
	</section>
	<!--/ End Why choose -->
	<!-- Start portfolio -->
	<section class="portfolio section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						<h2><?php echo $row["category"]; ?></h2>

					</div>
				</div>
			</div>
		</div>

		<?php //SELECT id, hevent, img FROM events_galery WHERE 1 ?>
		<div class="container-fluid">
			<div class="row">
				<div class="col-ls-12 col-12">
					<div allign="center" class="owl-carousel portfolio-slider">

						<?php
						$sql = "SELECT img FROM events_galery WHERE hevent=" . $_GET['id'];
						$result = mysqli_query($link, $sql);
						$row = mysqli_fetch_assoc($result);
						if ($row == null) {
							$sql = "SELECT img FROM events_category_img WHERE type=2 and hcategory=" . $hcategory;
							$result = mysqli_query($link, $sql);

						} else
							mysqli_data_seek($result, 0);

						while ($row = mysqli_fetch_assoc($result)) {
							?>
							<div class="single-pf">
								<img src="./admin/uploads/trips/<?php echo $row["img"]; ?>" alt="#">

							</div>

							<?php
						}
						?>

					</div>
				</div>
			</div>
		</div>
		<br>


	</section>
	<!--/ End portfolio -->


	<?php
	if (isset($_SESSION['usr_id']) == TRUE) {



		?>


		<section class="why-choose section portfolio">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<!-- Start Choose Left -->
						<div class="choose-center">
							<h2>Users</h2>
							<table class="table table-hover">
								<thead>
								</thead>
								<tbody>
									<?php
									$sql = "SELECT husuario,
(SELECT  avatar FROM  usuarios u WHERE u.id=husuario) as avatar,
(SELECT  nombre FROM  usuarios u WHERE u.id=husuario) as nombre,
(SELECT  name_pre FROM  usuarios u WHERE u.id=husuario) as name_pre, type
FROM evento_usuario WHERE hevento=" . $_GET['id'];
									$result = mysqli_query($link, $sql);
									$subs = 0;
									while ($row = mysqli_fetch_assoc($result)) {
										if ($row["husuario"] == $_SESSION['usr_id'])
											$subs = 1;
										?>
										<tr>
											<td> <img class="rounded-circle shadow"
													src="./admin/uploads/avatar/<?php echo $row["avatar"]; ?>"" alt=" #">
												<?php
												if ($row["name_pre"] != '') {

													$name = explode(" ", $row["nombre"]);


													$lastname = str_replace($name[0], "", $row["nombre"]);


													$row['nombre'] = $name[0] . ' "' . $row["name_pre"] . '"' . $lastname;

												}


												?>
												<a href="./user_profile.php?id=<?php echo $row['husuario']; ?>" role="button"
													aria-expanded="false" aria-controls="collapseExample">
													<?php echo $row["nombre"]; ?>
												</a>
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
					<div class="col-md-6">
						<h2>Trip Leader</h2>

						<?php $sql = "SELECT  avatar, nombre, correo FROM usuarios WHERE id=$trip_leader";

						$result = mysqli_query($link, $sql);

						$user_trip = mysqli_fetch_assoc($result);

						?>
						<table class="table table-hover">
							<thead>
								<tr>
									<td>
									</td>

								</tr>
							</thead>


							<tbody>

								<tr>
									<td> <img class="rounded-circle shadow"
											src="./admin/uploads/avatar/<?php echo $user_trip["avatar"]; ?>" alt="#">
										<br> <br>
										<h5>Name: <?php echo $user_trip["nombre"]; ?></h5>
										<br>
										<?php //if ($subs != 0)
											{ ?>

											<h5>Email: <?php echo $user_trip["correo"]; ?></h5>

										<?php } ?>
									</td>

								</tr>

							</tbody>
						</table>




					</div>

				</div>
			</div>
		</section>


		<?php
	}
	?>
	<br>
	<section class="why-choose section portfolio">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						<?php if (isset($_SESSION['usr_id']) == true) {

							$interval = date_diff(date_create(date('Y-m-d')), date_create($date_start));
							$days = $interval->format('%R%a');

							if ($days >= 0) {
								if ($subs == 0) {


									?>




									<a href="./admin/usr_event.php?id=<?php echo $_GET['id']; ?>&type=1" class="btn">I'm
										interested'</a>


									<a href="./admin/usr_event.php?id=<?php echo $_GET['id']; ?>&type=2" class="btn">Want to
										go</a>
								<?php } else { ?>

									<a href="./admin/usr_event_cancel.php?id=<?php echo $_GET['id']; ?>" class="btn">Bail from
										trip</a>
								<?php }
								?>
							</div>
						</div>
					</div>
				</div>
			</section>

		<?php } else {


								//check comments
								$sql = "select * from events_blog where husuario=" . $_SESSION["usr_id"] . " and hevent='" . $_GET['id'] . "'";

								$result = mysqli_query($link, $sql);
								$fila_comment = mysqli_fetch_assoc($result);

								//check status going type=3
								$sql = "select * from evento_usuario where husuario=" . $_SESSION["usr_id"] . " and hevento='" . $_GET['id'] . "' and type=3";

								$result = mysqli_query($link, $sql);
								$user_trip_status = mysqli_fetch_assoc($result);


								if ($fila_comment == null && $user_trip_status != null) {
									?>



				<section class="portfolio section">
					<div class="container">
						<div class="row">
							<div class="col-lg-12">
								<div class="section-title">
									<h2>Leave your comment</h2>
									<form action="./admin/event_comment2.php" enctype="multipart/form-data" method="post">

										<input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>">
										<div class="row">
											<div class="col-lg-12">
												<textarea required required id="message" class="form-control" placeholder="Message"
													name="message" rows="6"></textarea>
											</div>

										</div>
										<div class="row">
											<div class="col-lg-6" align="justify"><br>
												Image:
												<input type="file" required class="form-control" id="img_comment" name="img_comment"
													accept="image/png, image/jpeg" />
											</div>

										</div>
										<br>
										<button type="submit" class="btn">Submit</button>

									</form>


								</div>
							</div>
						</div>
					</div>
				</section>





			<?php } ?>
			<section class="portfolio section">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="section-title">
								<h2>Comments Section</h2>


								<?php

								$sql = "SELECT eb.*, u.nombre, u.correo, u.avatar FROM events_blog eb 
                										INNER JOIN usuarios u on u.id=eb.husuario where eb.status=2 and eb.hevent=" . $_GET["id"];
								$result = mysqli_query($link, $sql);
								$comments = mysqli_fetch_assoc($result);
								if ($comments == null) {
									?>
									<br><br><br>
									<h2>No Comments</h2>
									<?php
								} else
									mysqli_data_seek($result, 0);
								?>
							</div>
							<div class="section-nody">
								<?php
								while ($comments = mysqli_fetch_assoc($result)) {

									?>
									<div class="single-pf">
										<img class="expand-img rounded" width="210px"
											src="./admin/uploads/comments/<?php echo $comments["img"]; ?>">
										by <?php echo $comments["nombre"]; ?> | date:
										<?php echo date("F j, Y", strtotime($comments["date"])); ?><br><br>

										<?php echo $comments["comment"]; ?><br><br><br>
									</div>

									<?php


									?>


								<?php } ?>
							</div>





							</tbody>
							</table>


						</div>
					</div>
				</div>



			</section>
			<?php
							}

						} else {
							$_SESSION["redirect"] = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

							?>
		<a href="./admin/login.php" class="btn">Login</a>

	<?php } ?>

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