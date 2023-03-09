<?php

use PHPUnit\Framework\TestCase;
require_once('Form.php');
require_once('Countries.php');

class testForm extends TestCase{

  public function testGetKey(){

    // Create a stub for the SomeClass class.
    $countriesMock = $this->getMockBuilder(Countries::class)
      ->onlyMethods(['searchByKey', 'searchByValue', 'getAll', 'filter'])
      ->getMock();

    // Configure the Mock with the interface operations.
    $countriesMock
      ->expects($this->any())
      ->method('searchByKey')
      ->willReturn(['ES' => 'Spain']);

    $countriesMock
      ->expects($this->any())
      ->method('searchByValue')
      ->willReturn(['ES' => 'Spain']);

    $countriesMock
      ->expects($this->any())
      ->method('getAll')
      ->willReturn(['ES' => 'Spain']);

    $countriesMock
      ->expects($this->any())
      ->method('filter')
      ->willReturn(['ES' => 'Spain']);

    $form = new Form($countriesMock);
    $form->setKey('ES');
    $this->assertEquals('ES', $form->getKey());
  }
}