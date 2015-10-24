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
		return preg_match("/(0[1-9]|1[0-9]|2[0-9]|3[01])-(0[1-9]|1[012])-[0-9]{4}/i", $value);
	}

	public function CheckValidSex($value)
	{
		return ($value=="male" || $value=="female");
	}


}

?>