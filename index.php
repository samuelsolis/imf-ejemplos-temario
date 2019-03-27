<?php
require 'vendor/autoload.php';

$loader = new \Twig_Loader_Filesystem(__DIR__.'/templates');
$twig = new \Twig_Environment($loader, ['debug' => true]);
$twig->addExtension(new \Twig\Extension\DebugExtension());


$client = new GuzzleHttp\Client();
$res = $client->request('GET', 'https://datos.madrid.es/egob/catalogo/206717-0-agenda-eventos-bibliotecas.json', []);


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
