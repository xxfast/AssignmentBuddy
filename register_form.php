<?php 
	session_start();

	if (isset($_SESSION["username"])) {
		//problamatic request, redirects to
		header("location:error.php?type=already-registered");
		die();
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Register</title>
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
						<h2>Signup for AssignmentBuddy!</h2>
					<div>
					<article class="feature right">
						<span class="image"><img src="images/pic01.png" alt="" /></span>
						<div class="content">
							
							<form method="post" action="register_process.php" validate='validate'>
								<div class="row uniform 50%">
									<div class="6u 12u$(xsmall)">
										<input type="text" name="pfname" id="pfname" size="20" pattern="[A-Za-z]+" required="required" placeholder="First Name" />
									</div>
									<div class="6u 12u$(xsmall)">
										<input type="text" name="plname" id="plname"  size="20" pattern="[A-Za-z]+" required="required" placeholder="Last Name" />
									</div>
									<div class="12u$">
										<input type="email" name="pemail" id="pemail" placeholder="student@university.edu" required="required" />
									</div>
										<div class="2u 12u$(xsmall)">
											<?php 
												echo "<select name='pdate' required='required'>";
											 	for ($i=1; $i <= 31; $i++) { 
											 		echo "<option value='$i'>$i</option>";
											 	}
											 	echo "</select>";
											?>
										</div>
										<div class="2u 12u$(xsmall)">
											<?php 
												echo "<select name='pmonth' required='required'>";
											 	for ($i=1; $i <= 12; $i++) { 
											 		echo "<option value='$i'>$i</option>";
											 	}
											 	echo "</select>";
											?>
										</div>
										<div class="3u 12u$(xsmall)">
											<?php 
												echo "<select name='pyear' required='required'>";
											 	for ($i=1900; $i <= date("Y"); $i++) { 
											 		echo "<option value='$i'>$i</option>";
											 	}
											 	echo "</select>";
											?>
										</div>
									<div class="5u 12u$(xsmall)">
										<input type="radio" id="male" name="pgender" value="male" style="display:none"/>
										<label for="male">Male</label>
										<input type="radio" id="female" name="pgender" value="female" style="display:none"/>
										<label for="female">Female</label>
									</div>
									<div class="12u$">
									<input type="text" name="pphone" id="pmphone" placeholder="Phone Number (+00)0000000000" pattern="[\+]\d{2}[\(]\d{2}[\)]\d{10}" maxlength="20" size="12" required="required" />
									</div>
									<div class="8u 12u$(xsmall)">
									<input type="text" name="padress" id="adress" placeholder="Address" /></p>
									</div>
									<div class="4u 12u$(xsmall)">
										<?php include_once 'ISO_SelectCountry.php'; ?>
									</div>
									<div class="12u$">
											<input type="checkbox" id="tos" name="ptos" style="display:none">
											<label for="tos">I agree for</label>
											<a href="#">terms of service</a>
									<?php
										if (isset($_GET["errors"])) 
										{
											require_once 'unit_tests/classes/sanitiser.php'; 
											$sanitiser = new Sanitiser();
											$errors = ($_GET["errors"]); // if i sanatise this, i lose the formatting, if i dont, hackers will get in #first world problems
								 			echo "<div class='errorlist'><ul>$errors</ul></div>";
										}
							 		?>
									</div>
									
									<div class="12u$">
										<input type="submit" class="special" value="Next" />
										<input type="reset" class="alt" value="Reset" />
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


