<?php

class Form {
  private $key;
  private $value;
  private $filter;

  public function __construct() {
    $this->key = $_GET['key'] ?: '';
    $this->value = $_GET['value'] ?: '';
    $this->filter = $_GET['filter'] ?: '';
  }

  public function getKey(){
    return $this->key;
  }

  public function getValue() {
    return $this->value;
  }

  public function getFilter() {
    return $this->filter;
  }

  public function setKey($key) {
    $this->key = $key;
  }

  public function setValue($value) {
    $this->value = $value;
  }

  public function setFilter($filter) {
    $this->filter = $filter;
  }
}