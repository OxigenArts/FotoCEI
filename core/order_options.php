<?php
/**
* OrderOptions class.
* Class to manage the order options.
* @author     Pablo Androetto.
* @copyright  2017 CEI
* @version    0.01
**/
class OrderOptions
{
  const TABLE = 'order_options';
  private $con;
  public $datos; //array with object data
  private $id,$option_id,$order_id,$value;
  function __construct($id = null)
  {
    require_once(dirname(__FILE__).'/mysql.php');
    $this->con = getConnection();
    if(isset($id)){
      return $this->setId($id);
    }
  }
  function __destruct() {
    $this->con->close();
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
      $this->option_id = $this->datos['option_id'];
      $this->order_id = $this->datos['order_id'];
      $this->value = $this->datos['value'];
      return true;
    }
    return false;
  }
  public function setOptionId($value){
    $this->option_id = $value;
  }
  public function setOrderId($value){
    $this->order_id = $value;
  }
  public function setValue($value){
    $this->value = $value;
  }
  /* get methods */
  public function getId(){
    return $this->id;
  }
  public function getOptionId(){
    return $this->option_id;
  }
  public function getOrderId(){
    return $this->order_id;
  }
  public function getValue(){
    return $this->value;
  }
  /* db actions methods */
  public function dbInsert(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $option_id = $this->con->real_escape_string($this->option_id);
    $order_id = $this->con->real_escape_string($this->order_id);
    $value = $this->con->real_escape_string($this->value);
    $sql =  "INSERT INTO $table
            (  option_id,   order_id,   value)
    VALUES  ('$option_id','$order_id','$value')";
    return $this->con->query($sql);
  }
  public function dbUpdate(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $option_id = $this->con->real_escape_string($this->option_id);
    $order_id = $this->con->real_escape_string($this->order_id);
    $value = $this->con->real_escape_string($this->value);
    $sql = "UPDATE $table SET
    option_id = '$option_id',
    order_id  = '$order_id',
    value     = '$value'
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
