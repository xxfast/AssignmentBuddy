<?php
	session_start();
	if (isset($_SESSION["username"])) {
		//problamatic request, redirects to
		header("location:error.php?type=already-verfied");
		die();
	}

	if (!isset($_SESSION["i_email"])) {
		//invalid request, redirects to
		header("location:error.php?type=unauthorized");
		die();
	}

	require_once 'unit_tests/classes/sanitiser.php'; // create sanitise objects
	
	$sanitiser = new Sanitiser();
	
	$post_code = $sanitiser->sanitise($_POST['code']);

	if($_SESSION['code']==$post_code)
	{
		header("location:create_user.php");
		die();
	}else
	{
		header("location:verify.php?error=invalid");
		die();
	}

?>