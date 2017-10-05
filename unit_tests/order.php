<?php
header("Content-Type: text/plain");
require_once('../core/order.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
/*

$order = new Order();
$order->setUserId('26');
$order->setCreatedAt(date("Y-m-d H:i:s"));
$order->setFileId(2);
$order->setPrice("2132.55");
$order->setComment("l aslda sld asdlkasd asd ASDkjaslkdj klasjd laks");
echo $order->dbInsert() ? "Orden creado correctamente".PHP_EOL : "Error al crear la Orden".PHP_EOL;

$order = new Order(5);
$order->setUserId(27);
$order->setCreatedAt(date("Y-m-d H:i:s"));
$order->setFileId(4);
$order->setPrice("321.55");
$order->setComment("l asddasjd laks");
echo $order->dbUpdate() ? "Orden actualizado correctamente".PHP_EOL : "Error al actualizar Orden".PHP_EOL;

$order = new Order(5);
echo $order->dbDelete() ? "Orden eliminado".PHP_EOL : "Error al eliminar Orden".PHP_EOL;
*/
?>
