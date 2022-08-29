<?php
require_once __DIR__.'/BaseService.class.php';

class plansService extends BaseService{


  public function __construct(){
      parent::__construct(new PlansDao());
    }

  public function update($data){
    return $this->dao->update($data);
  }

  public function add($data){
    return $this->dao->add($data);
  }

}

?>
