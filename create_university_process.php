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
	if ($_SESSION["username"]=='guest') {
		//guests cant create universities 
		header("location:error.php?type=unauthorized");
		die();
	}

	if(!isset($_POST["uname"]) || !isset($_POST["uweb"]) || !isset($_POST["pcountry"]))
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
			$errors .= "<li>Please enter a valid webaddress</li>";
			return false;
		}
		return true;			
	}		
	
	//Validate dob
	function ucountry($value)
	{
		return $value!='';
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
		die();
	}
	else
	{
		//check if the university already exist
		$email = $_SESSION['username'];
		include_once "settings.php";
		$conn = mysqli_connect($host, $user, $pwd, $sql_db);

		if (!$conn)
		{
			header("location:error.php?type=database");
			die();
		}
		
		$query = "SELECT * FROM University WHERE Website LIKE '%$i_uwebsite';";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);

		if(count($row)>0)
		{
			$duplicateID = $row['UniversityID']
			$duplicateName = $row['UniversityName'];
			$duplicateWebAddress = $row['Website'];
			$duplicateCountry = $row['Location'];
			if($duplicateName==$i_uname && $duplicateWebAddress==$i_uwebsite && $duplicateCountry == $i_ucountry)
			{
				$_SESSION['temp_duplicateName'] = $duplicateName ;
				$_SESSION['temp_duplicateWebAddress'] = $duplicateWebAddress;
				$_SESSION['temp_duplicateCountry'] = $duplicateCountry ;
				header("location:select_university.php?duplicate=true");
				die();
			}
		}

		//insert data to database
		$query = "INSERT INTO University (UniversityName, Location, Website) VALUES ('$i_uname', '$i_uwebsite', '$i_ucountry')";
		$result = @mysqli_query($conn, $query);

		if(!$result)
		{
			header("location:error.php");
			die();
		}

		//and redirect to verify page
		header("location:verify.php");
	}
?>
	

