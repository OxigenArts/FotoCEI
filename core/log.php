<?php
/**
* Log class.
* Class to manage logs.
* @author     Pablo Androetto.
* @copyright  2017 CEI
* @version    0.01
**/
class Log
{
  const TABLE = 'log';
  private $con;
  public $datos; //array with object data
  private $id,$date,$user,$route,$uagent,$ip,$message,$extra;
  function __construct($id = null)
  {
    $ipaddress = '';
      if (getenv('HTTP_CLIENT_IP'))
          $ipaddress = getenv('HTTP_CLIENT_IP');
      else if(getenv('HTTP_X_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
      else if(getenv('HTTP_X_FORWARDED'))
          $ipaddress = getenv('HTTP_X_FORWARDED');
      else if(getenv('HTTP_FORWARDED_FOR'))
          $ipaddress = getenv('HTTP_FORWARDED_FOR');
      else if(getenv('HTTP_FORWARDED'))
         $ipaddress = getenv('HTTP_FORWARDED');
      else if(getenv('REMOTE_ADDR'))
          $ipaddress = getenv('REMOTE_ADDR');
      else
          $ipaddress = 'UNKNOWN';
       $ipaddress;
    $this->setIp($ipaddress);
    $this->setDate(date("Y-m-d H:i:s"));
    $this->setRoute($_SERVER['REQUEST_URI']);
    $this->setUagent(htmlentities($_SERVER['HTTP_USER_AGENT']));

    require_once(dirname(__FILE__).'/mysql.php');
    $this->con = getConnection();
    if(isset($id)){
      return $this->setId($id);
    }
  }
  function __destruct() {
    $this->con->close();//al destruir el usuario cierra la conexión con la db.
  }
  /* set methods */
  public function setId($id){
    $table = $this->con->real_escape_string(self::TABLE);
    if(is_int($id) || is_numeric($id)){//search by id
      $id = $this->con->real_escape_string($id);
      $sql = "SELECT * FROM $table WHERE id = '$id'";
    }
    else{//search by user
      $username = $this->con->real_escape_string($id);
      $sql = "SELECT * FROM $table WHERE username = '$username'";
    }
    $result = $this->con->query($sql);
    if($row = $result->fetch_assoc()){
      $this->datos = $row;
      $this->id = $this->datos['id'];
      $this->date = $this->datos['date'];
      $this->user = $this->datos['user'];
      $this->route = $this->datos['route'];
      $this->uagent = $this->datos['uagent'];
      $this->ip = $this->datos['ip'];
      $this->message = $this->datos['message'];
      $this->extra = $this->datos['extra'];
      return true;
    }
    return false;
  }
  public function setDate($value){
    $this->date = $value;
  }
  public function setUser($value){
    $this->user = $value;
  }
  public function setRoute($value){
    $this->route = $value;
  }
  public function setUagent($value){
    $this->uagent = $value;
  }
  public function setIp($value){
    $this->ip = $value;
  }
  public function setMessage($value){
    $this->message = $value;
  }
  public function setExtra($value){
    $this->extra = $value;
  }
  /* get methods */
  public static function getAllId(){
    require_once(dirname(__FILE__).'/mysql.php');
    $con = getConnection();
    $table = $con->real_escape_string(self::TABLE);
    $sql = "SELECT id FROM $table";
    $toreturn = array();
    if($result = $con->query($sql)){
      while($row = $result->fetch_assoc()){
        array_push($toreturn,$row['id']);
      }
      return $toreturn;
    }
    else{
      return false;
    }
  }
  public function getId(){
    return $this->id;
  }
  public function getDate(){
    return $this->date;
  }
  public function getUser(){
    return $this->user;
  }
  public function getRoute(){
    return $this->route;
  }
  public function getUagent(){
    return $this->uagent;
  }
  public function getIp(){
    return $this->ip;
  }
  public function getMessage(){
    return $this->message;
  }
  public function getExtra(){
    return $this->extra;
  }
  /* db actions methods */
  public function dbInsert(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $date = $this->con->real_escape_string($this->date);
    $user = $this->con->real_escape_string($this->user);
    $route = $this->con->real_escape_string($this->route);
    $uagent = $this->con->real_escape_string($this->uagent);
    $ip = $this->con->real_escape_string($this->ip);
    $message = $this->con->real_escape_string($this->message);
    $extra = $this->con->real_escape_string($this->extra);
    $sql =  "INSERT INTO $table
            (  date,   user,   route,   uagent,   ip,   message,   extra)
    VALUES  ('$date','$user','$route','$uagent','$ip','$message','$extra')";
    return $this->con->query($sql);
  }
  public function dbUpdate(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $date = $this->con->real_escape_string($this->date);
    $user = $this->con->real_escape_string($this->user);
    $route = $this->con->real_escape_string($this->route);
    $uagent = $this->con->real_escape_string($this->uagent);
    $ip = $this->con->real_escape_string($this->ip);
    $message = $this->con->real_escape_string($this->message);
    $extra = $this->con->real_escape_string($this->extra);
    $sql = "UPDATE $table SET
    date    = '$date',
    user    = '$user',
    route   = '$route',
    uagent  = '$uagent',
    ip      = '$ip',
    message = '$message',
    extra   = '$extra'
    WHERE id = '$id'";
    return $this->con->query($sql);
  }
  public function dbDelete(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $sql = "DELETE FROM $table WHERE id = '$id'";
    return $this->con->query($sql);
  }
}
?>
