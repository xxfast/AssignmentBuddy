<?php
	session_start();
	if (!isset($_SESSION["username"])) {
		//invalid request, redirects to
		//header("location:error.php?type=unauthorized");
		//die();
	}

	if($_SESSION["username"]=="guest")
	{
		//header("location:error.php?type=unauthorized");
		//die();
	}

	$parts = explode('@', "100041533@student.swin.edu.au");
	$parts = explode('.',$parts[1]);
	switch (count($parts)) 
	{
		case 4:
			//like student.swin.edu.au
			$website =  'http://www.'.$parts[1].'.'.$parts[2].'.'.$parts[3];
			break;
		case 3:
			//like swin.edu.au
			$website =  'http://www.'.$parts[0].'.'.$parts[1].'.'.$parts[2];
			break;
		case 2:
			//like swin.edu
			$website =  'http://www.'.$parts[0].'.'.$parts[1];
			break;
		default:
			$website =  $parts[count($parts)-1];
			for ($i=count($parts)-2; $i > 2; $i--) 
			{ 
				$website=$parts[$i].'.'.$website;
			}
			$website = 'http://www.'.$website;
			break;
	}
	include_once "settings.php";
	$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
	if(!$conn)
	{
		//header("location:error.php?type=database");
		//die();
	}
	
	$query = "SELECT * FROM University WHERE Website='$website'";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);

	if(!$row || isset($_GET['not']))
	{
		$location = $_SESSION["u_country"];
		$query = "SELECT * FROM University WHERE Location='$location'";
		$result = @mysqli_query($conn, $query);
		$row2 = mysqli_fetch_assoc($result);
	}
?>

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
				<div class='gstarting'>
					<h2>Select your University</h2>
				<div>
				<article class="feature left">
					<span class="image"> _ <img src="images/university.png" alt="" />_</span>
					<div class="content">
							<?php
								if($row)
								{
							?>
									<h3>Time to get connected with everyone!</h3>
							<?php 
									$universityName = $row['UniversityName'];
									$user_email = $_SESSION['username'];
									echo "<p>From your email address: <strong>$user_email</strong>, it seems like you're currently enrolled in</p>";
							?>
									<form action='select_university_process.php'>

										<div class="12u$" style='margin-bottom:20px'>
											<?php echo "<input type='text' value='$universityName' style='text-align: center;' readonly/>" ?>
										</div>
									
										<div class="12u$" style="margin-bottom:20px">
											<input type="submit" class="special" value="This is my University" />
										</div>

										<div style='height:20px;'>
											<a href="select_university.php?not=true">Not your University?</a>
										</div>	
									</form>
							<?php	
								}else if ($row2 ){
							?>
								<h3>Oh oh!</h3>
								<p>We were unable to find your university based on your Email address. The list below, is based on your location. See if its listed below,</p>
								<form action='select_university_process.php'>
									<div class="12u$" style='margin-bottom:20px'>
									<select name='universityID'>
							<?php
									for ($i=0; $i < count($row2); $i++) { 
										$universityID = $row2['UniversiyID'];
										$universityName = $row2['UniversiyName'];
										echo "<option value='$universityID'>$universityName</option>";
									}
							?>
									</select>
									</div>
									<div class="12u$" style="margin-bottom:20px">
										<input type="submit" class="special" value="This is my University" />
									</div>
									<div style='height:20px;'>
											<a href="login.php">Your University not listed?</a>
									</div>
								</form>
							<?php
								}else 
								{
							?>
								<h3>looks like your University is not in our database!</h3>
								<p>We were unable to find your university based on your Email address. The list below, is based on your location. See if its listed below,</p>
								
							<?php
								}
							?>
						<br>
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
