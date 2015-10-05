<?php

require_once 'mink.phar';

class MinkTestCase extends PHPUnit_Framework_TestCase
{
  function setUp()
  {
    $this->driver = new \Behat\Mink\Driver\GoutteDriver();
    $this->session = new \Behat\Mink\Session($this->driver);
    $this->session->start();
  }
 
  function tearDown()
  {
    $this->session->stop();
  }
}
