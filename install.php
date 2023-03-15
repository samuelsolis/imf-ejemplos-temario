<?php

require_once("vendor/autoload.php");
require_once ("Database.php");
require_once ("Schema.php");

$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/templates');
$twig = new \Twig\Environment($loader);

$database = new Database();
$database->connect();
// Get the schema base and install it.
$schema = new Schema();
$tables = $schema->getSchema();
foreach ($tables as $table_name => $fields) {
  $database->createTable($table_name, $fields);
}

$database->close();
