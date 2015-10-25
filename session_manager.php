<?php
	//from register process
	if($key != '"V#(s30@Y*9#f92l_U3t,|,%845723')
	{
		header("location:error.php?type=unauthorized");
		die();
	}

	if(isset($i_firstname,$i_lastname,$i_email,$i_dob,$i_sex,$i_country,$i_tos))
	{
		$_SESSION['i_firstname']=$i_firstname;
		$_SESSION['i_lastname']=$i_lastname;
		$_SESSION['i_email']=$i_email;
		$_SESSION['i_dob']=$i_dob;
		$_SESSION['i_sex']=$i_sex;
		$_SESSION['i_country']=$i_country;
		$_SESSION['i_phone']=$i_phone;
		$_SESSION['i_adress']=$i_adress;
		$_SESSION['i_tos']=$i_tos;
	}
		
?>