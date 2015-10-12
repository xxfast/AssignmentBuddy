<!DOCTYPE HTML>
<html>
	<head>
		<title>Sign In</title>
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

			
		<!-- Nav -->
			<nav id="nav">
				<ul class="links">
					<div class="profile-container">
						<div class='profile-unit'>
							<p>Welcome,<br><strong>Isuru</strong>
						</div>
						<div class='profile-pic-unit'>
							<div class='profilepic' style = 'background-image: url(https://avatars3.githubusercontent.com/u/13775137)'></div>
						</div>
					</div>
					<li><a href="profile.html"><img class='menuicon' src="images/icons/home.svg" alt="" /> Home</a></li>
					<li><a href="profile.html"><img class='menuicon' src="images/icons/profile.svg" alt="" /> Profile</a></li>
					<li><a href="login.php"><img class='menuicon' src="images/icons/login.svg" alt="" /> Sign In</a></li>
					<li><a href="logout.php"><img class='menuicon' src="images/icons/logout.svg" alt="" /> Sign out</a></li>
					<li><a href="register_form.php"><img class='menuicon' src="images/icons/register.svg" alt="" /> Sign up</a></li>
					<li><a href="index.html#two"><img class='menuicon' src="images/icons/info.svg" alt="" /> About Us</a></li>
				</ul>
			</nav>
<form id="login" method="post" action="login_process.php">

								
<!-- Four -->
<section id="four" class="wrapper style2 special">
				<div class="inner">
					<header class="major narrow">
					<section id="banner_login">  
						<i class="icon"><img id='logo' src="images/icon.svg" alt="" /></i>
						</section>
					</header>
					<form action="#" method="POST">
						<div class="container 75%">
							<div class="row uniform 50%">
								<div class="6u 12u$(xsmall)">
									<input name="username" id="username" placeholder="Email" type="text" required="required" />
								</div>
								<div class="6u$ 12u$(xsmall)">
									<input name="password" id="password" placeholder="Password" type="password" required="required" />
								</div>
							</div>
							
						</div>
						<ul class="actions">
							<li><input type="submit" class="special" value="Sign In" /></li>
							<p></p>
							<p> Can't access your account?</p>
							<p>Don't have an AssignmentBuddy account? <a href="register_form.php">Sign up now</a>
						</ul>
					</form>
				</div>
			</section>
</form>

		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<ul class="icons">
						<li><a href="#" class="icon fa-facebook">
							<span class="label">Facebook</span>
						</a></li>
						<li><a href="#" class="icon fa-twitter">
							<span class="label">Twitter</span>
						</a></li>
						<li><a href="#" class="icon fa-instagram">
							<span class="label">Instagram</span>
						</a></li>
						<li><a href="#" class="icon fa-linkedin">
							<span class="label">LinkedIn</span>
						</a></li>
					</ul>
					<ul class="copyright">
						<li>2015 &copy; X Fast Games</li>
						<li>Design by <a href="http://templated.co">templated.co</a>.</li>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>