$.get("rest/Plans", function(data){

$('#plansID').html('');

var html="";

for(var i=0; i<data.length ; i++){
var steps="";
  for(var j=0; j<data[i].plan_steps.length; j++){
    if(data[i].plan_steps[j] === ','){
      steps += '<br>';
    }else{
      steps += data[i].plan_steps[j];
    }
  }
  html += `<div class="s-12 m-6 l-4">
     <div class="content-block margin-bottom content-block-xplan">
        <h3>`+data[i].name+`</h3>
        <p>`+steps+`</p>
        </p>
        <p class="content-block-xplan-price">`+data[i].price+` €</p>
     </div>
  </div>`
}
  $('#plansID').html(html);
})
