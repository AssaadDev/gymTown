<?php
require_once __DIR__.'/BaseService.class.php';

class trainerService extends BaseService{


  public function __construct(){
      parent::__construct(new TrainerDao());
    }

    public function get_trainer_by_gender($gen){  // adjust parametar in rout
      return $this->dao->get_trainer_by_gender($gen);
    }

  public function update($data){
    return $this->dao->update($data);
  }

  public function add($data){
    return $this->dao->add($data);
  }

}

?>
