<?php

require_once("vendor/autoload.php");
require_once ("Car.php");

$loader = new \Twig_Loader_Filesystem(__DIR__.'/templates');
$twig = new \Twig_Environment($loader);

$car1 = new Car('Samuel');
$car1->refuel();
$car1->speedUp(20);
echo $twig->render('car.twig', ['car' => $car1]);

$car2 = new Car('Beatriz');
$car2->refuel();
$car2->speedUp(40);
$car2->speedDown(5);
echo $twig->render('car.twig', ['car' => $car2]);
