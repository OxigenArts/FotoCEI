<?php
$params = $request->getParams();
$headers = $request->getHeaders();
$username = (string) $headers['PHP_AUTH_USER'][0];
$password = (string) $headers['PHP_AUTH_PW'][0];
$user_id= (int)$request->getAttribute('id');
$user = new User($user_id);
$admin = new User($username);
if(isset($username) && isset($password) && $admin->getAdmin() == "1" && $admin->getPassword() == $password){
  if(isset($params['username'])) $user->setUsername($params['username']);
  if(isset($params['password'])) $user->setPassword($params['password']);
  if(isset($params['admin'])) $user->setAdmin($params['admin']);
  if(isset($params['name'])) $user->setName($params['name']);
  if(isset($params['lastname'])) $user->setLastname($params['lastname']);
  if(isset($params['email'])) $user->setEmail($params['email']);
  if(isset($params['phone'])) $user->setPhone($params['phone']);
  $response->write(json_encode($user->dbUpdate()));//devuelve true o false
  return $response;
}
else{
  //falta de privilegios / user no encontrado
  $response->write(json_encode(false));
  return $response;
}
?>
