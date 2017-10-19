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

require_once('vendor/autoload.php');
require_once('core/user.php');
require_once('core/order.php');
require_once('core/order_options.php');
require_once('core/option.php');
require_once('core/group.php');
require_once('core/file.php');
require_once('core/log.php');
require_once('core/lang.php');
$app = new \Slim\App;

$rutes = array(
  'get' => array(
    '/user' => 'views/user/get.php',
    '/user/{id}' => 'views/user/get.php',
    '/group' => 'views/group/get.php',
    '/group/{id}' => 'views/group/get.php',
    '/option' => 'views/option/get.php',
    '/option/{id}' => 'views/option/get.php',
    '/order_options' => 'views/order_options/get.php',
    '/order_options/{id}' => 'views/order_options/get.php',
    '/file' => 'views/file/get.php',
    '/file/{id}' => 'views/file/get.php',
    '/order' => 'views/order/get.php',
    '/order/{id}' => 'views/order/get.php'
  ),
  'post' => array(
    '/user' => 'views/user/post.php',
    '/group' => 'views/group/post.php',
    '/option' => 'views/option/post.php',
    '/order_options' => 'views/order_options/post.php',
    '/file' => 'views/file/post.php',
    '/order' => 'views/order/post.php'
  ),
  'delete' => array(
    '/user/{id}' => 'views/user/delete.php',
    '/group/{id}' => 'views/group/delete.php',
    '/option/{id}' => 'views/option/delete.php',
    '/order_options/{id}' => 'views/order_options/delete.php',
    '/file/{id}' => 'views/file/delete.php',
    '/order/{id}' => 'views/order/delete.php'
  ),
  'patch' => array(
    '/user/{id}' => 'views/user/patch.php',
    '/group/{id}' => 'views/group/patch.php',
    '/option/{id}' => 'views/option/patch.php',
    '/order_options/{id}' => 'views/order_options/patch.php',
    '/file/{id}' => 'views/file/patch.php',
    '/order/{id}' => 'views/order/patch.php'
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
