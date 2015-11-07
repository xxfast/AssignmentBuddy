<?php

$path = realpath(dirname(__FILE__));
$path .= '/phpunit/autorun.php';
require_once($path);
$path = realpath(dirname(__FILE__));
$path .= '/classes/validator.php';
require_once($path);
$path = realpath(dirname(__FILE__));
$path .= '/classes/sanitiser.php';
require_once($path);

class TestOfLogging extends UnitTestCase 
{

    function TestInvalidEmail() {
    	$validator = new Validator();
    	$this->assertTrue($validator->CheckValidEmail('test@test.com'));
    	$this->assertFalse($validator->CheckValidEmail('testtest.com'));
    }

    function TestInvalidEmailWithDomain() {
		$validator = new Validator();
		$this->assertTrue($validator->CheckValidEmailWithDomain('test@test.com','.com'));
		$this->assertFalse($validator->CheckValidEmailWithDomain('testtest.com','.edu'));
    }

    function TestInvalidUniversityEmail() {
		$validator = new Validator();
		$this->assertTrue($validator->CheckValidEmailWithDomain('test@test.edu.au','.edu'));
		$this->assertFalse($validator->CheckValidEmailWithDomain('testtest.com','.edu'));
    }

    function TestInvaidNames() {
        $validator = new Validator();
        $sanitiser = new Sanitiser(); // tested with the sanitiser
        $name = $sanitiser->sanitise('Isuru Kusumal Rajapakse');
        $this->assertTrue(1==$validator->CheckValidName($name));
        $name = $sanitiser->sanitise('<h1>troll name</h1>');
        $this->assertFalse(1==$validator->CheckValidName("$name"));
    }

    function TestInvaidDate()
    {
        $validator = new Validator();
        $this->assertTrue(1==$validator->CheckValidDate("1990-01-1"));
        $this->assertTrue(1==$validator->CheckValidDate("1994-01-12"));
        $this->assertFalse(1==$validator->CheckValidDate("42-02-1994"));
        $this->assertFalse(1==$validator->CheckValidDate("42-0x-1994"));
    }

    function TestInvaidSex() //lol :p
    {
        $validator = new Validator();
        $this->assertTrue(1==$validator->CheckValidSex("male"));
        $this->assertTrue(1==$validator->CheckValidSex("female"));
        $this->assertFalse(1==$validator->CheckValidSex("pig"));
        $this->assertFalse(1==$validator->CheckValidSex("tree"));
    }

    function TestInvalidPassword() 
    {
        $validator = new Validator();
        $this->assertTrue(1==$validator->CheckValidPassword("AS2#fjas91"));
        $this->assertTrue(1==$validator->CheckValidPassword("asD@#r345f"));
        $this->assertFalse(1==$validator->CheckValidPassword("password"));
        $this->assertFalse(1==$validator->CheckValidPassword("test"));
    }

    function TestInvalidCountry() 
    {
        $validator = new Validator();
        $this->assertTrue(1==$validator->CheckValidCountry("LK"));
        $this->assertTrue(1==$validator->CheckValidCountry("US"));
        $this->assertFalse(1==$validator->CheckValidCountry("Lanka"));
        $this->assertFalse(1==$validator->CheckValidCountry("Australia"));
    }
	
	function TestInvalidAddres() 
    {
        $validator = new Validator();
        $this->assertTrue(1==$validator->CheckValidAddress("Point Cook"));
        $this->assertTrue(1==$validator->CheckValidAddress("Hawthorn East"));
        $this->assertFalse(1==$validator->CheckValidAddress("G@@@@lenferrie *(7 Hawthorn"));
        $this->assertFalse(1==$validator->CheckValidAddress("hjagsdhjtest()*(*##Q()*#(@"));
    }
	
	function TestInvalidAddress()
	{
        $this->assertTrue(1==1);
	}
}
?>