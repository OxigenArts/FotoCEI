<?php
$headers = $request->getHeaders();
$username = (string) isset($headers['PHP_AUTH_USER'][0]) ? $headers['PHP_AUTH_USER'][0]:null;
$password = (string) isset($headers['PHP_AUTH_PW'][0]) ? $headers['PHP_AUTH_PW'][0]:null;
$user_id= (int)$request->getAttribute('id');

$user = new User($user_id);
$admin = new User($username);

$log = new Log();
$log->setUser($admin->getId());

if(isset($username) && isset($password) && $admin->getAdmin() == "1" && $admin->getPassword() == $password){
  //Puede eliminar el usuario
  $deleted = $user->dbDelete();
  if($user->getId() != null){
    if($deleted){
      $log->setMessage('Elimino usuario('.$user->getId().'): '.$user->getUsername());
      $result = array('status' => true, 'result' => LANG_USER_DELETED);
    }
    else{
      $log->setMessage('Fallo al eliminar un usuario de id :'.$user_id);
      $result = array('status' => false, 'result' => LANG_USER_NO_DELETED);
    }
  }
  else{
    $log->setMessage('Intento eliminar un usuario inexistente de id :'.$user_id);
    $result = array('status' => false, 'result' => LANG_USER_NO_EXIST);
  }

  $response->write(json_encode($result));
  $log->dbInsert();
  return $response;
}
else{
  //Sin privilegios para eliminar el usuario
  $log->setMessage(LANG_ADMIN_ZONE);
  $log->setExtra("user:".$username." pass:".$password);
  $result = array('status' => false, 'result' => LANG_ERROR_PRIVILEGIOS);
  $response->write(json_encode($result));
  $log->dbInsert();
  return $response;
}

?>
