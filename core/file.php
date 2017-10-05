<?php
/**
* File class.
* Class to manage files.
* @author     Pablo Androetto.
* @copyright  2017 CEI
* @version    0.01
**/
class File
{
  const TABLE = 'files';
  private $con;
  public $datos; //array with object data
  private $id,$is_remote,$url,$filename;
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
      $this->is_remote = $this->datos['is_remote'];
      $this->url = $this->datos['url'];
      $this->filename = $this->datos['filename'];
      return true;
    }
    return false;
  }
  public function setIsRemote($value){
    $this->is_remote = $value;
  }
  public function setUrl($value){
    $this->url = $value;
  }
  public function setFilename($value){
    $this->filename = $value;
  }
  /* get methods */
  public function getId(){
    return $this->id;
  }
  public function getIsRemote(){
    return $this->is_remote;
  }
  public function getUrl(){
    return $this->url;
  }
  public function getFilename(){
    return $this->filename;
  }
  /* db actions methods */
  public function dbInsert(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $is_remote = $this->con->real_escape_string($this->is_remote);
    $url = $this->con->real_escape_string($this->url);
    $filename = $this->con->real_escape_string($this->filename);
    $sql =  "INSERT INTO $table
            (  is_remote,   url,   filename)
    VALUES  ('$is_remote','$url','$filename')";
    return $this->con->query($sql);
  }
  public function dbUpdate(){
    $table = $this->con->real_escape_string(self::TABLE);
    $id = $this->con->real_escape_string($this->id);
    $is_remote = $this->con->real_escape_string($this->is_remote);
    $url = $this->con->real_escape_string($this->url);
    $filename = $this->con->real_escape_string($this->filename);
    $sql = "UPDATE $table SET
    is_remote = '$is_remote',
    url       = '$url',
    filename  = '$filename'
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
