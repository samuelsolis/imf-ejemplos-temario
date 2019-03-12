<?php

require_once("vendor/autoload.php");
require_once ("Form.php");

$loader = new \Twig_Loader_Filesystem(__DIR__.'/templates');
$twig = new \Twig_Environment($loader);

$form = new Form();
$elements = $form->getElements();

print $twig->render('form.twig', ['form' => $form]);
print $twig->render('table.twig', ['countries' => $elements]);
