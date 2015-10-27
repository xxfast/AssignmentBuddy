<?php
	session_start();

	//check valid request
	if (isset($_SESSION["username"])) {
		//problamatic request, redirects to
		header("location:error.php?type=already-verfied");
		die();
	}

	if (!isset($_SESSION["i_email"])) {
		//invalid request, redirects to
		header("location:error.php?type=unauthorized");
		die();
	}

	if(!isset($_POST["password"]))
	{
		//invalid request, redirects to
		header("location:error.php?type=unauthorized");
		die();
	}

	require_once 'unit_tests/classes/validator.php'; // create sanitise objects
	require_once 'unit_tests/classes/sanitiser.php'; // create sanitise objects
	
	$sanitiser = new Sanitiser();
	$validator = new Validator();

	$password = $_POST["password"];

	if(!$validator->CheckValidPassword($password))
	{
		header("location:create_user.php?error=invalid");
		die();
	}

	//hash the passwords
	$password = md5($password);

	//get session information
	$i_email = $_SESSION['$i_email'];
	$i_firstname = $_SESSION['i_firstname'];
	$i_lastname = $_SESSION['i_lastname'];
	$i_email = $_SESSION['i_email'];
	$i_dob = $_SESSION['i_dob'];
	$i_sex = $_SESSION['i_sex'];
	$i_country = $_SESSION['i_country'];
	$i_phone = $_SESSION['i_phone'];
	$i_adress = $_SESSION['i_adress'];

	include_once "settings.php";

	//establish connection
	$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
	
	if (!$conn)
	{
		header("location:error.php?type=database");
		die();
	}

	//setup query
	$query = "INSERT INTO Student (Email, Password, FirstName, LastName, DOB, Gender, TellNo, Address, Country) VALUES ('$i_email', '$password', '$i_firstname','$i_lastname','$i_dob','$i_sex','$i_phone','$i_adress','$i_country')";
	$result = @mysqli_query($conn, $query);

	if(!$result)
	{
		header("location:error.php");
		die();
	}

	header("location:success.php");
?>