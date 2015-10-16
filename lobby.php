<?php 
	session_start();
	if(!isset ($_SESSION["username"]))
	{
		header("location:login.php");
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
				$mode = $_GET['view'];
			}
		?>

			<section id="main" class="wrapper">
				<div class="container">
					<header class="major special">
						<h2>Lobby</h2>
						<p>Select the university you want to browse</p>
					</header>

					<!-- Table -->
					<?php
						$email = $_SESSION["username"];
						include_once "settings.php";
						$conn = mysqli_connect($host, $user, $pwd, $sql_db);
						if (!$conn)
						{
							echo "<p>Can't connect to server</>";
							die();
						}
						else
						{
							if($email='guest')
							{
								$sql_table="University";
							}
						}
					?>
						<section>
							<h3> 
								<?php 
									switch ($mode) 
									{
									 	case 'university':
									 		echo 'Universities';
									 		break;
									 	case 'course':
									 		echo 'Courses';
									 		break;
									 	case 'unit':
									 		echo 'Units';
									 		break;
									 	default:
									 		echo 'Browse';
									 		break;
									} 
								?>
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
													echo "<td><a href='lobby.php?view=course&university=$universityID'' class='button alt'>Browse</a></td>";
													echo "</tr>";
													$row = mysqli_fetch_assoc($result);
												}
											}
											else if($mode=='course')
											{
												$universityID = $_GET['university'];
												$query = "SELECT * FROM Course NATURAL JOIN  University WHERE UniversityID='$universityID';";
												$result = @mysqli_query($conn, $query);
												$row = mysqli_fetch_assoc($result);
												while ($row) 
												{
													echo "<tr>";
													echo "<td>{$row['CourseCode']}</td>";
													echo "<td>{$row['CourseName']}</td>";
													$courseID = $row['CourseID'];
													echo "<td><a href='lobby.php?view=unit&course=$courseID'' class='button alt'>Browse</a></td>";
													echo "</tr>";
													$row = mysqli_fetch_assoc($result);
												}
											}
											else if($mode=='unit')
											{
												$courseID = $_GET['course'];
												$query = "SELECT * FROM Unit NATURAL JOIN CourseUnit WHERE CourseID='$courseID';";
												$result = @mysqli_query($conn, $query);
												$row = mysqli_fetch_assoc($result);
												while ($row) 
												{
													echo "<tr>";
													echo "<td>{$row['UnitCode']}</td>";
													echo "<td>{$row['UnitName']}</td>";
													$assignmentCode = $row['AssignmentCode'];
													echo "<td><a href='lobby.php?view=assignment&assignment=$assignmentCode'' class='button alt'>Browse</a></td>";
													echo "</tr>";
													$row = mysqli_fetch_assoc($result);
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

	</body>
</html>