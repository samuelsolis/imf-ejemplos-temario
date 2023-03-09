<?php

use JetBrains\PhpStorm\Pure;

require_once ("Countries.php");

/**
 * Form Controller.
 *
 * Class Form
 */
class Form {

  // Form inputs.
  protected string $key;
  protected string $value;
  protected string $filter;

  // Form data.
  protected $data;

  #[Pure] public function __construct() {
    $this->key = $_GET['key'] ?? '';
    $this->value = $_GET['value'] ?? '';
    $this->filter = $_GET['filter'] ?? '';
    $this->data = new Countries();;
  }

  public function getKey() : string{
    return $this->key;
  }

  public function getValue() : string{
    return $this->value;
  }

  public function getFilter() : string{
    return $this->filter;
  }

  /**
   * Show Form results.
   *
   * @return array|string
   */
  public function getElements() : array|string {
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