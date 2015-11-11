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

	if(!isset($_POST["unitcode"]) || !isset($_POST["unitname"]))
	{
		//invalid request, redirects to
		header("location:create_unit.php");
		die();
	}

	//global errors
	$errors = "";
	
	// Validate Name 
	function uname($value)
	{
		global $errors;
		global $validator;
		if(strlen($value)<=0)
		{
			$errors .= "<li>Unit name is empty</li>";
		}
		if(!$validator->CheckValidName($value))
		{
			$errors .= "<li>Only letters and spaces allowed in Unit name</li>";
		} 
		if(! $validator->CheckValueInRange(strlen($value),1,50))
		{
			$errors  .= "<li>Unit name is too long. Please keep it less than 50 characters</li>";
		}
		if(strlen($errors)>0) return false;
		return true;			
	}
	
	//Validate Code
	function ucode($value)
	{
		global $errors;
		global $validator;
		if(strlen($value)<=0)
		{
			$errors .= "<li>Unit code is empty</li>";
		}
		if(! $validator->CheckValueInRange(strlen($value),1,50))
		{
			$errors  .= "<li>Unit code is too long. Please keep it less than 50 characters</li>";
		}
		if(strlen($errors)>0) return false;
		return true;			
	}	
	

	//Sanatise ALL the Data :D
	$i_uname = $sanitiser->sanitise($_POST["unitname"]);
	$i_ucode = $sanitiser->sanitise($_POST["unitcode"]);
	
	//Start Validating :D
	$valid = true;
	$valid = uname($i_uname) && $valid;
	$valid = ucode($i_ucode) && $valid;

	if (!$valid) {
		header("location:create_unit.php?errors=$errors");
		die();
	}
	else
	{
		//check if the unit already exist
		$email = $_SESSION['username'];
		include_once "settings.php";
		$conn = mysqli_connect($host, $user, $pwd, $sql_db);

		if (!$conn)
		{
			header("location:error.php?type=database");
			die();
		}
		
		$universityID = $_SESSION['u_university'];
		$query = "SELECT * FROM Unit u NATURAL JOIN CourseUnit cu NATURAL JOIN Course c NATURAL JOIN University uni WHERE UniversityID = '$universityID';";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);

		if($result)
		{
			$duplicateID = $row['UnitID'];
			$duplicateName = $row['UnitName'];
			$duplicateCode = $row['UnitCode'];
			if($duplicateCode==$i_ucode)
			{
				$_SESSION['temp_duplicateId'] = $duplicateID ;
				$_SESSION['temp_duplicateName'] = $duplicateName ;
				$_SESSION['temp_duplicateCode'] = $duplicateCode ;
				header("location:select_unit.php?duplicate=true");
				die();
			}
		}

		//no duplicate found, good to go
		//insert data to database
		$query = "INSERT INTO University (UniversityName, Location, Website) VALUES ('$i_uname', '$i_ucountry', '$i_uwebsite')";
		$result = @mysqli_query($conn, $query);
		if(!$result)
		{
			header("location:error.php");
			die();
		}

		$query = "SELECT * FROM University WHERE UniversityName='$i_uname' AND Website='$i_uwebsite'AND Location='$i_ucountry';";
		$result = @mysqli_query($conn, $query);
		
		if(!$result)
		{
			header("location:error.php");
			die();
		}

		$row = mysqli_fetch_assoc($result);
		$_SESSION['selectedUni']=$row['UniversityID'];
		//and redirect to verify page
		
		header("location:select_university_process.php");
	}
?>
	

