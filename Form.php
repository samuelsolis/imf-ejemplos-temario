<?php
require_once ("CountriesInterfaz.php");

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

  /**
   * Form constructor.
   */
  public function __construct(CountriesInterfaz $countries) {
    $this->key = $_GET['key'] ?: '';
    $this->value = $_GET['value'] ?: '';
    $this->filter = $_GET['filter'] ?: '';
    $this->data = $countries;
  }

  /**
   * Return the key element.
   *
   * @return string
   */
  public function getKey(){
    return $this->key;
  }

  /**
   * Return the value element.
   *
   * @return string
   */
  public function getValue() {
    return $this->value;
  }

  /**
   * Return the filter element.
   *
   * @return string
   */
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