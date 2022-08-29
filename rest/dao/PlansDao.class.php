<?php
require_once dirname(__FILE__)."/BaseDao.class.php";


  class PlansDao extends BaseDao{


        public function __construct(){
            parent::__construct("planTable");
          }
          /*
          **  Method for add to base
          */

          public function add($data){
            $stmt = $this->conn->prepare("INSERT INTO planTable(name,plan_steps,price) VALUES ( :name, :plan_steps, :price)"); // queri samo sa jedin navodnicima!!!, id je auto inc.
            $stmt->execute($data);
            $data['id'] = $this->conn->lastInsertId();
            return $data;
          }

          /*
          **  Method for update base
          */
          public function update($data){
            $stmt = $this->conn->prepare("UPDATE planTable SET name=:name, plan_steps=:plan_steps, price=:price WHERE id = :id");
            $stmt->execute($data);
            return  $data; // retunrs data that is updated.
          }
}
   ?>
