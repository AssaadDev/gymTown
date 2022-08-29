<?php
require_once dirname(__FILE__)."/BaseDao.class.php";


  class MerchDao extends BaseDao{


        public function __construct(){
            parent::__construct("merchTable");
          }

        /*
        **  Method for get from base with srch if is not null
        */

        public function get_query_spec($category, $gender){
           $sql = 'SELECT * FROM merchTable ';
           if(!empty($category)){
                 $sql .= 'WHERE category LIKE "'.$category.'" ';
                 !empty($gender) ? $sql .= 'AND (gender LIKE "'.$gender.'" OR  gender LIKE "unisex");' : $sql .= ';';
               }else{
                 $sql .= 'WHERE gender LIKE "'.$gender.'" OR  gender LIKE "unisex";';
               }

           $stmt = $this->conn->prepare($sql);
           $stmt->execute();
           return $stmt->fetchAll(PDO::FETCH_ASSOC);
       }

        /*
        **  Method for add to base
        */

        public function add($data){
          $stmt = $this->conn->prepare("INSERT INTO merchTable(name,price,gender,photo,category) VALUES ( :name , :price, :gender, :photo, :category)"); // queri samo sa jedin navodnicima!!!, id je auto inc.
          $stmt->execute($data);
          $data['id'] = $this->conn->lastInsertId();
          return $data;
        }

        /*
        **  Method for update base
        */
        public function update($data){
          $stmt = $this->conn->prepare("UPDATE merchTable SET name=:name, price=:price, gender=:gender, photo=:photo, category=:category WHERE id = :id");
          $stmt->execute($data);
          return  $data; // retunrs data that is updated.
        }
}
   ?>
