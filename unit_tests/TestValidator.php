<?php

$path = realpath(dirname(__FILE__));
$path .= '/phpunit/autorun.php';
require_once($path);
$path = realpath(dirname(__FILE__));
$path .= '/classes/validator.php';
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
}
?>