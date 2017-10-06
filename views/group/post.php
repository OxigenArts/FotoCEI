<?php
$params = $request->getParams();
$headers = $request->getHeaders();
$username = (string) $headers['PHP_AUTH_USER'][0];
$password = (string) $headers['PHP_AUTH_PW'][0];
if(isset($params['name'])){
  $admin = new User((string)$username);
  if(isset($password) && isset($username) && $admin->getAdmin() == "1" && $password == $admin->getPassword()){
    //Puede crear el grupo
    $group = new Group();
    $group->setName($params['name']);
    $response->write(json_encode($group->dbInsert()));//devuelve true o false
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
