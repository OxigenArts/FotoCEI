<?php
$headers = $request->getHeaders();
$username = (string) $headers['PHP_AUTH_USER'][0];
$password = (string) $headers['PHP_AUTH_PW'][0];

if($request->getAttribute('id') != null){// ruta /group/{id}
  $group = new Group();
  if($group->setId($request->getAttribute('id'))){
    $response->write(json_encode($group->datos));
    return $response;
  }
  else{
    //grupo no encontrado
    $response->write(json_encode(false));
    return $response;
  }


}
else{// ruta /group
  $grupos_id = Group::getAllId();
  if(is_array($grupos_id) || is_object($grupos_id)){
    $grupos = array();//Arreglo con datos de todos los grupos
    foreach ($grupos_id as $grupo_id) {
      $grupo = new Group($grupo_id);
      array_push($grupos,$grupo->datos);
    }
    $response->write(json_encode($grupos));
    return $response;
  }else{
    //no hay grupos
    $response->write(json_encode("false"));
    return $response;
  }
}
?>
