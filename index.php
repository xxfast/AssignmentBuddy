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
					<li><a href="#one" class="button big special">Learn More</a></li>
					<!-- <li><a href="groups.php" class="button big special">Groups</a></li> -->
					<!-- <li><a href="profile.php" class="button big special">Profile</a></li> -->
				</ul>
			</section>

		<!-- One -->
			<section id="one" class="wrapper style1">
				<div class="inner">
					<div class='gstarting'>
						<h2>Getting Started!</h2>
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

		<!-- Two -->
			<section id="two" class="wrapper special">
				<div class="inner">
					<header class="major narrow">
						<h2>About Us</h2>
						<p>This product is brought to you by this awesome (not really) people</p>
					</header>
					<div class="profiles">
						<div class="profile"><a href="https://github.com/xxfast"><div class='profilepic' style = 'background-image: url(https://avatars3.githubusercontent.com/u/13775137)'></div><div class='name'></a>Isuru</div></div>
						<div class="profile"><a href="https://github.com/srisaiyeegharan"><div class='profilepic' style = 'background-image: url(https://avatars0.githubusercontent.com/u/13778035)'></div><div class='name'></a>Srisaiyeekaran</div></div>
						<div class="profile"><a href="https://github.com/jaiminshah09"><div class='profilepic' style = 'background-image: url(https://avatars2.githubusercontent.com/u/13775605)'></div><div class='name'></a>Jaimin</div></div>
						<div class="profile"><a href="https://github.com/vangoghsmangos"><div class='profilepic' style = 'background-image: url(https://avatars2.githubusercontent.com/u/12233651)'></div><div class='name'></a>Hashan</div></div>
						<div class="profile"><a href="https://github.com/shameera0020"><div class='profilepic' style = 'background-image: url(https://avatars2.githubusercontent.com/u/14101486)'></div><div class='name'></a>Shameera</div></div>
					</div>
					<img>
					<div class='repo'>
						<hr>

						<ul class="actions">
							<li> We are Open Source  </li>
							<li><a href="#" class="button big alt">View Repository</a></li>
						</ul>
					</div>
				</div>
			</section>

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