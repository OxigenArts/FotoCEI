<?php
/**
* Option class.
* Class to manage options.
* @author     Pablo Androetto.
* @copyright  2017 CEI
* @version    0.01
*
* NOTE: the group field appears in the database as '_group'
**/
class Option
{
  const TABLE = 'options';
  private $con;
  public $datos; //array with object data
  private $id,$name,$type,$group;
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
      $this->name = $this->datos['name'];
      $this->type = $this->datos['type'];
      $this->group = $this->datos['_group'];
      return true;
    }
    return false;
  }
  public function setName($value){
    $this->name = $value;
  }
  public function setType($value){
    $this->type = $value;
  }
  public function setGroup($value){
    $this->group = $value;
  }
  /* get methods */
  public function getId(){
    return $this->id;
  }
  public function getName(){
    return $this->name;
  }
  public function getType(){
    return $this->type;
  }
  public function getGroup(){
    return $this->group;
  }
  /* db actions methods */
  public function dbInsert(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $name = $this->con->real_escape_string($this->name);
    $type = $this->con->real_escape_string($this->type);
    $group = $this->con->real_escape_string($this->group);
    $sql =  "INSERT INTO $table
            (  name,   type,   _group)
    VALUES  ('$name','$type','$group')";
    return $this->con->query($sql);
  }
  public function dbUpdate(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $name = $this->con->real_escape_string($this->name);
    $type = $this->con->real_escape_string($this->type);
    $group = $this->con->real_escape_string($this->group);
    $sql = "UPDATE $table SET
    name     = '$name',
    type     = '$type',
    _group    = '$group'
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
