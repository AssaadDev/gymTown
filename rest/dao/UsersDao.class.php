<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once dirname(__FILE__)."/BaseDao.class.php";


  class UsersDao extends BaseDao{


        public function __construct(){
            parent::__construct("usersTable");
          }

        /*
        **  Method for add to base
        */

        public function add($data){
          $stmt = $this->conn->prepare("INSERT INTO usersTable(name,email,password,phone,gender,status) VALUES ( :name,:email,:password,:phone,:gender,:status)"); // queri samo sa jedin navodnicima!!!, id je auto inc.
          $stmt->execute($data);
          $data['id'] = $this->conn->lastInsertId();
          return $data;
        }


        /*
        **  Method for add to base
        */

        public function register($data){
              $stmt = $this->conn->prepare("select * from usersTable where email ='".$data['email']."';");
              $stmt->execute();
              $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($res){
              return Flight::json(['message' => 'Email not avilable'], 500);
            }else{
              $passCode = md5($data['password']);
              $stmt = $this->conn->prepare("insert into usersTable(name,email,password,phone,gender,status) values
                    ( '".$data['name']."','".$data['email']."','".$passCode."','".$data['phone']."','".$data['gender']."','".$data['status']."')"); // queri samo sa jedin navodnicima!!!, id je auto inc.
              $stmt->execute();
              $data['id'] = $this->conn->lastInsertId();
              return $data;
            }
          }


        public function verify($id){
          $stmt = $this->conn->prepare("select * from usersTable where id = '".$id['id']."';");
          $stmt->execute();
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        /*
        **  Method for update base
        */
        public function deletedUser($id){
          $stmt = $this->conn->prepare("UPDATE usersTable SET status='DELETED' WHERE id = ".$id.";");
          $stmt->execute();
          return  $id; // retunrs data that is updated.
        }

        /*
        **  Method for update base
        */
        public function update($data){
          $passCode = md5($data['password']);
          $stmt = $this->conn->prepare("update usersTable set name='".$data['name']."' ,password='".$passCode."' WHERE id = '".$data['id']."' ;");
          $stmt->execute();
          return  $data; // retunrs data that is updated.
        }


        public function login($mail){
          $stmt = $this->conn->prepare("select * from usersTable where email = '".$mail."';");
          $stmt->execute();
          return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
}
   ?>
