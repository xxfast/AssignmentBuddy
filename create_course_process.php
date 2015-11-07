<?php
	
	session_start();
	
	require_once 'unit_tests/classes/sanitiser.php'; // create sanitise objects
	require_once 'unit_tests/classes/validator.php'; // create sanitise objects
	
	$sanitiser = new Sanitiser();
	$validator = new Validator();

	$email = null;
	if (!isset($_SESSION["username"])) {
		//problamatic request, redirects to
		//header("location:error.php?type=unauthorized");
		//die();
	}
	if ($_SESSION["username"]=='guest') {
		//guests cant create universities 
		//header("location:error.php?type=unauthorized");
		//die();
	}

	if(!isset($_POST["ccode"]) || !isset($_POST["cname"]))
	{
		//invalid request, redirects to
		//header("location:create_course.php?error='invalid request'");
		//die();
	}

	//global errors
	$errors = "";
	
	// Validate firstName 
	function cname($value)
	{
		global $errors;
		global $validator;
		if(strlen($value)<=0)
		{
			$errors .= "<li>Course name is empty</li>";
		}
		else if(!$validator->CheckValidName($value))
		{
			$errors .= "<li>Only letters and spaces allowed in Course name</li>";
		} 
		else if(! $validator->CheckValueInRange(strlen($value),1,50))
		{
			$errors  .= "<li>Course name is too long. Please keep it less than 50 characters</li>";
		}
		if(strlen($errors)>0) return false;
		return true;			
	}
	
	function ccode($value)
	{
		global $errors;
		global $validator;
		if(strlen($value)<=0)
		{
			$errors .= "<li>Course code is empty</li>";
		}
		else if(! $validator->CheckValueInRange(strlen($value),1,50))
		{
			$errors  .= "<li>Course code is too long. Please keep it less than 50 characters</li>";
		}
		if(strlen($errors)>0) return false;
		return true;			
	}	
	

	//Sanatise ALL the Data :D
	$i_ccode = $sanitiser->sanitise($_POST["ccode"]);
	$i_cname = $sanitiser->sanitise($_POST["cname"]);
	
	//Start Validating :D
	$valid = true;
	$valid = cname($i_cname) && $valid;
	$valid = ccode($i_ccode) && $valid;

	if (!$valid) {
		header("location:create_course.php?errors=$errors");
		die();
	}

	//check if the university already exist
	$email = $_SESSION['username'];
	$u_university = $_SESSION['u_university'];
	include_once "settings.php";
	$conn = mysqli_connect($host, $user, $pwd, $sql_db);

	if (!$conn)
	{
		header("location:error.php?type=database");
		die();
	}
	
	$query = "SELECT * FROM Course WHERE CourseCode LIKE '%$i_ccode';";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);

	if(count($row)>0)
	{
		$duplicateCode = $row['CourseCode'];
		$duplicateName = $row['CourseName'];
		if($duplicateCode==$i_ccode)
		{
			$_SESSION['temp_duplicateCode'] = $duplicateCode ;
			$_SESSION['temp_duplicateName'] = $duplicateName ;
			header("location:select_course.php?duplicate=true");
			die();
		}
	}

	//insert data to database
	$query = "INSERT INTO Course (CourseCode, CourseName, UniversityID) VALUES ('$i_ccode', '$i_cname', '$u_university')";
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
	$_SESSION['selectedCourse']=$row['CourseID'];
	//and redirect to verify page
	header("location:select_course_process.php");
?>
	

