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
		<title>Select Unit</title>
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

		<header class="major special">
		<p></p>
		<h2>Create Group</h2>
		</header>

		<div class="box" >
			<section id="select" class="wrapper style1">
				<div class="inner">
						<h2 align="left">STEP 1:</h2>
							<h3>Select Units</h3>
							<h4>Please select the units </h4>
							
							<form id="selectunits" method="post" <!--novalidate = "novalidate"-->
								<article class="feature">
									<div class="12u$">
										<div class="select-wrapper">
											<select name="category" id="category">
												<option value="">COS10009 Introduction to Programming-</option>
												<option value="1">COS10011 Creating Web Applications</option>
												<option value="1">COS10003 Computer and Logic Essentials</option>
												<option value="1">COS20001 User Centred Design</option>
												<option value="1">COS20007 Object Oriented Programming</option>
												<option value="1">SWE20001 Development Project 1 – Tools and Practices </option>
												<option value="1">COS10004 Computer Systems</option>
												<option value="1">COS20015 Fundamentals of Data Management</option>
											</select>
										</div>
									</div>
								</article>
							</form>
						
				</div>					
							<ul align="center" class="actions">
								<li><a href="#" class="button special">GO NEXT</a></li>
							</ul>											
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













				