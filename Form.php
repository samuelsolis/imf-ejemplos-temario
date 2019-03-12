<?php
require_once ("Countries.php");

/**
 * Form Controller.
 *
 * Class Form
 */
class Form {

  // Form inputs.
  protected $key;
  protected $value;
  protected $filter;

  // Form data.
  protected $data;

  public function __construct() {
    $this->key = $_GET['key'] ?: '';
    $this->value = $_GET['value'] ?: '';
    $this->filter = $_GET['filter'] ?: '';
    $this->data = new Countries();;
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

  /**
   * Show Form results.
   *
   * @return array|string
   */
  public function getElements() {
    if ($this->key != '') {
      $elements = $this->data->searchByKey($this->key);
    }

    if ($this->value != '') {
      $elements = $this->data->searchByValue($this->value);
    }

    if ($this->filter != '') {
      $elements = $this->data->filter($this->filter);
    }

    if (!isset($elements)) {
      $elements = $this->data->getAll();
    }

    return $elements;
  }
}