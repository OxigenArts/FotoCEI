<?php
header("Content-Type: text/plain");
require_once('../core/user.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
/*$user = new User();
$user->setUsername('juan3221');
$user->setPassword('654987');
$user->setAdmin(0);//1 or 0 or '1' or '0'
$user->setName('Pablo');
$user->setLastname('Androetto');
$user->setEmail('jua3n@outlook.com');
$user->setPhone('3385491719');
echo $user->dbInsert() ? "Usuario creado correctamente".PHP_EOL : "Error al crear el usuario".PHP_EOL;

$user = new User(3);
$user->setName('Paula');
$user->setLastname('Perez');
echo $user->dbUpdate() ? "Usuario actualizado correctamente".PHP_EOL : "Error al actualizar el usuario".PHP_EOL;

$user = new User(24);
echo $user->dbDelete() ? "Usuario eliminado correctamente".PHP_EOL : "Error al eliminar el usuario".PHP_EOL;
*/
?>
