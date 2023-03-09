<?php

require_once("vendor/autoload.php");
require_once ("Form.php");

$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/templates');
$twig = new \Twig\Environment($loader);

$form = new Form();
$elements = $form->getElements();

try {
    print $twig->render('form.twig', ['form' => $form]);
    print $twig->render('table.twig', ['countries' => $elements]);
} catch (\Twig\Error\LoaderError | \Twig\Error\RuntimeError | \Twig\Error\SyntaxError $e) {
    print 'Error 500';
}
