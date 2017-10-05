<?php
$params = $request->getParams();
$headers = $request->getHeaders();
$username = (string) $headers['PHP_AUTH_USER'][0];
$password = (string) $headers['PHP_AUTH_PW'][0];
if(isset($params['username']) && isset($params['password']) &&
isset($params['admin']) && isset($params['name']) && isset($params['lastname']) &&
isset($params['email']) && isset($params['phone'])){
  $admin = new User((string)$username);
  if(isset($password) && isset($username) && $admin->getAdmin() == "1" && $password == $admin->getPassword()){
    //Puede crear el usuario
    $user = new User();
    $user->setUsername($params['username']);
    $user->setPassword($params['password']);
    $user->setAdmin($params['admin']);
    $user->setName($params['name']);
    $user->setLastname($params['lastname']);
    $user->setEmail($params['email']);
    $user->setPhone($params['phone']);
    $response->write(json_encode($user->dbInsert()));//devuelve true o false
    return $response;
  }
  else{
    //falta de privilegios
    $response->write(json_encode(false));
    return $response;
  }
}
else{
  //faltan campos
  $response->write(json_encode(false));
  return $response;
}
?>
