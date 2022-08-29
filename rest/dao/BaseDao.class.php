<?php
require_once dirname(__FILE__)."/../config.php";

class BaseDao {

    private $con;

    private $table_name;

    /**
    * constructor of dao class
    */
    public function __construct($table_name){
        $this->table_name = $table_name;
        $servername = Config::DB_HOST();
        $username = Config::DB_USERNAME();
        $password = Config::DB_PASSWORD();
        $schema = Config::DB_SCHEME();
        $port = Config::DB_PORT();

    try {
        $this->conn = new PDO("mysql:host=$servername;dbname=$schema;port=$port", $username, $password);
        // PDO ERROR MSG
        $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo $e;
    }

  }


  // /*
  // **  Method for get from base
  // */
  //
  //   public function get_all(){
  //    $stmt = $this->conn->prepare('SELECT * FROM '.$this->table_name.';');
  //    $stmt->execute();
  //    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  //     }

      /*
      **  Method for get from base with srch if is not null or get all default
      */

      public function get_all($srch){
         $sql = 'SELECT * FROM '.$this->table_name.' ';
         $srch != NULL ? $sql .= 'WHERE name LIKE "%'.$srch.'%";' : $sql .= ';';
         $stmt = $this->conn->prepare($sql);
         $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }

    /*
    **  Method for get from base
    */

    public function get_by_id($id){
     $stmt = $this->conn->prepare("SELECT * FROM ".$this->table_name." where id = :id");
     $stmt->execute(['id' => $id]);
     $res = $stmt->fetchAll(PDO::FETCH_ASSOC);//**************************************************************************************** try concat line under and this MODIFIE
     return !empty($res) ? reset($res) : 'no data found'; // rest takse 1st array ,first object in this case
      }


      /*
      **  Method for delete from base
      */
      public function delete($id){
        $stmt = $this->conn->prepare("DELETE FROM ".$this->table_name." WHERE id=$id;");
        $stmt->execute();
      }



}


 ?>
