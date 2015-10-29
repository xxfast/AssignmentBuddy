<?php 
	session_start();
	if(!isset($_GET['profile']) && !isset($_GET['university']))
	{
		if (isset($_SESSION["username"])) {
			//problamatic request, redirects to
			header("location:error.php?type=already-verfied");
			die();
		}

		if (!isset($_SESSION["i_email"])) {
			//invalid request, redirects to
			header("location:error.php?type=unauthorized");
			die();
		}
	}else if (!isset($_SESSION["username"])) {
		//problamatic request, redirects to
		header("location:error.php?type=unauthorized");
		die();
	}

	$i_email = $_SESSION["i_email"];
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Sucess!</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<link rel='shortcut icon' type='image/x-icon' href='/favicon.ico' />
	</head>

	<body>
		<?php require 'header.php'; ?>

		<!-- Nav -->
			<?php require 'navigation.php';?>
		
		<!-- Successform -->
		
			<section id="one" class="wrapper style1">
				<div class="inner">
					<div class='gstarting'>
						<h2>Success</h2>
					<div>
					<article class="feature right">
						<?php
							if(isset($_GET['profile']))
							{
						?>
							<span class="image"> <p style="color:white;">_</p> <img src="images/sucess.png" alt="" /><p style="color:white;">_</p></span>
						<?php
							}
							else if(isset($_GET['university']))
							{
						?>
							<span class="image"> <p style="color:white;">_</p> <img src="images/university_success.png" alt="" /><p style="color:white;">_</p></span>
						<?php
							}
						?>
						<div class="content">
							<?php
								if(isset($_GET['profile']))
								{
							?>
								<h3>Well done!</h3>
								<div class="12u$">
									<p>You successfully created a profile, way to go :) Sign back in with your email and password to get things started</p>
								</div>
								<div class="12u$">
									<a href="login.php" class="button big special" style='margin-bottom:50px;'>Sign in</a>
								</div>
							<?php 
								}
								else if(isset($_GET['university']))
								{
							?>
								<h3>You selected your university!</h3>
								<div class="12u$">
									<p>You successfully selected university, now please update your course information to continue</p>
								</div>
								<div class="12u$">
									<a href="select_course.php" class="button big special" style='margin-bottom:50px;'>Select Course</a>
								</div>
							<?php
								}		
							?>
						</div>
					</article>
				</div>
			</section>

			<?php include_once 'login_form.php'; ?>
		<!-- Footer -->
			<?php require 'footer.php'; ?>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>