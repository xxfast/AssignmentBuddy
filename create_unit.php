<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		header("location:login.php");
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

		<!-- Main -->

			<section id="main" class="wrapper">
				<div class="container">
					<header class="major special">
						<h2>Create Group</h2>
					</header>
						<h2>STEP 2:</h2>

					<h2>Create a unit</h2>
							
					<!-- Form -->
					<div class="box" >
						<section id="select" class="wrapper style1">
							<div class="inner">
								<h3>Please fill in the blanks</h3>
								<form method="post" action="#">
									<p>Enter Unit Name:</p>
									<div>
										<div class="6u 12u$(xsmall)">
											<input type="text" name="name" id="name" value="" placeholder="Unit Name" />
										</div>
										</br>
											<p>Enter Unit Code:</p>
										<div class="6u$ 12u$(xsmall)">
											<input type="text" name="code" id="code" value="" placeholder="Unit Code" />			
											<div class="12u$">
												<ul class="actions">
													<li><input type="submit" value="Send Message" class="special" /></li>
													<li><input type="reset" value="Reset" /></li>
												</ul>
											</div>
										</div>
									</div>
								</form>
							</div>
						</section>
					</div>

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













				
					