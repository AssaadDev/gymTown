<?php
require_once __DIR__.'/BaseService.class.php';

class merchService extends BaseService{


  public function __construct(){
      parent::__construct(new MerchDao());
    }

    public function get_query_spec($category, $gender){ // in rout add these params
      return $this->dao->get_query_spec($category, $gender);
    }

  public function update($data){
    return $this->dao->update($data);
  }

  public function add($data){
    return $this->dao->add($data);
  }

}

?>
