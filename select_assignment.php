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
		<title>Select Assignment</title>
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
						<h2>Select Assignment</h2>
					<div>
					<article class="feature right">
						<span class="image"><img src="images/pic01.png" alt="" /></span>
						<div class="content">
							
							<form method="post" action="select_assignment_process.php" validate='validate'>
								<div class="row uniform 50%">
									<div class="6u 12u$(xsmall)">
										<input type="text" name="unitId" id="unitId" size="35" pattern="[A-Za-z]+" required="required" placeholder="Unit ID" />
									</div>
									<div class="6u 12u$(xsmall)">
										<input type="text" name="unitId" id="unitId"  size="20" required="required" placeholder="Assignment Title" />
									</div> 
								
									</div>
									
									<div class="12u$">
									<p></p>
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
