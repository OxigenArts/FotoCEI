<?php
/**
* User class.
* Class to manage users.
* @author     Pablo Androetto.
* @copyright  2017 CEI
* @version    0.01
**/
class User
{
  const TABLE = 'users';
  private $con;
  public $datos; //array with object data
  private $id,$username,$password,$admin,$name,$lastname,$email,$phone;
  function __construct($id = null)
  {
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
    if(is_int($id)){//search by id
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
      $this->username = $this->datos['username'];
      $this->password = $this->datos['password'];
      $this->admin = $this->datos['admin'];
      $this->name = $this->datos['name'];
      $this->lastname = $this->datos['lastname'];
      $this->email = $this->datos['email'];
      $this->phone = $this->datos['phone'];
      return true;
    }
    return false;
  }
  public function setUsername($value){
    $this->username = $value;
  }
  public function setPassword($value){
    $this->password = md5($value);
  }
  public function setAdmin($value){
    $this->admin = $value;
  }
  public function setName($value){
    $this->name = $value;
  }
  public function setLastname($value){
    $this->lastname = $value;
  }
  public function setEmail($value){
    $this->email = $value;
  }
  public function setPhone($value){
    $this->phone = $value;
  }
  /* get methods */
  public function getId(){
    return $this->id;
  }
  public function getUsername(){
    return $this->username;
  }
  public function getPassword(){
    return $this->password;
  }
  public function getAdmin(){
    return $this->admin;
  }
  public function getName(){
    return $this->name;
  }
  public function getLastname(){
    return $this->lastname;
  }
  public function getEmail(){
    return $this->email;
  }
  public function getPhone(){
    return $this->phone;
  }
  /* db actions methods */
  public function dbInsert(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $username = $this->con->real_escape_string($this->username);
    $password = $this->con->real_escape_string($this->password);
    $admin = $this->con->real_escape_string($this->admin);
    $name = $this->con->real_escape_string($this->name);
    $lastname = $this->con->real_escape_string($this->lastname);
    $email = $this->con->real_escape_string($this->email);
    $phone = $this->con->real_escape_string($this->phone);
    $sql =  "INSERT INTO $table
            (  username,   password,   admin,   name,   lastname,   email,   phone)
    VALUES  ('$username','$password','$admin','$name','$lastname','$email','$phone')";
    return $this->con->query($sql);
  }
  public function dbUpdate(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $username = $this->con->real_escape_string($this->username);
    $password = $this->con->real_escape_string($this->password);
    $admin = $this->con->real_escape_string($this->admin);
    $name = $this->con->real_escape_string($this->name);
    $lastname = $this->con->real_escape_string($this->lastname);
    $email = $this->con->real_escape_string($this->email);
    $phone = $this->con->real_escape_string($this->phone);
    $sql = "UPDATE $table SET
    username = '$username',
    password = '$password',
    admin    = '$admin',
    name     = '$name',
    lastname = '$lastname',
    email    = '$email',
    phone    = '$phone'
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
