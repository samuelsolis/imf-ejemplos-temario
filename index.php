<?php

require_once("vendor/autoload.php");
require_once ("Car.php");
require_once ("Countries.php");

$loader = new \Twig_Loader_Filesystem(__DIR__.'/templates');
$twig = new \Twig_Environment($loader);

$database_countries = new Countries();
var_dump($database_countries->count());
var_dump($database_countries->searchByKey('ES'));
var_dump($database_countries->searchByValue('Spain'));
var_dump($database_countries->filter('An'));