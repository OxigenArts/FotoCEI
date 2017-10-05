<?php
header("Content-Type: text/plain");
require_once('../core/option.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
/*
$option = new Option();
$option->setName('Abrochados');
$option->setType('bool');//el cliente debe interpretar esto al momento de mostrar la opción
$option->setGroup(7);
echo $option->dbInsert() ? "Opción creada correctamente".PHP_EOL : "Error al crear la opción".PHP_EOL;

$option = new Option(5);
$option->setName('En un folio');
$option->setType('int');
$option->setGroup('6');
echo $option->dbUpdate() ? "Opción actualizada correctamente".PHP_EOL : "Error al actualizar Opción".PHP_EOL;

$option = new Option(5);
echo $option->dbDelete() ? "Opción eliminada".PHP_EOL : "Error al eliminar Opción".PHP_EOL;
*/
?>
