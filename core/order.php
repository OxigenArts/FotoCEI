<?php
/**
* Order class.
* Class to manage orders.
* @author     Pablo Androetto.
* @copyright  2017 CEI
* @version    0.01
**/
class Order
{
  const TABLE = 'orders';
  private $con;
  public $datos; //array with object data
  private $id,$user_id,$created_at,$file_id,$price,$comment;
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
    $id = $this->con->real_escape_string($id);
    $table = $this->con->real_escape_string(self::TABLE);
    $sql = "SELECT * FROM $table WHERE id = '$id'";
    $result = $this->con->query($sql);
    if($row = $result->fetch_assoc()){
      $this->datos = $row;
      $this->id = $this->datos['id'];
      $this->user_id = $this->datos['user_id'];
      $this->created_at = $this->datos['created_at'];
      $this->file_id = $this->datos['file_id'];
      $this->price = $this->datos['price'];
      $this->comment = $this->datos['comment'];
      return true;
    }
    return false;
  }
  public function setUserId($value){
    $this->user_id = $value;
  }
  public function setCreatedAt($value){
    $this->created_at = $value;
  }
  public function setFileId($value){
    $this->file_id = $value;
  }
  public function setPrice($value){
    $this->price = $value;
  }
  public function setComment($value){
    $this->comment = $value;
  }
  /* get methods */
  public function getId(){
    return $this->id;
  }
  public function getUserId(){
    return $this->user_id;
  }
  public function getCreatedAt(){
    return $this->created_at;
  }
  public function getFileId(){
    return $this->file_id;
  }
  public function getPrice(){
    return $this->price;
  }
  public function getComment(){
    return $this->comment;
  }
  /* db actions methods */
  public function dbInsert(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $user_id = $this->con->real_escape_string($this->user_id);
    $created_at = $this->con->real_escape_string($this->created_at);
    $file_id = $this->con->real_escape_string($this->file_id);
    $price = $this->con->real_escape_string($this->price);
    $comment = $this->con->real_escape_string($this->comment);
    $sql =  "INSERT INTO $table
            (  user_id,   created_at,   file_id,   price,   comment)
    VALUES  ('$user_id','$created_at','$file_id','$price','$comment')";
    return $this->con->query($sql);
  }
  public function dbUpdate(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $user_id = $this->con->real_escape_string($this->user_id);
    $created_at = $this->con->real_escape_string($this->created_at);
    $file_id = $this->con->real_escape_string($this->file_id);
    $price = $this->con->real_escape_string($this->price);
    $comment = $this->con->real_escape_string($this->comment);
    $sql = "UPDATE $table SET
    user_id = '$user_id',
    created_at = '$created_at',
    file_id    = '$file_id',
    price     = '$price',
    comment = '$comment'
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
