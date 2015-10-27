<?php
	session_start();
	if (!isset($_SESSION["username"])) {
		//invalid request, redirects to
		header("location:error.php?type=unauthorized");
		die();
	}

	if($_SESSION["username"]=="guest")
	{
		header("location:error.php?type=unauthorized");
		die();
	}

	$parts = explode('@', $_SESSION["username"]);
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
		header("location:error.php?type=database");
		die();
	}
	
	$query = "SELECT * FROM University WHERE Website='$website'";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);

	if(!$row || isset($_GET['not']))
	{
		$location = $_SESSION["u_country"];
		$query = "SELECT * FROM University WHERE Location='$location'";
		$result2 = @mysqli_query($conn, $query);
		$row2 = true;
	}

	require_once 'unit_tests/classes/sanitiser.php'; // create sanitise objects
	$sanitiser = new Sanitiser();

	if(isset($_GET['duplicate']))
	{
		$duplicateID = $sanitiser->sanitise($_GET["duplicate"]);
		$query = "SELECT * FROM University WHERE UniversityID='$duplicateID'";
		$result3 = @mysqli_query($conn, $query);
		$row3 = mysqli_fetch_assoc($result3);
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
					<?php  
					if ($row && !isset($_GET['not']) && !isset($_GET['not-listed']))
					{
						?> <span class="image"> _ <img src="images/university.png" alt="" />_</span> <?php
					} else
					{
					?>
						<span class="image"> _ <img src="images/university_not_found.png" alt="" />_</span>
					<?php 
					}
					?>
					<div class="content">
							<?php
								if($row && !isset($_GET['not']) && !isset($_GET['not-listed']) && !isset($_GET['duplicate']))
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
											<a href="select_university.php?not=true">This is not my University</a>
										</div>	
									</form>
							<?php	
								}else if (($row2 || isset($_GET['not'])) && !isset($_GET['not-listed']) && !isset($_GET['duplicate'])){
							?>
								<h3>Oh oh!</h3>
								<?php 
									if(isset($_GET['not']))
									{
										echo "<p>Looks like we guessed that one wrong. The list below, is based on your location. See if your University listed below,</p>";
									}else
									{
										echo "<p>We were unable to find your university based on your Email address. The list below, is based on your location. See if its listed below,</p>";
									}
								?>
								<form action='select_university_process.php'>
									<div class="12u$" style='margin-bottom:20px'>
									<select name='universityID'>
							<?php
									while ($row2 = mysqli_fetch_assoc($result2)) { 
										$universityID = $row2['UniversiyID'];
										$universityName = $row2['UniversityName'];
										$universityLocation = $row2['Location'];
										echo "<option value='$universityID'>$universityName - $universityLocation</option>";
									}
							?>
									</select>
									</div>
									<div class="12u$" style="margin-bottom:20px">
										<input type="submit" class="special" value="This is my University" />
									</div>
									<div style='height:20px;'>
											<a href="select_university.php?not-listed=true">My University not listed</a>
									</div>
								</form>
							<?php
								}
								else if (isset($_GET['duplicate']))
								{
							?>
								<h3>Oh dang!</h3>
								<p>Looks like the university you're creating already exist in our database</p>
								<div class="row uniform 50%" style="margin-bottom:40px;">
								<div class="5.5u 12u$(xsmall)">
								<?php 
								$universityName = $row3['UniversityName'];
								echo "<input type='text' value='$duplicateID - $universityName' style='text-align: center;' readonly/>";
								?>
								</div>
								<div class="1u 12u$(xsmall)">=</div>
								<div class="5.5u 12u$(xsmall)">
								<?php 
								$universityName = $row3['UniversityName'];
		
								echo "<input type='text' value='$duplicateID - $universityName' style='text-align: center;' readonly/>";
								?>
								</div>
								</div>

								<div class="12u$" style="margin-bottom:20px">
								<input type="submit" class="special" value="This is my University" />
								</div>
							<?php
								}
								else
								{
							?>
								<h3>looks like your University is not in our database!</h3>
								<p>Don't worry, you can enter details of your university and get started right away</p>
								<a href="create_university.php" class="button big special" style='margin-bottom:50px;'>Enter details</a>
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
