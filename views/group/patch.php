<?php
$params = $request->getParams();
$headers = $request->getHeaders();
$username = (string) $headers['PHP_AUTH_USER'][0];
$password = (string) $headers['PHP_AUTH_PW'][0];
$group_id= (int)$request->getAttribute('id');
$group = new Group($group_id);
$admin = new User($username);
if(isset($username) && isset($password) && $admin->getAdmin() == "1" && $admin->getPassword() == $password){
  if(isset($params['name'])) $group->setName($params['name']);
  $response->write(json_encode($group->dbUpdate()));//devuelve true o false
  return $response;
}
else{
  //falta de privilegios / user no encontrado
  $response->write(json_encode(false));
  return $response;
}
?>
