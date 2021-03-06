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

	if(!isset($_SESSION["u_course"]))
	{
		//no course? weird
		header("location:select_course.php");
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
		$courseID = $_SESSION['u_course'];
		$universityID = $_SESSION['u_university'];

		include_once "settings.php";
		$conn = mysqli_connect($host, $user, $pwd, $sql_db);

		if (!$conn)
		{
			header("location:error.php?type=database");
			die();
		}
		
		//checking for duplicate
		$universityID = $_SESSION['u_university'];
		$query = "SELECT * FROM Unit u NATURAL JOIN CourseUnit cu NATURAL JOIN Course c NATURAL JOIN University uni WHERE UniversityID = '$universityID' AND UnitCode = '$i_ucode';";
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
		$query = "INSERT INTO Unit (UnitCode, UnitName) VALUES ('$i_ucode', '$i_uname')";
		$result = @mysqli_query($conn, $query);
		if(!$result)
		{
			header("location:error.php");
			die();
		}

		//checking if it made it
		$query = "SELECT * FROM Unit u ORDER BY UnitID DESC LIMIT 1;";
		$result = @mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
	
		
		if(!$result)
		{
			header("location:error.php");
			die();
		}

		

		$unitID = $row['UnitID'];
		$_SESSION['selectedUnit']=$unitCode;

		//update CourseUnit Table to add the new subject to user's course
		$courseID = $_SESSION["u_course"];

		$query = "INSERT INTO CourseUnit (CourseID, UnitID) VALUES ('$courseID', '$unitID')";
		$result = mysqli_query($conn, $query);
		

		if(!$result)
		{
			header("location:error.php");
			die();
		}

		//and redirect to verify page
		header("location:select_unit_process.php");
	}
?>
	

