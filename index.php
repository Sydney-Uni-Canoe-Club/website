<?php include_once "./admin/config.php";
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="./admin/dist/js/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src='./calendar/index.global.js'></script>

	<script>

		document.addEventListener('DOMContentLoaded', function () {
			var calendarEl = document.getElementById('calendar');

			var inicial = '';
			if (window.matchMedia("(max-width: 100%)").matches) {
				inicial = 'timeGridDay'

				//  document.write("This is a mobile device."); 
			} else {

				// The viewport is at least 768 pixels wide 
				inicial = 'dayGridMonth'

			}


			var calendar = new FullCalendar.Calendar(calendarEl, {
				headerToolbar: {
					// left: 'prev,next today',
					left: 'prev,next today title',
					// center: 'title',
					right: 'dayGridMonth,timeGridWeek,timeGridDay'
				},
				height: 'auto',
				width: '100%',
				initialView: inicial,
				aspectRatio: 2.5,
				initialDate: '<?php echo date('Y-m-d');?>',

  eventClick: function(info) {
	var text= info.event.id;
		 myArray = text.split(";");
		 console.log(myArray);
  $.ajax({dataType: "JSON",
                url: "./gallery_trip.php",
                type: 'POST',
                data: { id: myArray[0] }
            }).done(function (result) {
				console.log(result);
			//	myArray[3]=myArray[3].substring(0, 50);
				//myArray[3]=	$(myArray[3]).text()
<?php if (isset($_SESSION["usr_id"]) == true){?>
if(myArray[2]!=0)
{
	var html_txt=`<p align="justify">Start Date: `+ myArray[1]+` <br> Hour:`+info.event.extendedProps.hour+` <br> End Date: `+ myArray[2]+`<br> Hour to finish: `+ result.hour_end+`<br>	<br>   </p>`;


}else {
	var html_txt=`<p align="justify">Start Date: `+ myArray[1]+` <br> Hour:`+info.event.extendedProps.hour+`<br> Hour to finish: `+ result.hour_end+`<br>	  </p>`;



}
<?php
}else{
	?>
var html_txt='';
<?php
}?>
var boton=`<a href="./trip.php?id=`+myArray[0]+`" class="btn login">more info</a>`;
text=info.event.title;
title_array = text.split("/");
	
				Swal.fire({
					showConfirmButton: false,
					title: title_array[1],
					imageUrl: './admin/uploads/trips/'+result.img,
					html: html_txt+'<br>'+result.descrip+'<br><br>'+boton,
					imageHeight: '80%',
					showCloseButton: true,
				});
											});          
  },
				events: [
					<?php
					$sql = "SELECT * FROM eventos WHERE status=1";
					$result = mysqli_query($link, $sql);

					while ($fila = mysqli_fetch_assoc($result)) {
					$fila["descripcion"]=strip_tags($fila["descripcion"], '');
					
						if ($fila["fecha_fin"] != '0000-00-00') {
							$fila["hour"]=	date("g:i A", strtotime($fila["hour"]));	
							echo "{
          title: '" .$fila["hour"]." / ".$fila["nombre"] ."',
         id: '" . $fila["id"] . ";" . $fila["fecha_inicio"] . ";" . $fila["fecha_fin"] . "',
		 dates: '" . $fila["fecha_inicio"] . "',
		 hour: '" . $fila["hour"] . "',
          start: '" . $fila["fecha_inicio"] ."',";
  //  start: '" . $fila["fecha_inicio"] ."T".$fila["hour"]. "',";
							if ($fila["hcategory"] == 1)
								echo "backgroundColor : '#FABC0C',";
							if ($fila["hcategory"] == 2)
								echo "backgroundColor : '#1A252F',";
							if ($fila["hcategory"] == 3)
								echo "backgroundColor : '#F8C610',";
							if ($fila["hcategory"] == 4)
								echo "backgroundColor : '#1BB7E1',";
							if ($fila["hcategory"] == 5)
								echo "backgroundColor : '#F78A0F',";


							echo "end: '" . $fila["fecha_fin"] . "'
        },";
						} else {
							$fila["hour"]=	date("g:i A", strtotime($fila["hour"]));	
							
							$fila["nombre"] = str_replace("'", "\'", $fila["nombre"]);
							echo "{
				 title: '" .$fila["hour"]." / ".$fila["nombre"] ."',
				id: '" . $fila["id"] . ";" . $fila["fecha_inicio"] . ";0',
				hour: '" . $fila["hour"] . "',
				start: '" . $fila["fecha_inicio"] ."',";

				if ($fila["hcategory"] == 1)
				echo "backgroundColor : '#FABC0C',";
			if ($fila["hcategory"] == 2)
				echo "backgroundColor : '#1A252F',";
			if ($fila["hcategory"] == 3)
				echo "backgroundColor : '#F8C610',";
			if ($fila["hcategory"] == 4)
				echo "backgroundColor : '#1BB7E1',";
			if ($fila["hcategory"] == 5)
				echo "backgroundColor : '#F78A0F',";


				
			 echo "},";

						}


					}
					?>

				]
			});

			calendar.render();
		});

	</script>
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
	<header class="header">
		<style>
			html {
				scroll-behavior: smooth;
			}
		</style>
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
					
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
	</header>
	<!-- End Header Area -->

	<!-- Slider Area -->
	<section class="slider">
		<div class="hero-slider">
			<!-- Start Single Slider -->
			<?php
			$sql = "SELECT  * FROM gallery_home order by order_pic ASC";
			$images = mysqli_query($link, $sql);
			while ($img = mysqli_fetch_assoc($images)) {

				?>


				<div class="single-slider" style="background-image:url('./admin/uploads/img/<?php echo $img['img']; ?>')">
					<div class="container">
						<div class="row">
							<div class="col-lg-7">
								<div class="text">
									<h1><?php echo $img['text']; ?></h1>

									<p><?php echo $img['text_2']; ?></p>
									<div class="button">
										<a href="#trips" class="btn">Get Appointment</a>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<?php

				echo "</tr>";
			}
			?>


			<!-- End Single Slider -->


			<!-- End Single Slider -->
		</div>
	</section>
	<!--/ End Slider Area -->

	<!-- Start Schedule Area -->
	<section class="schedule">
		<div class="container">
			<div class="schedule-inner">
				<div class="row">
					<div class="col-lg-4 col-md-6 col-12 ">
						<!-- single-schedule -->
						<div class="single-schedule first">
							<div class="inner">
								<div class="icon">
									<i class="fa fa-ambulance"></i>
								</div>
								<div class="single-content">

									<h4>Recent News</h4>
									<br>
									<a href="#">READ MORE<i class="fa fa-long-arrow-right"></i></a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<!-- single-schedule -->
						<div class="single-schedule middle">
							<div class="inner">
								<div class="icon">
									<i class="icofont-prescription"></i>
								</div>
								<div class="single-content">

									<h4>UPCOMING EVENTS</h4>
									<p>Lorem ipsum sit amet consectetur adipiscing elit. Vivamus et erat in lacus
										convallis sodales.</p>
									<a href="#">LEARN MORE<i class="fa fa-long-arrow-right"></i></a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-12 col-12">
						<!-- single-schedule -->
						<div class="single-schedule last">
							<div class="inner">
								<div class="icon">
									<i class="icofont-ui-clock"></i>
								</div>
								<div class="single-content">
									<h4>RECENT FORUM UPDATES</h4>
									<div id="trips"></div>
									<a href="#">LEARN MORE<i class="fa fa-long-arrow-right"></i></a>
								</div>
							</div>
							<div id="what-we-do"></div>
							<div id="join-club"></div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!--/End Start schedule Area -->

	
	<!-- Start Feautes calendario -->
	<section class="Feautes section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						<h2>EVENTS CALENDAR</h2>
						<div id='calendar'></div>
						<div id="contact"></div>

