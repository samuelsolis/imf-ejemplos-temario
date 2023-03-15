<?php
include_once 'Color.php';
include_once 'Database.php';

/**
 * Class ColorForm
 */
class ColorForm {
  protected $color;

  /**
   * ColorForm constructor.
   */
  public function __construct(){
    $database = new Database();
    $color = new Color($database);

    // If a save action.
    if (isset($_GET['submit']) && $_GET['submit'] == 'Save') {
      $color->setHex($_GET['hex']);
      $color->setName($_GET['name']);
      $color->setPrice($_GET['price']);
    }

    // Is an edit form.
    elseif (isset($_GET['hex'])) {
      $color->load($_GET['hex']);
    }

    $this->color = $color;
  }

  /**
   * Return the color name.
   *
   * @return string
   */
  public function getName() {
    return $this->color->getName();
  }

  /**
   * Return the color Hexadecimal value.
   * @return string
   */
  public function getHex() {
    return $this->color->getHex();
  }

  /**
   * Return the color Price.
   *
   * @return numeric
   */
  public function getPrice() {
    return $this->color->getPrice();
  }

  /**
   * Save the color.
   */
  public function submit() {
    $this->color->save();
  }

  /**
   * Delete the color.
   */
  public function delete() {
    $this->color->delete();
  }
}