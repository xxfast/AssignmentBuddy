<?php
	$to =  $_SESSION['username'];
	$subject = "Verify - AssignmentBuddy";

	$message = "
		<html>
			<head>
				<title>Verify Your Account</title>
				<meta name='viewport' content='width=device-width, initial-scale=1' />
				<link rel='stylesheet' href='assignmentbuddy.xfastgames.com/assets/css/main.css' />
			</head>
			<body>
				<p>This email contains HTML Tags!</p>
				<table>
				<tr>
				<th>Firstname</th>
				<th>Lastname</th>
				</tr>
				<tr>
				<td>John</td>
				<td>Doe</td>
				</tr>
				</table>
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