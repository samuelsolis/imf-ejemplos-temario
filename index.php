<?php
require_once("vendor/autoload.php");

require_once ("Database.php");
require_once ("Color.php");
require_once ("ColorForm.php");
require_once ("ColorList.php");

$loader = new \Twig_Loader_Filesystem(__DIR__.'/templates');
$twig = new \Twig_Environment($loader);

$app = new Slim\App();

/**
 * Return a simple color list.
 */
$app->get("/colors", function ($request) {
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
  echo json_encode($data);
});

/**
 * Create a new color.
 */
$app->post("/color", function ($request, $response, $arguments) {

  $database = new Database();
  $params = $request->getParsedBody();

  $color = new Color($database);
  $color->setHex($params['hex']);
  $color->setName($params['name']);
  $color->setPrice($params['price']);
  $color->save();

});

/**
 * Edit a color.
 */
$app->patch("/color/{hex}", function ($request, $response, $arguments) {

  $database = new Database();
  $params = $request->getParsedBody();
  $hex = $request->getAttribute('hex');

  $color = new Color($database);
  $color->load($hex);
  $color->setName($params['name']);
  $color->setPrice($params['price']);
  $color->save();

});

/**
 * Delete a color from the database.
 */
$app->delete("/color/{hex}", function ($request, $response, $arguments) {
  $database = new Database();
  $params = $request->getParsedBody();
  $hex = $request->getAttribute('hex');
  $color = new Color($database);
  $color->load($hex);
  $color->delete();
});

$app->run();