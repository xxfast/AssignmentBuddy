<?php
	session_start();
	if (!isset($_SESSION["username"])) {
		//problamatic request, redirects to
		header("location:error.php?type=unauthorized");
		die();
	}

	//guests are not allowed here 
	if ($_SESSION["username"]=='guest') {
		//problamatic request, redirects to
		header("location:error.php?type=unauthorized");
		die();
	}

	if(!isset( $_SESSION['u_course']))
	{
		//user hasnt selected his course
		header("location:select_course.php");
		die();
	}

	if(!isset($_POST['selectedUnit']))
	{
		if(!isset($_SESSION['selectedUnit']))
		{
			//invalid request
			header("location:select_unit.php");
			die();
		}
	}

	require_once 'unit_tests/classes/sanitiser.php'; // create sanitise objects
	
	$sanitiser = new Sanitiser();

	if(isset($_POST['selectedUnit'])) $selectedUnit = $sanitiser->sanitise($_POST['selectedUnit']);
	if(isset($_SESSION['selectedUnit'])) $selectedUnit = $sanitiser->sanitise($_SESSION['selectedUnit']);

	$email = $_SESSION['username'];


	if(isset($_GET('makeconnection')))
	{
		//user's course has to be linked with this course
		include_once "settings.php";
		$conn = mysqli_connect($host, $user, $pwd, $sql_db);

		if (!$conn)
		{
			header("location:error.php?type=database");
			die();
		}

		$courseID =  $_SESSION['u_course'];

		$query = "INSERT INTO CourseUnit (CourseID,UnitID) VALUES ($courseID,$selectedUnit);";
		$result = mysqli_query($conn, $query);

		if(!$result)
		{
			header("location:error.php");
			die();
		}
	}

	//if selected unit hasnt been set yet, set it now
	if(!isset($_SESSION['selectedUnit']))) $_SESSION['selectedUnit']= $selectedUnit;

	header("location:create_group.php");
	die();

?>