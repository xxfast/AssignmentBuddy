<?php
	session_start();
	if(!isset($_POST["username"]) || !isset($_POST["password"]))
	{
		header("location:login.php?error='Invalid request'");
		die();
	}

	require_once 'unit_tests/classes/sanitiser.php'; // create sanitise objects
	require_once 'unit_tests/classes/validator.php'; // create sanitise objects
	$sanitiser = new Sanitiser();
	$validator = new Validator();

	$email = $sanitiser->sanitise($_POST["username"]);
	$password = md5($_POST["password"]); // dont sanitise passwords
	
	if($email=='')
	{
		header("location:login.php?error='Please enter a valid email address'");
		die();
	}

	if($email=='guest')
	{
		$_SESSION["username"] = "guest";
		header("location:index.php");
		die();
	}

	include_once "settings.php";
	$sql_table="users";
	$conn = mysqli_connect($host, $user, $pwd, $sql_db);

	if(!$conn)
	{
		header("location:login.php?error=Cant connect to database, please try again");
		die();
	}

	$query = "SELECT Email FROM Student WHERE email='$email'";
	$result = @mysqli_query($conn, $query);

	if(!$result)
	{
		header("location:login.php?error='That username doesnt exist'");
		die();
	}

	$query = "SELECT * FROM Student WHERE email='$email'";
	$result = @mysqli_query($conn, $query);

	//set session
	$row = mysqli_fetch_assoc($result);
	if($row['Password']==$password)
	{
		session_destroy();
		session_start();
		$_SESSION["username"] = $email;
		$_SESSION["u_firstname"] = $row['FirstName'];
		$_SESSION["u_lastname"] = $row['LastName'];
		$_SESSION["u_dob"] = $row['TellNo'];
		$_SESSION["u_address"] = $row['Address'];
		$_SESSION["u_course"] = $row['CourseID'];
		$_SESSION["u_university"] = $row['UniversityID'];
		$_SESSION["u_gender"] = $row['Gender'];
		$_SESSION["u_country"] = $row['Country'];
		header("location:index.php");
	}
	else
	{
		header("location:login.php?error='Wrong password'");
		die();
	}

?>