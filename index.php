<?php 
	session_start();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>AssignmentBuddy</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<link rel='shortcut icon' type='image/x-icon' href='/favicon.ico' />
	</head>
	<body class="landing">

		<!-- Header -->
		<header id="header" class="alt">
			<h1><a href="index.html"><span class='assignment'>Assignment</span>Buddy</a></h1>
			<a href="#nav">Menu</a>
		</header>

		<?php require ("navigation.php"); ?>

		<!-- Banner -->
			<section id="banner">
				<i class="icon"><img id='logo' src="images/icon.svg" alt="" /></i>
				<h2><span class='assignment'>Assignment</span>Buddy</h2>
				<p>Collaboration made easy</p>
				<ul class="actions">
                	<?php 
						if(isset ($_SESSION["username"]))
						{
							echo '<li><a href="lobby.php" class="button big special">Lobby</a></li>';
							echo '<li><a href="profile.php" class="button big special">Profile</a></li>';
						}
						else
						{
							echo '<li><a href="#one" class="button big special">Learn More</a></li>';
						}
					?>
					<!-- <li><a href="groups.php" class="button big special">Groups</a></li> -->
					<!-- <li><a href="profile.php" class="button big special">Profile</a></li> -->
				</ul>
			</section>

		<!-- One -->
			<section id="one" class="wrapper style1">
				<div class="inner">
					<div class='gstarting'>
						<h2>Getting Started!</h2>
						<?php print_r($_SESSION);?>
					<div>
					<article class="feature left">
						<span class="image"><img src="images/pic01.png" alt="" /></span>
						<div class="content">
							<h2>Create a profile</h2>
							<p>
								To get started, create your own profile using your university email address. Upload a profile picture, enter your details and customize it the way you want
							</p>
							<ul class="actions">
								<li>
									<a href="register_form.php" class="button alt">Create Profile</a>
								</li>
							</ul>
						</div>
					</article>
					<article class="feature right">
						<span class="image"><img src="images/pic02.png" alt="" /></span>
						<div class="content">
							<h2>
								Join into an Assignment Group
							</h2>
							<p>
								Browse your University's lobby for available Assignment groups and request to join them.
								Once approved by the <strong>Group Administrator</strong>, you'll be a part of this group
							</p>
							<ul class="actions">
								<li>
									<a href="#" class="button alt">Browse Lobby</a>
								</li>
							</ul>
						</div>
					</article>
					<article class="feature left">
						<span class="image"><img src="images/pic03.png" alt="" /></span>
						<div class="content">
							<h2>Create your own Assignment group</h2>
							<p>
								If none available, create your own Assignment Group and become <strong>Group Administrator</strong>. Assign your team a target goal, and the number of students youre looking for.
							</p>
							<ul class="actions">
								<li>
									<a href="#" class="button alt">Create Group</a>
								</li>
							</ul>
						</div>
					</article>
				</div>
			</section>
            
            <?php ?>
            
		<?php require 'about.php' ;?>

		<?php require ("guest_login.php"); ?>

		<?php require ("login_form.php"); ?>

		<?php require ("footer.php"); ?>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>