<?php
require_once dirname(__FILE__)."/BaseDao.class.php";


  class GymsDao extends BaseDao{


        public function __construct(){
            parent::__construct("gymTable");
          }

       //  /*
       //  **  Method for get from base with srch if is not null
       //  */
       //
       //  public function get_all_srch($srch){
       //     $sql = 'SELECT * FROM gymTable ';
       //     if(!empty($srch)){
       //           $sql .= 'WHERE name LIKE "%'.$srch.'%"';
       //         }
       //     $stmt = $this->conn->prepare($sql);
       //     $stmt->execute();
       //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
       // }

        /*
        **  Method for add to base
        */

        public function add($data){
          $stmt = $this->conn->prepare("INSERT INTO gymTable(name, address, phone, photo, workTime) VALUES ( :name , :address ,:phone, :photo, :workTime)"); // queri samo sa jedin navodnicima!!!, id je auto inc.
          $stmt->execute($data);
          $data['id'] = $this->conn->lastInsertId();
          return $data;
        }

        /*
        **  Method for update base
        */
        public function update($data){
          $stmt = $this->conn->prepare("UPDATE gymTable SET name=:name,address=:address,phone=:phone, photo=:photo, workTime=:workTime WHERE id = :id");
          $stmt->execute($data);
          return  $data; // retunrs data that is updated.
        }
}
   ?>
