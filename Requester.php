<?php
require 'vendor/autoload.php';

class Requester {
  /**
   * @var array
   */
  protected $params;

  public function __construct($params = array()){
    $this->params = $params;
  }

  public function getHtml() {

    $loader = new \Twig_Loader_Filesystem(__DIR__.'/templates');
    $twig = new \Twig_Environment($loader, ['debug' => true]);
    $twig->addExtension(new \Twig\Extension\DebugExtension());


    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', 'https://datos.madrid.es/egob/catalogo/206717-0-agenda-eventos-bibliotecas.json',
      [
        'headers' => ['Accept' => 'application/json'],
        'query' => $this->params,
        'debug' => TRUE,
      ]
    );


    switch ($res->getStatusCode()) {

      case 200:

        $body = json_decode($res->getBody()->getContents());
        foreach ($body as $key => $value) {
          if ($key == '@graph') {
            return $twig->render('eventTable.twig', ['events' => $value]);
          }
        }

        break;
      case 400:
      case 404:
      case 403:
      return '<p>Something was wrong in the client</p>';
      case 500:
        return '<p>Something was wrong in the server</p>';
      default:
        return '<p>Unrecognized error.</p>';
    }
  }
}