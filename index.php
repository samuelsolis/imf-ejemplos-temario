<?php

require __DIR__ . '/vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once ("Database.php");
require_once ("Color.php");
require_once ("ColorForm.php");
require_once ("ColorList.php");

/**
 * Instantiate App
 *
 * In order for the factory to work you need to ensure you have installed
 * a supported PSR-7 implementation of your choice e.g.: Slim PSR-7 and a supported
 * ServerRequest creator (included with Slim PSR-7)
 */
$app = AppFactory::create();

/**
 * The routing middleware should be added earlier than the ErrorMiddleware
 * Otherwise exceptions thrown from it will not be handled by the middleware
 */
$app->addRoutingMiddleware();

/**
 * Add Error Middleware
 *
 * @param bool                  $displayErrorDetails -> Should be set to false in production
 * @param bool                  $logErrors -> Parameter is passed to the default ErrorHandler
 * @param bool                  $logErrorDetails -> Display error details in error log
 * @param LoggerInterface|null  $logger -> Optional PSR-3 Logger
 *
 * Note: This middleware should be added last. It will not handle any exceptions/errors
 * for middleware added after it.
 */
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Go to /colors for get a list of colors!");
    return $response;
});

/**
 * Return a simple color list.
 */
$app->get("/colors", function (Request $request, Response $response,array $arguments) {
  $colorList = new ColorList();
  $colores = $colorList->getAll();
  $data = [];

  /** @var Color $color */
  foreach ($colores as $color) {
    $data[$color->getHex()] = [
      'hex' => $color->getHex(),
      'name' => $color->getName(),
      'price' => $color->getPrice(),
    ];
  }

  // Configure the header as a Json content.
  header('Content-Type: application/json');
  $response->getBody()->write(json_encode($data));

  return $response;
});

/**
 * Create a new color.
 */
$app->post("/color", function (Request $request, Response $response, array $arguments) {

  $database = new Database();
  $params = $request->getParsedBody();

  $color = new Color($database);
  $color->setHex($params['hex']);
  $color->setName($params['name']);
  $color->setPrice($params['price']);
  $color->save();

  header('Content-Type: application/json');
  $response->getBody()->write(json_encode($color));

  return $response;
});

/**
 * Edit a color.
 */
$app->patch("/color/{hex}", function (Request $request,Response $response, array $arguments) {

  $database = new Database();
  $hex = $arguments['hex'];
  $params = $request->getParsedBody();


  $color = new Color($database);
  $color->load($hex);
  $color->setName($params['name']);
  $color->setPrice($params['price']);
  $color->save();

    header('Content-Type: application/json');
    $response->getBody()->write(json_encode($color));

    return $response;
});

/**
 * Delete a color from the database.
 */
$app->delete("/color/{hex}", function (Request $request, Response $response, array $arguments) {
  $database = new Database();
  $hex = $arguments['hex'];
  $color = new Color($database);
  $color->load($hex);
  $color->delete();

  return $response;
});

$app->run();

