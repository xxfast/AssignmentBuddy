<!DOCTYPE HTML>
<html>
	<head>
		<title>Select University</title>
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
					<form id="register" method="post" action="register_process.php" <!--novalidate = "novalidate"-->
					<article class="feature">
							<div class="content">
							<h2>Select University:</h2>
							
									<p>
									<label for="state">University&#42;:</label>
									<div class="12u$">
										<div class="select-wrapper">
											<select name="category" id="category" required="required">
												<option value="">- Category -</option>
												<option value="1">Monash University</option>
												<option value="1">RMIT</option>
												<option value="1">Swinburne</option>
												<option value="1">Melbourne University</option>
											</select>
										</div>
									</div>
									<p>
									<h1>Can't Find the course you are looking for? <a href="create_university.php">Add</a> University</h1>
									</p>
														
									<ul class="actions">
										<li class="actions">
											<li><input type="submit" class="special" value="Next" /></li>
											<!--<li><input type="reset" class="alt" value="Reset" /></li> -->
										</li>
									</ul>
								</div>
					</article>
					</form>
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
