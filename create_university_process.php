<?php
	
	session_start();
	
	require_once 'unit_tests/classes/sanitiser.php'; // create sanitise objects
	require_once 'unit_tests/classes/validator.php'; // create sanitise objects
	
	$sanitiser = new Sanitiser();
	$validator = new Validator();

	$email = null;
	if (!isset($_SESSION["username"])) {
		//problamatic request, redirects to
		header("location:error.php?type=unauthorized");
		die();
	}

	if(!isset($_POST["uname"]))
	{
		//invalid request, redirects to
		header("location:create_university.php");
		die();
	}

	//global errors
	$errors = "";
	
	// Validate firstName 
	function uname($value)
	{
		global $errors;
		global $validator;
		if(strlen($value)<=0)
		{
			$errors .= "<li>University name is empty</li>";
		}
		if(!$validator->CheckValidName($value))
		{
			$errors .= "<li>Only letters and spaces allowed in University name</li>";
		} 
		if(! $validator->CheckValueInRange(strlen($value),1,50))
		{
			$errors  .= "<li>University name is too long. Please keep it less than 50 characters</li>";
		}
		if(strlen($errors)>0) return false;
		return true;			
	}
	
	//Validate LastName
	function uwebsite($value)
	{
		global $errors;
		global $validator;
		
		if(!$validator->CheckValidWebsite($value))
		{
			$errors .= "<li>Only letters and spaces allowed in last name</li>";
			return false;
		}
		return true;			
	}		
	
	//Validate dob
	function ucountry($value)
	{
		global $errors;
		global $validator;
		if(!$validator->CheckValidDate($value))
		{
			$errors .= "<li> Please enter your correct date of birth in the format dd-mm-yyyy</li>";
			return false; 
		} 
		else 
		{
			return true;
		}
	}	
	

	//Sanatise ALL the Data :D
	$i_uname = $sanitiser->sanitise($_POST["uname"]);
	$i_uwebsite = $sanitiser->sanitise($_POST["uweb"]);
	$i_ucountry = $sanitiser->sanitise($_POST["pcountry"]);
	
	//Start Validating :D
	$valid = true;
	$valid = uname($i_uname) && $valid;
	$valid = uwebsite($i_uwebsite) && $valid;
	$valid = ucountry($i_ucountry) && $valid; 

	if (!$valid) {
		header("location:create_university.php?errors=$errors");
	}
	else
	{
		//check user already exist
		$email = 'guest';
		include_once "settings_guest.php";
		$conn = mysqli_connect($host, $user, $pwd, $sql_db);

		if (!$conn)
		{
			header("location:error.php?type=database");
			die();
		}
		
		$query = "SELECT Email FROM Student WHERE Email='$i_email';";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);

		if(count($row)>0)
		{
			header("location:error.php?type=user-exist");
			die();
		}

		//set session info
		$_SESSION['i_firstname']=$i_firstname;
		$_SESSION['i_lastname']=$i_lastname;
		$_SESSION['i_email']=$i_email;
		$_SESSION['i_dob']=$i_dob;
		$_SESSION['i_sex']=$i_sex;
		$_SESSION['i_country']=$i_country;
		$_SESSION['i_phone']=$i_phone;
		$_SESSION['i_adress']=$i_adress;
		$_SESSION['i_tos']=$i_tos;

		//and redirect to verify page
		header("location:verify.php");
	}
?>
	

