<?php
$headers = $request->getHeaders();
$username = (string) $headers['PHP_AUTH_USER'][0];
$password = (string) $headers['PHP_AUTH_PW'][0];

if($request->getAttribute('id') != null){// ruta /user/{id}
  $user_id= (int)$request->getAttribute('id');
  $user = new User($user_id);
  $admin = new User($username);
  if(isset($username) && isset($password) && ($admin->getAdmin() == "1" || $user->getUsername() == $username) && $admin->getPassword() == $password){
    //Puede ver el usuario

    $response->write(json_encode($user->dbDelete()));
    return $response;
  }
  else{
    //falta de privilegios / user no encontrado
    $response->write(json_encode(false));
    return $response;
  }
}
else{// ruta /user
  $admin = new User($username);
  if($admin->getAdmin() == "1" && $password == $admin->getPassword()){

    $response->write(json_encode("todos"));//devuelve true o false
    return $response;
  }
  else{
    //falta de privilegios
    $response->write(json_encode(false));
    return $response;
  }
}
?>
