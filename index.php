<?php

require_once("vendor/autoload.php");
include_once 'Form.php';
include_once 'Countries.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/templates');
$twig = new \Twig\Environment($loader);

$countries = new Countries();
$form = new Form($countries);
$elements = $form->getElements();

try {
    print $twig->render('form.twig', ['form' => $form]);
    print $twig->render('table.twig', ['countries' => $elements]);
} catch (\Twig\Error\LoaderError | \Twig\Error\RuntimeError | \Twig\Error\SyntaxError $e) {
    print 'Error 500';
}
