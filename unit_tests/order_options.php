<?php
header("Content-Type: text/plain");
require_once('../core/order_options.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
/*
$o_option = new OrderOptions();
$o_option->setOptionId('8');
$o_option->setOrderId(5);
$o_option->setValue('true');
echo $o_option->dbInsert() ? "Opciones de orden creado correctamente".PHP_EOL : "Error al crear Opciones de orden".PHP_EOL;

$o_option = new OrderOptions(3);
$o_option->setOptionId('8');
$o_option->setOrderId('5');
$o_option->setValue('trasd');
echo $o_option->dbUpdate() ? "Opciones de orden actualizado correctamente".PHP_EOL : "Error al actualizar Opciones de orden".PHP_EOL;

$o_option = new OrderOptions(3);
echo $o_option->dbDelete() ? "Opciones de orden eliminado".PHP_EOL : "Error al eliminar Opciones de orden".PHP_EOL;
*/
?>
