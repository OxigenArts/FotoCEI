<?php
$params = $request->getParams();
$headers = $request->getHeaders();
$username = (string) isset($headers['PHP_AUTH_USER'][0]) ? $headers['PHP_AUTH_USER'][0]:null;
$password = (string) isset($headers['PHP_AUTH_PW'][0]) ? $headers['PHP_AUTH_PW'][0]:null;
$admin = new User((string)$username);
$log = new Log();
$log->setUser($admin->getId());

if(isset($params['username']) && isset($params['password']) &&
isset($params['admin']) && isset($params['name']) && isset($params['lastname']) &&
isset($params['email']) && isset($params['phone'])){

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
    if($user->dbInsert()){
      $log->setMessage('Creo un usuario('.$user->getlastId().'): '.$user->getUsername());
      $result = array('status' => true, 'result' => LANG_USER_INSERTED_OK);
    }
    else{
      $log->setMessage('Fallo al crear un usuario.');
      $result = array('status' => false, 'result' => LANG_USER_INSERTED_NO);
    }
    $log->dbInsert();
    $response->write(json_encode($result));//devuelve true o false
    return $response;
  }
  else{
    $log->setMessage(LANG_ADMIN_ZONE);
    $log->setExtra("user:".$username." pass:".$password);
    $log->dbInsert();
    $result = array('status' => false, 'result' => LANG_ERROR_PRIVILEGIOS);
    $response->write(json_encode($result));
    return $response;
  }
}
else{
  //faltan campos
  $log->setMessage(LANG_NO_FIELDS);
  $log->dbInsert();
  $result = array('status' => false, 'result' => LANG_NO_FIELDS);
  $response->write(json_encode($result));
  return $response;
}
?>
