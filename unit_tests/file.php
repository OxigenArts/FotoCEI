<?php
header("Content-Type: text/plain");
require_once('../core/file.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
/*
$file = new File();
$file->setIsRemote('1');
$file->setUrl('http://google.com/a-logo.img');
$file->setFilename('A logo');
echo $file->dbInsert() ? "Archivo cargado correctamente".PHP_EOL : "Error al cargar el Archivo".PHP_EOL;

$file = new File(2);
$file->setIsRemote('1');
$file->setUrl('int');
$file->setFilename('6');
echo $file->dbUpdate() ? "Archivo actualizado correctamente".PHP_EOL : "Error al actualizar Archivo".PHP_EOL;

$file = new File(3);
echo $file->dbDelete() ? "Archivo eliminado".PHP_EOL : "Error al eliminar Archivo".PHP_EOL;
*/
?>
