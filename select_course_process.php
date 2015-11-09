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

	if(!isset($_POST['selectedCourse']))
	{
		if(!isset($_SESSION['selectedCourse']))
		{
			//invalid request
			header("location:select_university.php");
			die();
		}
	}

	if(isset($_POST['selectedCourse'])) $selectedCourse = $_POST['selectedCourse'];
	if(isset($_SESSION['selectedCourse'])) $selectedCourse = $_SESSION['selectedCourse'];

	$email = $_SESSION['username'];
	include_once "settings.php";
	$conn = mysqli_connect($host, $user, $pwd, $sql_db);

	if (!$conn)
	{
		header("location:error.php?type=database");
		die();
	}

	$query = "UPDATE Student SET CourseID='$selectedCourse' WHERE Email='$email';";
	$result = mysqli_query($conn, $query);
	
	if(!$result)
	{
		header("location:error.php");
		die();
	}

	$_SESSION["u_course"] = $selectedCourse;

	header("location:success.php?course=set");
	die();

?>