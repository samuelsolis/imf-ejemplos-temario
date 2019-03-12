<?php

require_once("vendor/autoload.php");
require_once ("Form.php");
require_once ("Countries.php");

$loader = new \Twig_Loader_Filesystem(__DIR__.'/templates');
$twig = new \Twig_Environment($loader);

$form = new Form();
$data = new Countries();

if (($key = $form->getKey()) != '') {
  $elements = $data->searchByKey($key);
}

if (($value = $form->getValue()) != '') {
  $elements = $data->searchByValue($value);
}

if (($filter = $form->getFilter()) != '') {
  var_dump($filter);
  $elements = $data->filter($filter);
}

if (!isset($elements)) {
  $elements = $data->getAll();
}

print $twig->render('form.twig', ['form' => $form]);
print $twig->render('table.twig', ['countries' => $elements]);
