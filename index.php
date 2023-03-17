<?php

require 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/templates');
$twig = new \Twig\Environment($loader);
$twig->addExtension(new \Twig\Extension\DebugExtension());


$client = new GuzzleHttp\Client();
try {
    $res = $client->request('GET', 'https://datos.madrid.es/egob/catalogo/206717-0-agenda-eventos-bibliotecas.json', []);
}
catch (\GuzzleHttp\Exception\GuzzleException $e) {
    print '<p>Something was wrong in the server</p>';
    exit;
}


switch ($res->getStatusCode()) {

  case 200:

    $body = json_decode($res->getBody()->getContents());
    foreach ($body as $key => $value) {
      if ($key == '@graph') {
        print $twig->render('eventTable.twig', ['events' => $value]);
      }
    }

    break;
  case 400:
  case 404:
  case 403:
    print '<p>Something was wrong in the client</p>';
  break;
  case 500:
    print '<p>Something was wrong in the server</p>';
    break;
  default:
    print '<p>Unrecognized error.</p>';
    break;
}
