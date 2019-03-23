<?php

require_once("vendor/autoload.php");
require_once ("Database.php");

$loader = new \Twig_Loader_Filesystem(__DIR__.'/templates');
$twig = new \Twig_Environment($loader);

$database = new Database();

if ($database->connect()) {
    print 'Conectado correctamente';
}

// Do something.

$database->close();
