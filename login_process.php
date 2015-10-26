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
	$password = md5($_POST["Password"]); // dont sanitise passwords
	
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
	$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

	$query = "SELECT firstName, email, password FROM Student WHERE email='$email'";
	$result = @mysqli_query($conn, $query);
	
	if(!$conn)
	{

	}

	if(!$result)
	{

	}
		$row = mysqli_fetch_assoc($result);
		if($row['password']==$password){
				$_SESSION["email"] = $email;
				$_SESSION["name"] = $row['firstName'];
				echo "<p class='error'> Correct password </p>";
				header("location:index.php");
		}else{
			header("location:login.php?error='Wrong username password combination'");
		}
	}else{
		header("location:login.php?error=Cant connect to database, please try again");
	}
?>