<?php
require_once("vendor/autoload.php");

require_once ("Database.php");
require_once ("Color.php");
require_once ("ColorForm.php");
require_once ("ColorList.php");

$loader = new \Twig_Loader_Filesystem(__DIR__.'/templates');
$twig = new \Twig_Environment($loader);

$form = new ColorForm();

if (isset($_GET['submit']) && $_GET['submit'] == 'Save') {
  $form->submit();
}

if (isset($_GET['delete']) && $_GET['delete'] == 'Eliminar') {
  $form->delete();
}

/**
 * List of colors.
 */
$colorList = new ColorList();
$colores = $colorList->getAll();

print $twig->render('colorForm.twig', ['values' => $form]);
print $twig->render('table.twig', ['colores' => $colores]);
