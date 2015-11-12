<?php 
	session_start();
	if (!isset($_SESSION["username"])) {
		//problamatic request, redirects to
		//header("location:error.php?type=unauthorized");
		//die();
	}

	require_once 'unit_tests/classes/sanitiser.php'; // create sanitise objects
	$sanitiser = new Sanitiser();
	if(isset($_GET['error'])) $get_error = $sanitiser->sanitise($_GET['error']); else $get_error = false;	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Profile Picture</title>
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
						<h2>Upload a Profile Picture!</h2>
					<div>
					<article class="feature right">
						<span class="image"> <img src="images/profile_picture.png" alt="" /></span>
						<div class="content">
							<form method="post" action="profile_picture_upload.php" enctype="multipart/form-data">
								<div class="row uniform 50%">
									<div class="12u$">
										<p>Customise your profile, give your profile a picture so others can see who they are talking to</p>
									</div>
									<?php
										if(isset($_GET['error']))
										{
											$code = '';
											echo "<div class='12u$' style='display:inline-block;'>";
											echo "<div style='color:red;'>Error in file !</div>";
											echo "</div>";
										}
									?>
									<div class="12u$" style=" text-align: center;">
										<div class="5u$" style="display:inline-block;">
											<input type="file" name="fileToUpload" id="fileToUpload">
										</div>
									</div>

									<div class="12u$">
										<p>Please select an image atleast 250x250 and less than 2mb</p>
									</div>

									<div class="12u$">
										<input type="submit" class="special" value="Upload" />
										<input type="reset" class="alt" value="Clear" />
									</div>

									<div class="12u$">
										<a href="select_university.php">See If the university is already in the database</a>
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