<?php
	
	session_start();
	
	require_once 'sanitiser.php'; // create sanitise objects
	require_once 'validator.php'; // create sanitise objects
	
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

	//Sanatise ALL the Data :D
	$i_firstname = $sanitiser->sanitise($_POST["pfname"]);
	$i_lastname = $sanitiser->sanitise($_POST["plname"]);
	$i_email = $sanitiser->sanitise($_POST["pemail"]);
	
	echo"<div id='resultsPage'>";
	echo"<h1>Hello $hfname $hlname, Welcome!</h1>";
	echo"<br/>";
	
	"<br/>";
	echo"</div>";

	$errors = "";
	
	// Validate firstName 
	function fName($value)
	{
		
		$fnlength = strlen($value);

		if($value=="") 
		{
			$errors += "Your first name is empty\n";
		}
		if(!preg_match("/^[a-zA-Z ]*$/",$value))
		{
			$errors += "Only letters and spaces allowed\n";
		} 
		if($fnlength > 12)
		{
			echo"<p>*First Name Cannot be more than 12 characters</p>";
		}
		else 
		{
			echo"<p></p>";
		}				
	}
	
	
	
	//Validate LastName
	function lName($value)
	{
		$lnlength = strlen($value);	
		
		if($value=="") 
		{
			echo "<p>*Please Enter your Last Name</p>";
			return false;
		}
		if(!preg_match("/^[a-zA-Z ]*$/",$value))
		{
			echo"<p>*Last Name: Only letters and spaces allowed.</p>";
			return false;
		} 
		if($lnlength > 20)
		{
			echo"<p>*Last Name Cannot be more than 20 characters</p>";
			return false;
		}
		else 
		{
			echo"<p></p>";
			return true;
			
		}			
	}
				

	
	
	//Validate dob
	function dob($value)
	{

		
		if(!preg_match('/^(19|20)\d\d([-])(0[1-9]|1[012])\2(0[1-9]|[12][0-9]|3[01])*$/',$value))
		{
			echo"<p>*Please Enter your Date of birth in the format yyyy-mm-dd.</p>";
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
		 
		if(!$value == '') 
		{
			echo "";
			return true;
		}
		else
		{
			echo "<p>*Please Enter your Gender</p>";
			return false;
		}
			
	}
				
	//Validate email 
	function email($value)
	{
		if(!filter_var($value,FILTER_VALIDATE_EMAIL)) 
		{
			echo"<p>*Invalid email format</p>"; 
			return false; 
		}
		else 
		{
			return true;
		}
	}
	
	
	//check whether the form fields in the register form are set
	if(isset($_POST["pfname"])) 
	{
		$firstname = sanitise($_POST["pfname"]);
		fName($firstname);
		$lastname = sanitise($_POST["plname"]);
		lName($lastname);
		$birth = sanitise($_POST["pdob"]);
		dob($birth);
		@$gender = sanitise($_POST["pgender"]);
		sex($gender);
		$email = sanitise($_POST["pemail"]); 
		//email($email);
	}
	
	// start the session
	if (!isset ($_SESSION["pemail"])) 
	{ // check if session variable exists
	$storedEmail = $email;
	$_SESSION["pemail"] = $email; // create and set the session variable
	}
	
	
	//echo "$firstname $lastname $birth $gender $street $town $state $email $postal $phone";
	if (@email($email))		
	{
		$query = "INSERT INTO $sql_table (fname, lname, dob, gender, email) 
		VALUES 
		('$firstname', '$lastname', '$birth', '$gender', '$email')";
		$result = mysqli_query($conn, $query);
			
	}	
	
?>
	

