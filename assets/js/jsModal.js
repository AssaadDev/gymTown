function modalOpen(id, type){
  if($("#modalShow").hasClass("hideM")){
    $("#modalShow").removeClass("hideM");
    if(type == "gym"){
      getSingleGym(id);
    }else if(type =='trainer'){
      getSingleTrainer(id);
    }
  }else{
    $("#modalShow").addClass("hideM");
      $('#singleData').html(`<div class="lds-dual-ring"></div>`);
  }
};
