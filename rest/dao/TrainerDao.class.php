<?php
require_once dirname(__FILE__)."/BaseDao.class.php";


  class TrainerDao extends BaseDao{


        public function __construct(){
            parent::__construct("trainerTable");
          }

        /*
        **  Method for get from base with srch if is not null
        */

        public function get_trainer_by_gender($gen){
           $sql = 'SELECT * FROM trainerTable';
           !empty($gen) ? $sql .= ' WHERE gender LIKE "'.$gen.'";' : $sql .= ';';

           $stmt = $this->conn->prepare($sql);
           $stmt->execute();
           return $stmt->fetchAll(PDO::FETCH_ASSOC);
       }

        /*
        **  Method for add to base
        */

        public function add($data){
          $stmt = $this->conn->prepare("INSERT INTO trainerTable(name,type_of_workout,gender,age,photo) VALUES (:name,:type_of_workout,:gender,:age,:photo)"); // queri samo sa jedin navodnicima!!!, id je auto inc.
          $stmt->execute($data);
          $data['id'] = $this->conn->lastInsertId();
          return $data;
        }

        /*
        **  Method for update base
        */
        public function update($data){
          $stmt = $this->conn->prepare("UPDATE trainerTable SET name=:name,type_of_workout=:type_of_workout,gender=:gender,age=:age,photo=:photo WHERE id = :id");
          $stmt->execute($data);
          return  $data; // retunrs data that is updated.
        }
}
   ?>
