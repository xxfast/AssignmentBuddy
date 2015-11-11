<?php
	session_start();
	if (!isset($_SESSION["username"])) {
		//invalid request, redirects to
		//header("location:error.php?type=unauthorized");
		//die();
	}

	if($_SESSION["username"]=="guest")
	{
		//no guest is allowed
		//header("location:error.php?type=unauthorized");
		//die();
	}


	if($_SESSION["u_course"]==NULL)
	{
		//user hasnt selected the course
		//header("location:select_course.php");
		//die();
	}

	if($_SESSION["u_university"]==NULL)
	{
		//user hasnt selected the university
		//header("location:select_university.php");
		//die();
	}

	include_once "settings.php";
	$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
	
	if(!$conn)
	{
		//no database :(
		//header("location:error.php?type=database");
		//die();
	}

	if (!isset($_GET['duplicate'])) 
	{
		$universityID = $_SESSION['u_university'];
		$courseID = $_SESSION["u_course"];
		$query = "SELECT * FROM Unit NATURAL JOIN CourseUnit cu NATURAL JOIN Course c WHERE CourseID='$courseID'";
		$result = @mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
	}
	else
	{
		$duplicateCode = $_SESSION['temp_duplicateCode'];
		$universityID = $_SESSION['u_university'];
		$query = "SELECT * FROM Unit WHERE UnitCode='$duplicateCode' AND UniversityID='$universityID'";
		$result = @mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Select Unit</title>
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
					<h2>Select your Unit</h2>
				<div>
				<article class="feature left">
					<?php  
					if ($row && !isset($_GET['not']))
					{
						?> <span class="image"><img src="images/select_course.png" alt="" /></span> <?php
					} else
					{
					?>
						<span class="image"> <img src="images/create_course.png" alt="" /></span>
					<?php 
					}
					?>
					<div class="content">
							<?php
								if(!isset($_GET['duplicate']))
								{
							?>
									<h3>Set Unit</h3>
									<p>Select the unit this assignment group belongs to</p>
									<form action='select_course_process.php' method="post">
									<div class="12u$" style="margin-bottom:20px">
									<select name='selectedCourse'>
							<?php
									while ($row = mysqli_fetch_assoc($result)) { 
										$unitCode = $row['UnitCode'];
										$unitName = $row['UnitName'];
										$unitID = $row['UnitID'];
										echo "<option value='$unitID'>$unitCode - $UnitName</option>";
									}
							?>
									</select>
									</div>
									<div class="12u$" style="margin-bottom:20px">
										<input type="submit" class="special" value="This is my Course" />
									</div>

									<div style='height:20px;'>
										<a href="select_unit.php?not=true">My unit is not listed</a>
									</div>	
									</form>
							<?php	
								}
								else if(isset($_GET['duplicate']) && isset($_SESSION['temp_duplicateCode']))
								{
							?>
									<h3>We found a match!</h3>
									<p>Looks like the details you entered already match a unit that exist in our database. Is this your course?</p>
									<form action='select_unit_process.php' method="post">
									<div class="12u$" style="margin-bottom:20px">
										<?php 
											$UnitID = $row['UnitID'];
											$UnitCode = $row['UnitCode'];
											$UnitName = $row['UnitName'];
											echo "<input type='hidden' name='selectedUnit' value='$UnitID' style='text-align: center;' readonly/>" ;
											echo "<input type='text' name='unitName' value='$UnitCode - $UnitName' style='text-align: center;' readonly/>" ;
										?>
									</div>
									<div class="12u$" style="margin-bottom:20px">
										<input type="submit" class="special" value="This is my Unit" />
									</div>
									<div style='height:20px;'>
										<a href="select_unit.php?not=true">This isn't my unit</a>
									</div>
									</form>	
							<?php
								}else{
							?>
								<h3>Couldn't find any units!</h3>
								<p>We were unable to find your unit provided by your university. Don't worry, you can enter details about your unit and get started right away</p>
								<form action='create_unit.php' method="post">
									<div class="12u$" style='margin-bottom:20px'>
						
									</div>
									<div class="12u$" style="margin-bottom:20px">
										<input type="submit" class="special" value="Enter details of my unit" />
									</div>
								</form>
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
