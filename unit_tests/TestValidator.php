<?php
require_once('../phpunit/autorun.php');
require_once('../validator.php');

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