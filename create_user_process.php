<?php
	session_start();

	//check valid request

	//set email request
	$email = $i_email;
	include_once "settings.php";

	//establish connection
	$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
	if (!$conn)
	{
		header("location:error.php?type=database");
		die();
	}

	//setup query
	$query = "INSERT INTO Student (Email, lastname, email) VALUES ('John', 'Doe', 'john@example.com')";
	$result = @mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
												

	if(!isset ($_SESSION["username"]))
	{
		header("location:login.php");
		die();
	}
?>