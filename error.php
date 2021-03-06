<?php 
	session_start();
	require_once 'unit_tests/classes/sanitiser.php';
	$sanitiser = new Sanitiser(); 
	if (isset($_GET['type'])) $get = $sanitiser->sanitise($_GET['type']);
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
					<h2>Error <?php if (isset($get)) if(strlen($get)<10)echo $get; ?></h2>
					<p>
						<?php
							switch ($get) {
								case 'database':
									echo "Can't connect to the database at the moment. Please Try again later. :(";
									break;
								case 'already-registered':
									echo "It seem's like you have already registed with us";
									break;
								case 'unauthorized':
									echo "you need to login to view requested page";
									break;
								case 'already-verfied':
									echo "You are already verified";
									break;
								case 'user-exist':
									echo "That user seems to be already registerd";
									break;
								default:
									echo "Something is wrong. Please Try again later. :(";
									break;
							}
						?>
					</p>
					<p><img src="images/error.png" width='35%' alt="" /></p>
					<ul class="actions">
						<?php
							if(isset ($_SESSION["username"]) && $get=='already-registered')
							{
								echo '<li><a href="logout.php" class="button big special">Sign out</a></li>';
								echo '<li><a href="profile.php" class="button big special">Update your profile</a></li>';
							}

							if(isset ($_GET['type']) && $get=='user-exist')
							{
								echo '<li><a href="login.php" class="button big special">Sign in</a></li>';
							}
						?>
					</ul>
				</header>	
			</div>
		</section>

		<section id="one" class="wrapper style1">
				<div class="inner">
					<div class='gstarting'>
						<h2>While we fix this, you can</h2>
					<div>
					<article class="feature left">
						<span class="image"><img src="images/pic02.png" alt="" /></span>
						<div class="content">
							<h2>Return back to homepage</h2>
							<p>
								Sorry for your inconvenience. We are already working on fixing your problem. Meanwhile, you can head over to the homepage.
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