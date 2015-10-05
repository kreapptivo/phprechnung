<?php

//Test für phpUnit
class VerifyTest extends PHPUnit_Framework_TestCase {
  public function test_falseIfNoAtSign() {
    $actual = Verify::checkEmail('manuel.kiessling.net');
    $this->assertFalse($actual);
  }
}
