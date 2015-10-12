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
				<p>Oops Something went wrong.</p>
		
<?php include 'header.php'; ?>
<section id="regprocess">
<?php
	
	function sanitise($data)   //eliminating unwanted characters using sanitise function
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;		
	}
	
	require_once ("settings.php"); //connection info
	$conn = @mysqli_connect($host,
	$user,
	$pwd,
	$sql_db
	);
	
	if (!$conn)
	{
		echo "<p>Database connection failure</p>"; // not in production script
	} 
	else
	{
		$sql_table="users";
		
		@$hfname = sanitise($_POST["pfname"]);
		@$hlname = sanitise($_POST["plname"]);
		
		echo"<div id='resultsPage'>";
		echo"<h1>Hello $hfname $hlname, Welcome!</h1>";
		echo"<br/>";
		
		"<br/>";
		echo"</div>";
		
	
		
		// Validate firstName 
		function fName($value)
		{
			
			$fnlength = strlen($value);
			
			if($value=="") 
			{
				echo "<p>*Please Enter your First Name</p>";
				return false; 
			}
			if(!preg_match("/^[a-zA-Z ]*$/",$value))
			{
				echo"<p>*First Name: Only letters and spaces allowed.</p>";
				return false;
			} 
			if($fnlength > 12)
			{
				echo"<p>*First Name Cannot be more than 12 characters</p>";
				return false;
			}
			else 
			{
				echo"<p></p>";
				//header("location:register_form.php");
				return true;
			}				
		}
		
		
		
		//Validate LastName
		function lName($value)
		{
			$lnlength = strlen($value);	
			
			if($value=="") 
			{
				echo "<p>*Please Enter your Last Name</p>";
				return false;
			}
			if(!preg_match("/^[a-zA-Z ]*$/",$value))
			{
				echo"<p>*Last Name: Only letters and spaces allowed.</p>";
				return false;
			} 
			if($lnlength > 20)
			{
				echo"<p>*Last Name Cannot be more than 20 characters</p>";
				return false;
			}
			else 
			{
				echo"<p></p>";
				return true;
				
			}			
		}
					
	
		
		
		//Validate dob
		function dob($value)
		{

			
			if(!preg_match('/^(19|20)\d\d([-])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])*$/',$value))
			{
				echo"<p>*Please Enter your Date of birth in the format yyyy-mm-dd.</p>";
				return false; 
			} 
			else 
			{
				return true;
			}
				
		}
					
			
		//Validate gender
		function sex($value)
		{
			 
			if(!$value == '') 
			{
				echo "";
				return true;
			}
			else
			{
				echo "<p>*Please Enter your Gender</p>";
				return false;
			}
				
		}
					
		//Validate email 
		function email($value)
		{
			if(!filter_var($value,FILTER_VALIDATE_EMAIL)) 
			{
				echo"<p>*Invalid email format</p>"; 
				return false; 
			}
			else 
			{
				return true;
			}
		}
		
		
		//check whether the form fields in the register form are set
		if(isset($_POST["pfname"])) 
			{
			$firstname = sanitise($_POST["pfname"]);
			fName($firstname);
			$lastname = sanitise($_POST["plname"]);
			lName($lastname);
			$birth = sanitise($_POST["pdob"]);
			dob($birth);
			@$gender = sanitise($_POST["pgender"]);
			sex($gender);
			$email = sanitise($_POST["pemail"]); 
			//email($email);
		}
		
			 // start the session
			if (!isset ($_SESSION["pemail"])) 
			{ // check if session variable exists
			$storedEmail = $email;
			$_SESSION["pemail"] = $email; // create and set the session variable
			}
		
		
		//echo "$firstname $lastname $birth $gender $street $town $state $email $postal $phone";
		if (@email($email))		
		{
			$query = "INSERT INTO $sql_table (fname, lname, dob, gender, email) 
			VALUES 
			('$firstname', '$lastname', '$birth', '$gender', '$email')";
			$result = mysqli_query($conn, $query);
			
			if($result && $email != null)
			{
			echo"<section id = 'whiteText'>";
			echo"<p>Thank you $firstname $lastname for registering with us, you can now login.</p>";
			echo"<section id="four" class="wrapper style2 special">";
				echo"<div class="inner">";
					echo"<header class="major narrow">";
						echo"<h2>Log in</h2>";
					echo"</header>";
					echo"<form action="#" method="POST">";
						echo"<div class="container 75%">";
							echo"<div class="row uniform 50%">";
								echo"<div class="6u 12u$(xsmall)">";
									echo"<input name="username" placeholder="Email" type="text" />";
								echo"</div>";
								echo"<div class="6u$ 12u$(xsmall)">";
									echo"<input name="password" placeholder="Password" type="password" />";
								echo"</div>";
							echo"</div>";
						echo"</div>";
						echo"<ul class="actions">";
							echo"<li><input type="submit" class="special" value="Login" /></li>";
							echo"<li><input type="reset" class="alt" value="Clear" /></li>";
						echo"</ul>";
					echo"</form>";
				echo"</div>";
			echo"</section>";
			echo"</section>";
			}
			
			else
			{
			
			echo "<p>Sorry a student with $email already exists! Please enter a different email. or Login</p>";
			//header("location:quiz.php");
			}
				
		}
	
		mysqli_close($conn);
	}	
	
?>
</section>
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
	

