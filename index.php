<?php
/**
* FotoCEI
* Sistema de pedido online de fotocopias para el
* centro de estudiantes de ingeniería de la
* Universidad Nacional de Río Cuarto.
*
* @author     Pablo Androetto.
* @copyright  2017 CEI
* @version    0.01
**/


//header("Content-type: application/json; charset=utf-8");
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once 'vendor/autoload.php';

$app = new \Slim\App;

$rutes = array(
  'get' => array(
    '/user' => 'views/user/get.php',
    '/user/{id}' => 'views/user/get.php',
    '/paper' => 'views/paper/get.php',
    '/paper/{id}' => 'views/paper/get.php',
    '/option' => 'views/option/get.php',
    '/option/{id}' => 'views/option/get.php',
    '/order_option' => 'views/order_option/get.php',
    '/order_option/{id}' => 'views/order_option/get.php',
    '/file' => 'views/file/get.php',
    '/file/{id}' => 'views/file/get.php',
    '/order' => 'views/order/get.php',
    '/order/{id}' => 'views/order/get.php'
  ),
  'post' => array(
    '/user' => 'views/user/post.php',
    '/paper' => 'views/paper/post.php',
    '/option' => 'views/option/post.php',
    '/order_option' => 'views/order_option/post.php',
    '/file' => 'views/file/post.php',
    '/order' => 'views/order/post.php'
  ),
  'delete' => array(
    '/user' => 'views/user/delete.php',
    '/paper' => 'views/paper/delete.php',
    '/option' => 'views/option/delete.php',
    '/order_option' => 'views/order_option/delete.php',
    '/file' => 'views/file/delete.php',
    '/order' => 'views/order/delete.php'
  ),
  'patch' => array(
    '/user' => 'views/user/patch.php',
    '/paper' => 'views/paper/patch.php',
    '/option' => 'views/option/patch.php',
    '/order_option' => 'views/order_option/patch.php',
    '/file' => 'views/file/patch.php',
    '/order' => 'views/order/patch.php'
  )
);


foreach ($rutes['get'] as $rute => $file) {
  $app->get($rute, function (Request $request, Response $response) use ($file) {
    include($file);

  });
}

foreach ($rutes['post'] as $rute => $file) {
  $app->post($rute, function (Request $request, Response $response) use ($file) {
    include($file);
  });
}

foreach ($rutes['delete'] as $rute => $file) {
  $app->delete($rute, function (Request $request, Response $response) use ($file) {
    include($file);
  });
}

foreach ($rutes['patch'] as $rute => $file) {
  $app->patch($rute, function (Request $request, Response $response) use ($file) {
    include($file);
  });
}
$app->run();
