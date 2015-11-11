<?php
	session_start();
	if (!isset($_SESSION["username"])) {
		//problematic request, redirects to
		header("location:error.php?type=unauthorized");
		die();
	}
	if ($_SESSION["username"]=='guest') {
		//problamatic request, redirects to
		header("location:error.php?type=unauthorized");
		die();
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Create Unit</title>
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

		<section id="one" class="wrapper style1">
			<div class="inner">
				<div class='gstarting'>
					<h2>Enter details of your Unit</h2>
				<div>
				<article class="feature right">
					<span class="image"><img src="images/create_unit.png" alt="" /></span>
					<div class="content">
						
						<form method="post" action="create_university_process.php" novalidate='novalidate'>
							<div class="row uniform 50%">
								<div class="12u 12u$(xsmall)">
									<p>Enter details about your unit, so others who does the same unit can join you. This information will be voted by the peers and verfied</p>
								</div>
								<div class="6u 12u$(xsmall)">
									<input type="text" name="unitcode" id="unitcode" size="20" pattern="[A-Za-z]+" required="required" placeholder="Unit Code"/>
								</div>
								<div class="6u 12u$(xsmall)">
									<input type='text' name='unitname' id='unitname' required="required"  placeholder='Unit Name'  required='required'/>";
								</div>
								<div class="12u$">
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
									<input type="submit" class="special" value="Enter Details" />
									<input type="reset" class="alt" value="Reset" />
								</div>
								<div class="12u$">
									<a href="select_unit.php">See If the Unit is already in the database</a>
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
