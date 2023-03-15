<?php
require_once("vendor/autoload.php");

require_once ("Database.php");
require_once ("Color.php");
require_once ("ColorForm.php");
require_once ("ColorList.php");

$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/templates');
$twig = new \Twig\Environment($loader);

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

try {
    print $twig->render('colorForm.twig', ['values' => $form]);
    print $twig->render('table.twig', ['colores' => $colores]);
}
catch (\Exception $e) {
    print 'Error: ' . $e->getMessage();
}

