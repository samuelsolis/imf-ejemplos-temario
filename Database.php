<?php

class Database {

  protected $database_server;
  protected $database_name;
  protected $user;
  protected $pass;

  /** @var \mysqli */
  protected $connection;

  public function __construct() {
    $this->database_server = 'localhost';
    $this->user = 'root';
    $this->pass = 'root';
    $this->database_name= 'test';
  }

  public function connect() {
    $this->connection = new mysqli($this->database_server, $this->user, $this->pass);

    // Check connection
    if ($this->connection->connect_error) {
      return FALSE;
    }

    // Choose the database inside the database server.
    $this->connection->select_db($this->database_name);

    return TRUE;
  }

  public function close() {
    $this->connection->close();
  }

  /**
   * Create the table $name with the field specified in $fields.
   *
   * @param string $name
   *   Table name.
   * @param array $fields
   *   List of fields in string format.
   */
  public function createTable($name, $fields) {

    $field_rendered = array();
    foreach ($fields as $field_name => $definition) {
      $field_rendered[] = $field_name . ' ' . $definition;
    }
    $field_rendered = implode(',', $field_rendered);

    $query = 'CREATE TABLE ' . $name . ' (' . $field_rendered . ')';
    $this->connection->query($query);
  }

  /**
   * Insert into $table de element describes in $values.
   * @param $table
   * @param $values
   */
  public function insert($table, $values) {
    $query = 'INSERT INTO ' . $table . ' VALUES (' . implode(',', $values). ')';
    $this->connection->query($query);
  }

  /**
   * Execute the query into the database loaded.
   *
   * @param $query
   *   The Query.
   */
  public function query($query) {
    return $this->connection->query($query);
  }
}