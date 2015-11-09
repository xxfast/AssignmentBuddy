<?php
	session_start();
	if (!isset($_SESSION["username"])) {
		//unauthorized request, redirects to
		header("location:error.php?type=unauthorized");
		die();
	}

	if($_SESSION["username"]=="guest")
	{
		//no guest is allowed
		header("location:error.php?type=unauthorized");
		die();
	}

	if(!isset($_GET['group']))
	{
		//invalid request
		header("location:lobby.php");
		die();
	}
	
	require_once 'unit_tests/classes/sanitiser.php'; // create sanitise objects
	$sanitiser = new Sanitiser();

	$groupID = $sanitiser->sanitise($_GET['group']);
	

	include_once "settings.php";
	$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
	
	if(!$conn)
	{
		//no database :(
		header("location:error.php?type=database");
		die();
	}
	
	$query = "SELECT * FROM Groups WHERE GroupID='$groupID';";
	$result = @mysqli_query($conn, $query);
	$group = mysqli_fetch_assoc($result);

	$assignmentID = $group['AssignmentID'];
	$query = "SELECT * FROM Assignment WHERE AssignmentID='$assignmentID';";
	$result = @mysqli_query($conn, $query);
	$assignment = mysqli_fetch_assoc($result);

	$unitID = $assignment['UnitID'];
	$query = "SELECT * FROM Unit WHERE UnitID='$unitID';";
	$result = @mysqli_query($conn, $query);
	$unit = mysqli_fetch_assoc($result);

	$ownerID = $group['AdminID'];
	$query = "SELECT StudentId, FirstName, LastName FROM Student WHERE StudentID='$AdminID';";
	$result = @mysqli_query($conn, $query);
	$student = mysqli_fetch_assoc($result);
	
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>View Group</title>
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
				<div align='left' style='width:50%, display:block'><button onclick='goBack()'>< Back</button></div>
				<div class='gstarting'>
					<h2>View Group</h2>
				<div>
				<article class="feature right">
					<div class="content">
						<form method="post" action="#">
							<div class="row uniform 50%">
								<div class="6u 12u$(xsmall)">
									<input type="text" name="assignmentTitle" id="assignmentTitle" value="<?php echo $assignment['AssignmentTitle']; ?>" placeholder='Assignment Title' readonly='readonly'/>
								</div>

								<div class="6u 12u$(xsmall)">
									<input type="text" name="unitcode" id="unitcode" value="<?php echo $unit['UnitCode']; ?>" placeholder="Unit Code" readonly='readonly'/>
								</div>

								<div class="12u$">
									<textarea name="description" id="description" value="<?php  echo $group['Description']; ?>" placeholder="Group description" rows="6" readonly='readonly'></textarea>
								</div>
								
								<div class="4u 12u$(xsmall)" style="height: 55px; line-height: 55px;">
									<p>Group Owned by:</p>
								</div>
								<div class="8u 12u$(xsmall)">
									<input type="text" name="OwnerName" id="OwnerName" value="<?php  echo $student['FirstName'].' '.$student['LastName']; ?>" placeholder="Admin Name" readonly='readonly'/>
								</div>
								<div class="6u 12u$(xsmall)" style="height: 55px; line-height: 55px;">
									
								</div>

								<div class="2u 12u$(xsmall)" style="height: 55px; line-height: 55px;">
									<p>Target:</p>
								</div>
								<div class="4u 12u$(xsmall)">
									<input type="text" name="target" id="target" value="<?php  echo $group['Target']; ?>" placeholder="C/P/D/HD" readonly='readonly'/>
								</div>

								<div class="12u$" style="text-align:left; height: 35px; line-height: 55px;">
									<h4>Members (1/4)</h4>
								</div>

								<div class="12u$">
									<input type="text" name="unitid" id="unitid" value="" placeholder="Member" readonly='readonly'/>
								</div>

								<div class="12u$">
									<ul class="actions">
										<li><input type="submit" value="Send Request to Join" class="special" /></li>
									</ul>
								</div>
							</div>
						</form>
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
			<script>
			function goBack() 
			{
				window.history.back();
			}
			</script>
	</body>
</html>
