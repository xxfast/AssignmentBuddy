<?php 
	session_start();
	
	if(!isset($_SESSION["username"]))
	{
		header("location:error.php?type=unauthorized");
		die();
	}
	$email = $_SESSION["username"];
	include_once "settings.php";
	$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
	if (!$conn)
	{
		header("location:error.php?type=database");
		die();
	}
	else
	{
		if($email='guest')
		{
			$sql_table="University";
		}
	}
	if(!isset ($_SESSION["username"]))
	{
		header("location:login.php");
		die();
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Lobby</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
		<?php require ("header.php"); ?>

		<!-- Nav -->
		<?php require ("navigation.php"); ?>

		<!-- Main -->
		<?php 
			$mode = 'university';
			if(isset($_GET['view']))
			{
				require_once 'unit_tests/classes/sanitiser.php'; // create sanitise objects
				$sanitiser = new Sanitiser();
				$mode = $sanitiser->sanitise($_GET['view']);
			}
		?>

			<section id="main" class="wrapper">
				<div class="container">
					<header class="major special">
						<h2>Browse the Lobby as Guest</h2>
						<p>Browse through the <?php echo "$mode";?>s we have in our database</p>
					</header>

					<!-- Table -->

						<section>
							<h3> 
								<div>
								<?php 
									switch ($mode) 
									{
									 	case 'university':
									 		echo "<div align='left'>Universities</div>";
									 		break;
									 	case 'course':
									 		echo "<div align='left'  style='width:50%, display:block'>Course</div>";
									 		echo "<div align='right' style='width:50%, display:block'><button onclick='goBack()''>< Back</button></div>";
									 		break;
									 	case 'unit':
									 		echo "<div align='left' style='width:50%, display:block'>Units</div>";
									 		echo "<div align='right' style='width:50%, display:block'><button onclick='goBack()''>< Back</button></div>";
									 		break;
									 	default:
									 		echo "<div align='left' style='width:50%, display:block'>Browse</div>";
									 		echo "<div align='right' style='width:50%, display:block'><button onclick='goBack()''>< Back</button></div>";
									 		break;
									} 
								?>
								</div>	
							</h3>
							<div class="table-wrapper">
								<table>
									<thead>
										<tr>
											<?php 
												switch ($mode) {
													case 'university':
														echo "<th>Location</th><th>University</th>";
														break;
													case 'course':
														echo "<th>Course Code</th><th>Course</th>";
														break;
													case 'unit':
														echo "<th>Unit Code</th><th>Unit</th>";
														break;
													case 'assignment':
														echo "<th>Assignment Code</th><th>Unit</th>";
														break;
													default:
														# code...
														break;
												}
											?>
											
										</tr>
									</thead>
									<tbody>
										<?php
											if($mode=='university')
											{
												$query = "SELECT * FROM University;";
												$result = @mysqli_query($conn, $query);
												$row = mysqli_fetch_assoc($result);
												while ($row) 
												{
													echo "<tr>";
													echo "<td>{$row['Location']}</td>";
													echo "<td>{$row['UniversityName']}</td>";
													$universityID = $row['UniversityID'];
													echo "<td align='right'><a href='lobby_guest.php?view=course&university=$universityID'' class='button alt'>Browse</a></td>";
													echo "</tr>";
													$row = mysqli_fetch_assoc($result);
												}
												$result = @mysqli_query($conn, $query);
												$row = mysqli_fetch_assoc($result);
												if(!$row)
												{
													echo "<tr>";
													echo "<td><em>No universities has registed yet</em></td>";
													echo "<td>-</td>";
													echo "</tr>";
												}
											}
											else if($mode=='course')
											{
												require_once 'unit_tests/classes/sanitiser.php'; // create sanitise objects
												$sanitiser = new Sanitiser();
												$universityID = $sanitiser->sanitise($_GET['university']);
												$query = "SELECT * FROM Course NATURAL JOIN  University WHERE UniversityID='$universityID';";
												$result = @mysqli_query($conn, $query);
												$row = mysqli_fetch_assoc($result);
												while ($row) 
												{
													echo "<tr>";
													echo "<td>{$row['CourseCode']}</td>";
													echo "<td>{$row['CourseName']}</td>";
													$courseID = $row['CourseID'];
													echo "<td align='right'><a href='lobby_guest.php?view=unit&course=$courseID'' class='button alt'>Browse</a></td>";
													echo "</tr>";
													$row = mysqli_fetch_assoc($result);
												}
												$result = @mysqli_query($conn, $query);
												$row = mysqli_fetch_assoc($result);
												if(!$row)
												{
													echo "<tr>";
													echo "<td><em>No courses has been registed for this university yet</em></td>";
													echo "<td>-</td>";
													echo "</tr>";
												}
											}
											else if($mode=='unit')
											{
												require_once 'unit_tests/classes/sanitiser.php'; // create sanitise objects
												$sanitiser = new Sanitiser();
												$courseID = $sanitiser->sanitise($_GET['course']);
												$query = "SELECT * FROM Unit NATURAL JOIN CourseUnit WHERE CourseID='$courseID';";
												$result = @mysqli_query($conn, $query);
												$row = mysqli_fetch_assoc($result);
												while ($row) 
												{
													echo "<tr>";
													echo "<td>{$row['UnitCode']}</td>";
													echo "<td>{$row['UnitName']}</td>";
													$assignmentCode = $row['AssignmentCode'];
													echo "<td align='right'><span class='button disabled'>Register to view</span></td>";
													//echo "<td align='right'><a href='lobby_guest.php?view=assignment&assignment=$assignmentCode'' class='button alt'>Browse</a></td>";
													echo "</tr>";
													$row = mysqli_fetch_assoc($result);
												}
												$result = @mysqli_query($conn, $query);
												$row = mysqli_fetch_assoc($result);
												if(!$row)
												{
													echo "<tr>";
													echo "<td><em>No Units has been registed for this course yet</em></td>";
													echo "<td>-</td>";
													echo "</tr>";
												}
											}
										?>
									</tbody>
								</table>
							</div>
						</section>
				</div>
			</section>

		<!-- Footer -->
			<?php require ("footer.php"); ?>
			<?php mysqli_close($conn); ?>
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
			<script>
			function goBack() 
			{
				window.history.back();
			}
			</script>
	</body>
</html>