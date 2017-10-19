<?php
$params = $request->getParams();
$headers = $request->getHeaders();
$username = (string) isset($headers['PHP_AUTH_USER'][0]) ? $headers['PHP_AUTH_USER'][0]:null;
$password = (string) isset($headers['PHP_AUTH_PW'][0]) ? $headers['PHP_AUTH_PW'][0]:null;
$user_id= (int)$request->getAttribute('id');
$user = new User($user_id);
$admin = new User($username);

$log = new Log();
$log->setUser($admin->getId());

if(isset($username) && isset($password) && $admin->getAdmin() == "1" && $admin->getPassword() == $password){
  if(isset($params['username'])) $user->setUsername($params['username']);
  if(isset($params['password'])) $user->setPassword($params['password']);
  if(isset($params['admin'])) $user->setAdmin($params['admin']);
  if(isset($params['name'])) $user->setName($params['name']);
  if(isset($params['lastname'])) $user->setLastname($params['lastname']);
  if(isset($params['email'])) $user->setEmail($params['email']);
  if(isset($params['phone'])) $user->setPhone($params['phone']);
  if($user->getId() != null){
    if($user->dbUpdate()){
      $log->setMessage('Actualizó usuario('.$user->getId().'): '.$user->getUsername());
      $result = array('status' => true, 'result' => LANG_UPDATE_OK);
    }
    else{
      $log->setMessage('Fallo al actualizar usuario('.$user->getId().') : '.$user->getUsername());
      $result = array('status' => false, 'result' => LANG_UPDATE_NO);
    }
  }
  else{
    $log->setMessage('Intento de actualizar usuario no existente: '.$user->getId());
    $result = array('status' => false, 'result' => LANG_USER_NO_EXIST);
  }
  $log->dbInsert();
  $response->write(json_encode($result));
  return $response;
}
else{
  //falta de privilegios / user no encontrado
  $log->setMessage(LANG_ADMIN_ZONE);
  $log->setExtra("user:".$username.PHP_EOL."pass:".$password);
  $result = array('status' => false, 'result' => LANG_ERROR_PRIVILEGIOS);
  $log->dbInsert();
  $response->write(json_encode($result));
  return $response;
}
?>
