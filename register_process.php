<?php
	
	session_start();
	
	require_once 'unit_tests/classes/sanitiser.php'; // create sanitise objects
	require_once 'unit_tests/classes/validator.php'; // create sanitise objects
	
	$sanitiser = new Sanitiser();
	$validator = new Validator();

	$email = null;
	if (isset($_SESSION["username"])) {
		$email = $_SESSION["username"];
		//problamatic request, redirects to
		header("location:error.php?type=already-registered");
		die();
	}

	if(!isset($_POST["pfname"]))
	{
		//invalid request, redirects to
		header("location:register_form.php");
		die();
	}

	require_once ("settings.php"); //connection info

	//global errors
	
	$errors = "";
	
	// Validate firstName 
	function fName($value)
	{
		global $errors;
		global $validator;
		if(strlen($value)<=0)
		{
			$errors .= "<li>Your first name is empty</li>";
		}
		if(!$validator->CheckValidName($value))
		{
			$errors .= "<li>Only letters and spaces allowed in first name</li>";
		} 
		if(! $validator->CheckValueInRange(strlen($value),1,20))
		{
			$errors  .= "<li>Please keep the first name less than 20 characters</li>";
		}
		if(strlen($errors)>0) return false;
		return true;			
	}
	
	//Validate LastName
	function lName($value)
	{
		global $errors;
		global $validator;
		if(strlen($value)<=0) 
		{
			$errors  .= "<li>Your last name is empty</li>";
		}
		if(!$validator->CheckValidName($value))
		{
			$errors .= "<li>Only letters and spaces allowed in last name</li>";
		} 
		if(! $validator->CheckValueInRange(strlen($value),1,20))
		{
			$errors .= "<li>Please keep the last name less than 20 characters</li>";
		}
		if(strlen($errors)>0) return false;
		return true;			
	}		
	
	//Validate dob
	function dob($value)
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
		
	//Validate gender
	function sex($value)
	{
		global $errors;
		global $validator;
		if($validator->CheckValidSex($value)) 
		{
			return true;
		}
		else
		{
			$errors .= "<li> Please Enter your Gender </li>";
			return false;
		}	
	}
				
	//Validate email 
	function email($value)
	{
		global $errors;
		global $validator;
		if(!$validator->CheckValidEmail($value)) 
		{
			$errors .= "<li> Invalid email format </li>"; 
			return false; 
		}
		else 
		{
			return true;
		}
	}

	//Validate tos 
	function tos()
	{
		global $errors;
		if(!isset($_POST["ptos"])) 
		{
			$errors .= "<li> Please agree for terms of service  </li>"; 
			return false; 
		}
		else 
		{
			return true;
		}
	}

	//Sanatise ALL the Data :D
	$i_firstname = $sanitiser->sanitise($_POST["pfname"]);
	$i_lastname = $sanitiser->sanitise($_POST["plname"]);
	$i_email = $sanitiser->sanitise($_POST["pemail"]);
	$i_dob = $sanitiser->sanitise($_POST["pdate"]."-".$_POST["pmonth"]."-".$_POST["pyear"]);
	if(isset($_POST["pgender"])) $i_sex = $sanitiser->sanitise($_POST["pgender"]); else $i_sex = '';
	$i_phone = $sanitiser->sanitise($_POST["pphone"]);
	$i_adress = $sanitiser->sanitise($_POST["padress"]);
	$i_country = $sanitiser->sanitise($_POST["pcountry"]);
	if(isset($_POST["ptos"])) $i_tos = $sanitiser->sanitise($_POST["ptos"]); else $i_tos = '';
	
	//Must agree to terms of service
	
	//Start Validating :D
	$valid = true;
	$valid = fName($i_firstname) && $valid;
	$valid = lName($i_lastname) && $valid;
	$valid = email($i_email) && $valid; 
	$valid = dob($i_dob) && $valid;
	$valid = sex($i_sex) && $valid;
	$valid = tos() && $valid; 
	

	if (!$valid) {
		header("location:register_form.php?errors=$errors");
	}else
	{
		//check user already exist
		$email = 'guest';
		include_once "settings.php";
		$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
		if (!$conn)
		{
			header("location:error.php?type=database");
			die();
		}
		$query = "SELECT * FROM Student WHERE Email='$i_email';";
		$result = @mysqli_query($conn, $query);
												
		if($result)
		{
			header("location:error.php?type=user-exist");
			die();
		}

		//set session info
		$key = '"V#(s30@Y*9#f92l_U3t,|,%845723';
		include_once 'session_manager.php';

		//and redirect to verify page
		header("location:verify.php");
	}
?>
	

