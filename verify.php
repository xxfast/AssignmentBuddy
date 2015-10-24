<?php 
	session_start();

	if (isset($_SESSION["username"])) {
		//problamatic request, redirects to
		//header("location:error.php?type=already-verfied");
		//die();
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Verify</title>
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
		
		<!-- Register -->
		
			<!-- Form -->
			<section id="one" class="wrapper style1">
				<div class="inner">
					<div class='gstarting'>
						<h2>Verify your Email!</h2>
					<div>
					<article class="feature right">
						<span class="image"> _ <img src="images/mail.png" alt="" />_</span>
						<div class="content">
							<form method="post" action="verify_process.php" validate='validate'>
								<div class="row uniform 50%">
									<div class="12u$">
										<p>Take a minute to check your email and verify your email address by entering this 5 digit code that appear in your email</p>
									</div>
									<div class="12u$" style=" text-align: center;">
										<div class="5u$" style="display:inline-block;">
											<input type="text" name="code" id="code" size="5" pattern="[A-Za-z0-9]{5}" required="required" placeholder="31415" style="text-align: center;"/>

										</div>
									</div>

									<div class="12u$">
										<?php 
											require_once 'unit_tests/classes/sanitiser.php'; 
											$sanitiser = new Sanitiser();
											if (isset($_GET['email'])) $get = $sanitiser->sanitise($_GET['email']); else $get = "";
											if(isset($_GET['email']))
											{
												echo "<p>Mail sent to: <strong>$get</strong> </p>";
											}
										?>
									</div>

									<div class="12u$">
										<p>Didn't get an email? <a href="#">Resent email</a></p>
									</div>

									<div class="12u$">
										<input type="submit" class="special" value="Verify" />
										<input type="submit" class="alt" value="Later" />
									</div>

								</div>
							</form>
							
						</div>

					</article>
				</div>
			</section>

			
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