<?php

if (isset($_SESSION["usr_id"]) == true && $_SESSION["tipo_usuario"] != 2 ) 
{
?>


						<a href="./admin/mytrips_new.php" class="btn">
						Add Trip</a><?php
}
?>
					</div>
				</div>
			</div>

		</div>
	</section>
	<!--/ End Feautes -->

	<section class="why-choose section portfolio">
		<div class="container">

			<div class="row">
				<div class="col-lg-12 col-12">
					<!-- Start Choose Left -->
					<div class="choose-left"><div id="faqs"></div>
						<h3>For joining our club, simply complete your registry and you will be prompted for payment. Membership price depend on wether you are a student or not. To register click this button it is super easy:</h3>
                        <a class="btn btn-warning" href="./admin/register.php"
								role="button" aria-expanded="false" aria-controls="collapseExample">
								Register Now
							</a> 

							
					</div>
					<!-- End Choose Left -->
				</div>

			</div>
		</div>
		
	</section>





	
	<section class="why-choose section portfolio">
		<div class="container">

			<div class="row">
				<div class="col-lg-12 col-12">
					<!-- Start Choose Left -->
					<div class="choose-left">					
					<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
       question?
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
      <div class="accordion-body">
	  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
	  question? #2
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
	  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
	  question? #3
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
	  Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum      </div>
    </div>
  </div>
