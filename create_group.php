<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		header("location:login.php");
	}

	if(!isset($_SESSION["selectedUnit"])
	{
		//user hasn't selected the unit yet :/
		header("location:select_unit.php");
		die();
	}
?>

<html>
	<head>
		<title>Create Group</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>
		<?php require 'header.php'; ?>
		<?php require 'navigation.php'; ?>

		<section id="main" class="wrapper">
				<div class="container">
					<header class="major special">
						<h2>Create Group</h2>
						<p>Create a new group</p>
					</header>
					<section>
							<h3>Group Details</h3>
							<form method="post" action="#">
								<div class="row uniform 50%">
									<div class="6u 12u$(xsmall)">
										<input type="text" name="unitid" id="unitid" value="" placeholder="Unit ID" />
									</div>
									<div class="6u$ 12u$(xsmall)">
										<input type="number" name="count" id="count" value="" placeholder="Number of members" />
									</div>
									<div class="12u$">
										<textarea name="description" id="description" placeholder="Enter the assignment description" rows="6"></textarea>
									</div>
									<div class="4u 12u$(xsmall)">
										<input type="radio" id="pass" name="target" checked>
										<label for="pass">Pass</label>
									</div>
									<div class="4u 12u$(xsmall)">
										<input type="radio" id="credit" name="target">
										<label for="credit">Credit</label>
									</div>
									<div class="4u$ 12u$(xsmall)">
										<input type="radio" id="distinction" name="target">
										<label for="distinction">Distinction</label>
									</div>
									<div class="4u$ 12u$(xsmall)">
										<input type="radio" id="highdistinction" name="target">
										<label for="highdistinction">High Distinction</label>
									</div>
									<div class="12u$">
										<ul class="actions">
											<li><input type="submit" value="Create Group" class="special" /></li>
											<li><input type="reset" value="Reset" /></li>
										</ul>
									</div>
								</div>
							</form>
						</section>
				</div>
		</section>

		<?php require 'footer.php'; ?>
		
	</body>
</html>