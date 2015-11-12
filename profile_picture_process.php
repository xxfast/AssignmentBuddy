<?php
	
	session_start();

	if (!isset($_SESSION["username"])) {
		//problematic request, redirects to
		header("location:error.php?type=unauthorized");
		die();
	}
	if ($_SESSION["username"]=='guest') {
		//problamatic request, redirects to
		header("location:error.php?type=unauthorized");
		die();
	}
	
	require_once 'unit_tests/classes/sanitiser.php'; // create sanitise objects
	require_once 'unit_tests/classes/validator.php'; // create sanitise objects
	
	$sanitiser = new Sanitiser();
	$validator = new Validator();

	$email = null;

	if(!isset($_POST["fileToUpload"]))
	{
		//invalid request, redirects to
		header("location:create_university.php");
		die();
	}

	//global errors
	$errors = "";
	
	// Validate firstName 
	$target_dir = "users/pictures/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;

	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) 
	{
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) 
	    {
	        $errors.=  "<li>File is an image - " . $check["mime"] . ".</li>";
	        $uploadOk = 1;
	    } 
	    else 
	    {
	        $errors.= "<li>File is not an image.</li>";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    $errors.=  "Sorry, file already exists.";
	    $uploadOk = 0;
	}

	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 2000000) {
	    $errors.= "Sorry, your file is too large.";
	    $uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) 
	{
	    $errors.= "<li>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</li>";
	    $uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) 
	{
	    $errors.= "<li>Sorry, your file was not uploaded because of above mentioned errors.</li>";
		// if everything is ok, try to upload file
	} 
	else 
	{
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
	    {
	        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	    } 
	    else 
	    {
	        $errors.= "<li>Sorry, there was an error uploading your file.<li>";
	    }
	}
		
	if($errors!="")
	{
		header("location:profile_picture.php?errors=$errors");
		die();
	}
	
	
?>
	

