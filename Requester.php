<?php
require 'vendor/autoload.php';

class Requester {

  protected array $params;

  public function __construct(array $params = array()) {
    $this->params = $params;
  }

    /**
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\RuntimeError
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Twig\Error\LoaderError
     */
    public function getHtml() : string {

    $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/templates');
    $twig = new \Twig\Environment($loader);
    $twig->addExtension(new \Twig\Extension\DebugExtension());


    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', 'https://datos.madrid.es/egob/catalogo/206717-0-agenda-eventos-bibliotecas.json',
      [
        'headers' => ['Accept' => 'application/json'],
        'query' => $this->params,
        // Enable debug to get more info about the call.
        // 'debug' => TRUE,
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