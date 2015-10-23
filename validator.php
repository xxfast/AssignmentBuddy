<?php

/**
* validator.php
* -----------------
* An object that can validate data, so they are
* not invalid 
* @~author : Isuru 
*/

class Validator
{
	function __construct()
	{
		
	}

	public function CheckValidEmail($email)
	{
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}

	public function CheckValidEmailWithDomain($email, $domain)
	{
		return preg_match("/$domain/i", $email);
	}

	public function CheckValidName($name)
	{
		return preg_match("/[a-z A-Z]+/i", $name);
	}


}

?>