</div>			

					</div>
					<!-- End Choose Left -->
				</div>

			</div>
		</div>
		
	</section>


	<!--/ End Why choose -->
	<!-- Start portfolio -->
	<section class="portfolio section">
		<div class="container-fluid">
			<div class="row">
				
				<div class="col-ls-12 col-12">
					<div allign="center" class="owl-carousel portfolio-slider">
						<div class="single-pf">
							<img src="img/join-1.jpg" alt="#">

						</div>
						<div class="single-pf">
							<img src="img/join-2.jpg" alt="#">

						</div>
						<div class="single-pf">
							<img src="img/join-3.jpg" alt="#">

						</div>
						<div class="single-pf">
							<img src="img/join-2.jpg" alt="#">

						</div>
					</div>
				</div>
			</div>
		</div>

	</section>
	<!--/ End portfolio -->


	<section class="why-choose section portfolio">
		<form action="./contact2.php" method="post">
			<div class="container">
				<div class="section-title">


					<h2>Contact Us</h2>

				</div>
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<div class="col-lg-6">
								<input required type="text" name="name" class="form-control" placeholder="Name">
							</div>
							<div class="col-lg-6">
								<input required type="email" name="email" class="form-control"
									placeholder="Email Address">
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-lg-12 col-12">
								<textarea required required id="message" class="form-control" placeholder="Message"
									name="message" rows="6"></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<p>We’d love to hear from you.</p>
						<br>
						<p>But first, see if your question is one of our frequently asked questions below!</p>
						<br>
						<p>Any further questions, please fill out the email form.</p>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-8">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>

				</div>
				<div class="row">
					<div class="col-md-8">
						<br>
						<h5><?php if (isset($_SESSION["contact"]) == true)
							echo $_SESSION["contact"];
						unset($_SESSION["contact"]) ?>
						</h5>
					</div>

				</div>
			</div>
		</form>
	</section>


	<!-- Footer Area -->
	<footer id="footer" class="footer ">
		<!-- Footer Top -->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-12">
						<div class="single-footer">
							<h2>About Us</h2>
							<p>Lorem ipsum dolor sit am consectetur adipisicing elit do eiusmod tempor incididunt ut
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
							<h2>Site Map</h2>
							<div class="row">
								<div class="col-lg-6 col-md-6 col-12">
									<ul>
										<li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a>
										</li>
										
										<li><a href="#join-club"><i class="fa fa-caret-right" aria-hidden="true"></i>Join CLub</a>
										</li>
										<li><a href="#faqs"><i class="fa fa-caret-right" aria-hidden="true"></i>FAQs</a></li>
												
									</ul>
								</div>
								<div class="col-lg-6 col-md-6 col-12">
									<ul>
									<li><a href="#trips"><i class="fa fa-caret-right" aria-hidden="true"></i>Trips</a></li>
										<li><a href="./past_trips.php"><i class="fa fa-caret-right" aria-hidden="true"></i>Past Trips</a></li>
										<li><a href="#contact"><i class="fa fa-caret-right" aria-hidden="true"></i>Contact Us</a></li>
													
									</ul>
								</div>
							
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<div class="single-footer">
							<h2>Contact</h2>
							<p>11 Edgewater Close
							PYREE NSW 2540</p>
							<br>
							<p>
							<a href='mailto:committee@sydneyuniversitycanoeclub.com.au'>our email</a>
							</p>
							<br>
							<p>(02) 4018 6460</p>

						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<div class="single-footer">
							<h2>Newsletter</h2>
							<p>subscribe to our newsletter to get allour news in your inbox.. Lorem ipsum dolor sit
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

setTimeout(
  function() 
  {

	const currentUrl = window.location.href;
var part=currentUrl.split("#");
console.log(part[1]);
if(part.length==2)
{

	$('html, body').animate({
               scrollTop: $("#"+part[1]).offset().top
            }, 500);

		}
  }, 1000);

			console.log("ready!");
			<?php
			if (isset($_SESSION["newsletter"]) == true) {
				echo "alert('" . $_SESSION["newsletter"] . "');";
				unset($_SESSION["newsletter"]);
			}
			?>


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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Main JS -->
	<script src="js/main.js"></script>
</body>

</html>