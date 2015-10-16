<!DOCTYPE HTML>
<html>
	<head>
		<title>Register</title>
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
			
			<!-- Banner -->
			<section id="banner_register">  
				<i class="icon"><img id='logo' src="images/icon.svg" alt="" /></i>
				<h2><span class='assignment'>Assignment</span>Buddy</h2>
				<!--<p>Register With us</p>-->
			</section>

			<section id="one" class="wrapper style1">
				<div class="inner">
					<form id="register" method="post" action="register_process.php" <!--novalidate = "novalidate"-->
					<article class="registerfeature">
								<div class="content">
									<h2>Personal Details</h2>
									<p>
									<label for="pfname">First Name&#42;:</label>
									<input type="text" name="pfname" id="pfname" size="20" pattern="[A-Za-z]+" required="required" placeholder="Enter First Name" />
									</p>
									<p>
									<label for="plname">Last Name&#42;:</label>
									<input type="text" name="plname" id="plname"  size="20" pattern="[A-Za-z]+" required="required" placeholder="Enter Last Name" />
									</p>
									<p>
									<label for="pdob">Date of Birth&#42;:</label>
									<input type="text" name="pdob" id="pdob"  placeholder="yyyy-mm-dd"  required="required" />
									</p>
									<p>
									<Label>Gender&#42;:</label>	
									<div class="4u 12u$(xsmall)">
										<input type="radio" id="priority-low" name="pgender">
										<label for="priority-low">Male</label>
									</div>
									<div class="4u 12u$(xsmall)">
										<input type="radio" id="priority-normal" name="pgender">
										<label for="priority-normal">Female</label>
									</div>									
									</p>
									<p>
									<label for="state">University&#42;:</label>
									<div class="12u$">
										<div class="select-wrapper">
										<select name="university" id="university" class="university" required="required">
											<option value ="DEAKIN">Deakin University</option>
											<option value ="MONASH">Monash University</option>
											<option value ="RMIT">RMIT University</option>
											<option value ="FEDUNI">Federation University</option>
											<option value ="SWINBURNE" selected="selected">Swinburne University Of Technology</option>
											<option value ="MELBOURNE">University Of Melbourne</option>
											<option value ="LATROBE">La Trobe University</option>
											<option value ="VU">Victoria University</option>
											<option value ="ACU">Australia Catholic University</option>
										</select>
										</div>
									</div>
									</p>
									<p>
										<label for="pemail">University Email Address&#42;:</label>
										<input type="email" name="pemail" id="pemail" placeholder="123456789@student.swin.edu.au" required="required" />
									</p>
									<!-- <p>
										//<label for="pmphone">Mobile Phone Number&#42;:</label>
										//<input type="tel" name="pmphone" id="pmphone" placeholder="04########" pattern="[0-9]{10}" maxlength="10" size="12" required="required" />
									</p> -->
									<ul class="actions">
										<li class="actions">
											<li><input type="submit" class="special" value="Register" /></li>
											<li><input type="reset" class="alt" value="Reset" /></li>
										</li>
									</ul>
								</div>
					</article>
					</form>
				</div>
			</section>

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