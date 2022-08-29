$.get("rest/Trainer", function(data){

$('#trainersID').html('');

var html="";
for(var i=0; i<data.length ; i++){
  html +=   `<div class="s-12 m-6 l-4" onclick="modalOpen(`+data[i].id+`,'trainer')">
     <div class="content-block margin-bottom content-block-xplan">
       <img src="`+data[i].photo+`" alt style="max-width:400px; max-height: 200px">
       <h4>`+data[i].name+`</h4>
       <p class="fontfix-trainer">Type: `+data[i].type_of_workout+`</p>
       <p class="fontfix-trainer">Gender: `+data[i].gender+`</p>
       <p class="fontfix-trainer">Year: `+data[i].age+`</p>
        <p class="content-block-xplan-price">Not Avilable</p>
     </div>
  </div>`;
}
  $('#trainersID').html(html);
})



function getSingleTrainer(id){
  $.get( "rest/Trainer/"+id, function(data){

  $('#singleData').html('');

  var html="";
  
    html +=   `
        <img src="`+data.photo+`" alt="" style="max-width:285px; max-height: 189px; border-radius: 30px">
        <p class="shop-merch-block-name">`+data.name+`</p>
        <p class="shop-merch-block-name">Workout type: <br> `+data.type_of_workout+`</p>
        <p class="shop-merch-block-name">Gender: <br>`+data.gender+`</p>
        <p class="shop-merch-block-name">Age: <br>`+data.age+`</p>
        <p class="shop-merch-block-name" style='width: 50%'>Short description about `+data.name+`: <br>`+data.description+`</p>
  `;

    $('#singleData').html(html);
});
}
