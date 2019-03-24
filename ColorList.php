<?php

include_once 'Color.php';
include_once 'Database.php';

/**
 * Manage the colors as a group.
 * Class ColorList
 */
class ColorList {

  /**
   * Return all colors.
   *
   * @return array
   */
  public function getAll() {
    $database = new Database();
    $database->connect();
    $query_result = $database->query('SELECT valor_hex FROM colores LIMIT 100');
    $result = $query_result->fetch_all();
    $database->close();
    $colores = array();
    foreach ($result as $hex) {
      $color = new Color($database);
      if ($color->load($hex[0])) {
        $colores[] = $color;
      }
    }


    return $colores;
  }
}