<?php
	$to =  $_SESSION['username'];
	$subject = "Verify - AssignmentBuddy";
	$emailCode = $_SESSION['code'];
	$userFullname = $_SESSION['i_firstname'].' '.$_SESSION['i_lastname'];
	$message = "
		<html>
			<head>
				<title>Verify Your Account</title>
				<meta name='viewport' content='width=device-width, initial-scale=1' />
				<link rel='stylesheet' href='assignmentbuddy.xfastgames.com/assets/css/main.css' />
			</head>
			<body>
				<h1>Hello $userFullname!</h1>
				<p>Your code is $emailCode</p>
			</body>
		</html>
		";

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: <verifcation@assignmentbuddy.xfastgames.com>' . "\r\n";

	mail($to,$subject,$message,$headers);
?>