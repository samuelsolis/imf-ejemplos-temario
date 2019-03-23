<?php

require_once("vendor/autoload.php");
require_once ("Database.php");
require_once ("Schema.php");

$loader = new \Twig_Loader_Filesystem(__DIR__.'/templates');
$twig = new \Twig_Environment($loader);

$database = new Database();
$database->connect();
// Get the schema base and install it.
$schema = new Schema();
$tables = $schema->getSchema();
foreach ($tables as $table_name => $fields) {
  $database->createTable($table_name, $fields);
}

$database->close();
