<?php
require_once __DIR__.'/BaseService.class.php';

class usersService extends BaseService{


  public function __construct(){
      parent::__construct(new UsersDao());
    }


  public function update($data){
    return $this->dao->update($data);
  }

  public function verify($data){
    return $this->dao->verify($data);
  }
  public function deletedUser($id){
    return $this->dao->deletedUser($id);
  }

  public function add($data){
    return $this->dao->add($data);
  }

  public function register($data){
    return $this->dao->register($data);
  }

  public function login($mail){
    return $this->dao->login($mail);
  }
}

?>
