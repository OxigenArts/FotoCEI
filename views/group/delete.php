<?php
$headers = $request->getHeaders();
$username = (string) $headers['PHP_AUTH_USER'][0];
$password = (string) $headers['PHP_AUTH_PW'][0];
$group_id= (int)$request->getAttribute('id');
$group = new Group($group_id);
$admin = new User($username);
if(isset($username) && isset($password) && $admin->getAdmin() == "1" && $admin->getPassword() == $password){
  //Puede eliminar el usuario
  $response->write(json_encode($group->dbDelete()));
  return $response;
}
else{
  //falta de privilegios / user no encontrado
  $response->write(json_encode(false));
  return $response;
}

?>
