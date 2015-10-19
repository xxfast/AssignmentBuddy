<?php 
	session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Lobby</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
		<?php require ("header.php"); ?>

		<!-- Nav -->
		<?php require ("navigation.php"); ?>

		<!-- Main -->

		<section id="main" class="wrapper">
			<div class="container">
				<header class="major special">
					<h2>Error</h2>
					<p>
						<?php
							switch ($_GET['type']) {
								case 'database':
									echo "Can't connect to the database at the moment. Please Try again later. :(";
									break;
								
								default:
									echo "Something is wrong. Please Try again later. :(";
									break;
							}
						?>
					</p>
				</header>	
			</div>
		</section>

		<section id="one" class="wrapper style1">
				<div class="inner">
					<div class='gstarting'>
						<h2>While we fix this, you can</h2>
					<div>
					<article class="feature left">
						<span class="image"><img src="images/pic01.png" alt="" /></span>
						<div class="content">
							<h2>Return back to homepage</h2>
							<p>
								To get started, create your own profile using your university email address. Upload a profile picture, enter your details and customize it the way you want
							</p>
							<ul class="actions">
								<li>
									<a href="index.php" class="button alt">Homepage</a>
								</li>
							</ul>
						</div>
					</article>
				</div>
			</section>

		<!-- Footer -->
			<?php require ("footer.php"); ?>
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>