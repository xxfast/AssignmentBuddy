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
		return preg_match("/^([A-Za-z ]+)$/", $name);
	}

	public function CheckValueInRange($value, $min, $max)
	{
		return (($value>=$min) && ($value<=$max));
	}

	public function CheckValidDate($value)
	{
		return preg_match("/^[0-9]{4}-(0[1-9]|1[012]|[0-9])-(0[1-9]|1[0-9]|2[0-9]|3[01]|[0-9])/i", $value);
	}

	public function CheckValidSex($value)
	{
		return ($value=="male" || $value=="female");
	}

	public function CheckValidPassword($value)
	{
		return preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/", $value);
	}

	public function CheckValidWebsite($value)
	{
		return preg_match_all('#[-a-zA-Z0-9:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9:%_\+.~\#?&//=]*)?#si', $value);
	}

	public function CheckValidCountry($value)
	{
		return preg_match("/^[A-Z]{2,3}$/",$value);
	}
	
	public function CheckValidAddress($value)
	{
		return preg_match("/^([A-Za-z ]+)$/",$value); //Address validation test
	}



}

?>