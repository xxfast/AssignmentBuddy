<?php 
	session_start();
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
	$i_email = $_SESSION["i_email"];
	require_once 'unit_tests/classes/sanitiser.php'; // create sanitise objects
	$sanitiser = new Sanitiser();
	if(isset($_GET['error'])) $get_error = $sanitiser->sanitise($_GET['error']); else $get_error = false;

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Create Profile</title>
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
						<h2>Create profile!</h2>
					<div>
					<article class="feature right">
						<span class="image"> <p style="color:white;">_</p> <img src="images/password.png" alt="" /><p style="color:white;">_</p></span>
						<div class="content">
							<form method="post" action="create_user_process.php" validate='validate'>
								<div class="row uniform 50%">
									<div class="12u$">
										<h3>Please Note:</h3>
										<p>Secure your profile with a <strong>strong</strong> password. Your username will be the <u>email address</u> you entered before. Plase make sure you note down your password somewhere, just incase you forget it</p>
									</div>
									<?php
										if(isset($_GET['error']))
										{
											$code = '';
											echo "<div class='12u$' style='display:inline-block;'>";
											echo "<div style='color:red;'>Please use combination of uppercase and lowercase with digits as a password !</div>";
											echo "</div>";
										}
									?>
									<div class="12u$" style=" text-align: center;">
										<hr>
										<div class="8u$" style="display:inline-block;">
											<?php echo "<input type='text' name='username' id='username' size='5' value='$i_email' required='required' style='text-align: center; margin-bottom:10px;' readonly/>"?>
											<input type='password' name='password' id='password' size='5' pattern='/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/' required='required' placeholder='password' style='text-align: center;'/>
										</div>
									</div>

									<div class="12u$">
										<input type="submit" class="special" value="Confirm" />
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