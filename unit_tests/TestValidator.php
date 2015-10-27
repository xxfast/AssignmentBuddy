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

class TestOfLogging extends UnitTestCase {

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
        $this->assertTrue(1==$validator->CheckValidDate("12-02-1994"));
        $this->assertTrue(1==$validator->CheckValidDate("20-02-2012"));
        $this->assertFalse(1==$validator->CheckValidDate("42-02-1994"));
        $this->assertFalse(1==$validator->CheckValidDate("1994-01-12"));
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

    function TestInvalidWebsites()
    {
        $validator = new Validator();
        $this->assertTrue(1==$validator->CheckValidWebsite("www.example.edu"));
        $this->assertTrue(1==$validator->CheckValidWebsite("www.example.net"));
        $this->assertFalse(1==$validator->CheckValidWebsite("test123"));
        $this->assertFalse(1==$validator->CheckValidWebsite(""));
    }

}
?>