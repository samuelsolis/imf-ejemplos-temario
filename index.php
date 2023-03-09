<?php

require_once("vendor/autoload.php");
require_once ("Car.php");
require_once ("Countries.php");

$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/templates');
$twig = new \Twig\Environment($loader);

$database_countries = new Countries();
var_dump($database_countries->count());
var_dump($database_countries->searchByKey('ES'));
var_dump($database_countries->searchByValue('Spain'));
var_dump($database_countries->filter('An'));