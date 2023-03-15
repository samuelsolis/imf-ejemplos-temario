<?php
include_once 'Database.php';

/**
 * @var
 *
 * Schema definition:
 *
 *   $tables['colores'] = array(
 *   'nombre' => 'varchar(255) NOT NULL UNIQUE',
 *   'valor_hex' => 'char(7) NOT NULL UNIQUE',
 *   'precio' => 'float',
 *   'primary key' => '(valor_hex)',
 *   );
 */
class Color {
  protected $name;
  protected $hex;
  protected $price;

  /**
   * @var Database To persist the values.
   */
  protected $storageController;

  /**
   * @var bool Determine if the color is new or not.
   */
  protected $is_new;

  /**
   * Color constructor.
   *
   * @param Database $database
   */
  public function __construct(Database $database) {
    $this->storageController  = $database;
    $this->is_new = TRUE;
  }

  /**
   * Load the color from the storage.
   *
   * @param $hex
   * @return bool
   */
  public function load($hex) {
    $data = NULL;

    $this->storageController->connect();
    $query = 'SELECT * FROM colores WHERE valor_hex="%s"';
    $query = sprintf($query, $hex);
    $values = $this->storageController->query($query);
    if ($values) {
      $data = $values->fetch_all();
    }
    $this->storageController->close();

    if ($data) {
      $this->name= $data[0][0];
      $this->hex = $data[0][1];
      $this->price = $data[0][2];
      $this->is_new = FALSE;
      return TRUE;
    }

    return FALSE;
  }

  /**
   * Save the color to the database to persist the information.
   */
  public function save() {
    $this->storageController->connect();
    if ($this->is_new) {
      $query = 'INSERT INTO colores (nombre,valor_hex,precio) VALUES ("%s","%s",%d)';
      $query = sprintf($query, $this->name, $this->hex, $this->price);
    }
    else {
      $query = 'UPDATE colores VALUES (`nombre`,`precio`) VALUES (%s",%d) WHERE valor_hex="%s"';
      $query = sprintf($query, $this->name, $this->price, $this->hex);
    }

    $this->storageController->query($query);
    $this->storageController->close();

    $this->is_new = FALSE;
  }

  /**
   * Remove from the database.
   */
  public function delete() {
    $this->storageController->connect();
    $query = sprintf('DELETE FROM colores WHERE valor_hex="%s"', $this->hex);
    $this->storageController->query($query);
    $this->storageController->close();

    $this->is_new = TRUE;
  }

  /**
   * Se the color name.
   *
   * @param string $name
   *   The color name.
   */
  public function setName($name) {
    $this->name = $name;
  }

  /**
   * Set the color hexadecimal value.
   *
   * @param string $hex
   *   The hexadecimal value.
   */
  public function setHex($hex) {
    $this->hex = $hex;
  }

  /**
   * Set the color price.
   * @param numeric $price
   *   The price
   */
  public function setPrice($price) {
    $this->price = $price;
  }

  /**
   * Get the color name.
   *
   * @return string
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Get he hexadecimal value.
   * @return string
   */
  public function getHex() {
    return $this->hex;
  }

  /**
   * Get the price.
   *
   * @return numeric
   */
  public function getPrice() {
    return $this->price;
  }
}
