<?php
require_once('../phpunit/autorun.php');
require_once('../validator.php');

class TestOfLogging extends UnitTestCase {

    function TestInvalidEmail() {
       $this->assertTrue(false);
    }
}
?>