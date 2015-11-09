<?php 
	session_start();
	
	if(!isset($_SESSION["username"]))
	{
		header("location:error.php?type=unauthorized");
		die();
	}

	if($_SESSION["username"]=='guest')
	{
		header("location:lobby_guest.php");
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
			$mode = 'unit';
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
						<h2>Browse the Lobby</h2>
						<p>Browse through the <?php echo "$mode";?>s we have in our database</p>
					</header>

					<!-- Table -->

						<section>
							<h3> 
								<div>
								<?php 
									switch ($mode) 
									{
									 	case 'unit':
									 		echo "<div align='left' style='width:50%, display:block'>Units</div>";
									 		break;
									 	case 'assignment':
									 		echo "<div align='left' style='width:50%, display:block'>Assignments</div>";
									 		echo "<div align='right' style='width:50%, display:block'><button onclick='goBack()''>< Back</button></div>";
									 		break;
									 	case 'group':
									 		echo "<div align='left' style='width:50%, display:block'>Groups</div>";
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
													case 'unit':
														echo "<th>Unit Code</th><th>Unit Name</th>";
														break;
													case 'assignment':
														echo "<th>Assignment Name</th>";
														break;
													case 'group':
														echo "<th>Owner</th><th>Description</th><th>Target</th><th>Members</th>";
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
											if($mode=='unit')
											{
												$courseID = $_SESSION["u_course"];
												$query = "SELECT * FROM Unit u NATURAL JOIN CourseUnit cu WHERE cu.CourseID='$courseID';";
												$result = @mysqli_query($conn, $query);
												$row = mysqli_fetch_assoc($result);
												while ($row) 
												{
													echo "<tr>";
													echo "<td>{$row['UnitCode']}</td>";
													echo "<td>{$row['UnitName']}</td>";
													$unitID = $row['UnitID'];
													echo "<td align='right'><a href='lobby.php?view=assignment&unit=$unitID'' class='button alt'>Browse</a></td>";
													echo "</tr>";
													$row = mysqli_fetch_assoc($result);
												}
												$result = @mysqli_query($conn, $query);
												$row = mysqli_fetch_assoc($result);
												if(!$row)
												{
													echo "<tr>";
													echo "<td><em>No Units has registed for this course yet</em></td>";
													echo "<td>-</td>";
													echo "</tr>";
												}
											}
											else if($mode=='assignment')
											{
												require_once 'unit_tests/classes/sanitiser.php'; // create sanitise objects
												$sanitiser = new Sanitiser();
												$unitID = $sanitiser->sanitise($_GET['unit']);
												$query = "SELECT * FROM Assignment a NATURAL JOIN Unit u WHERE UnitID='$unitID';";
												$result = @mysqli_query($conn, $query);
												$row = mysqli_fetch_assoc($result);
												while ($row) 
												{
													echo "<tr>";
													echo "<td>{$row['AssignmentTitle']}</td>";
													$assignmentID = $row['AssignmentID'];
													echo "<td align='right'><a href='lobby.php?view=group&assignment=$assignmentID' class='button alt'>Browse</a></td>";
													echo "</tr>";
													$row = mysqli_fetch_assoc($result);
												}
												$result = @mysqli_query($conn, $query);
												$row = mysqli_fetch_assoc($result);
												if(!$row)
												{
													echo "<tr>";
													echo "<td><em>No Assignments has been registed for this unit yet</em></td>";
													echo "<td>-</td>";
													echo "</tr>";
												}
											}
											else if($mode=='group')
											{
												require_once 'unit_tests/classes/sanitiser.php'; // create sanitise objects
												$sanitiser = new Sanitiser();
												$assignmentID = $sanitiser->sanitise($_GET['assignment']);
												$query = "SELECT * FROM Groups g NATURAL JOIN Assignment a NATURAL JOIN Student s WHERE a.AssignmentID='$assignmentID' AND g.AdminID=s.StudentID;";
												$result = @mysqli_query($conn, $query);
												$row = mysqli_fetch_assoc($result);
												while ($row) 
												{
													echo "<tr>";
													echo "<td>{$row['FirstName']} {$row['LastName']}</td>";
													echo "<td>{$row['Description']}</td>";
													$groupID = $row['GroupID'];
													echo "<td>{$row['Target']},$groupID</td>";
													//Get count of students
													$queryC = "SELECT COUNT(*) AS 'number' FROM StudentGroup sg WHERE GroupID='$groupID' AND Approved=1 GROUP BY GroupID;";
													$resultC = @mysqli_query($conn, $queryC);
													$rowC = mysqli_fetch_assoc($resultC);
													echo "<td align='right'>{$rowC['number']}/{$row['MemberCount']}</td>";
													echo "<td align='right'><a href='view_group.php?group='$groupID'>Join</a></td>";
													echo "</tr>";
													$row = mysqli_fetch_assoc($result);
												}
												$result = @mysqli_query($conn, $query);
												$row = mysqli_fetch_assoc($result);
												if(!$row)
												{
													echo "<tr>";
													echo "<td><em>No Groups has been registed for this Assignment yet</em></td>";
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