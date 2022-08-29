
getGyms();

function getGyms(){
event.preventDefault();
  var api = $('#search').val() != '' ? "rest/Gyms?search="+$('#search').val() : "rest/Gyms";

  $.get(api, function(data){

  $('#gymsPlaces').html('');
  var html="";
  var btn = "";
  const type = 'gym';

  for(var i=0; i<data.length ; i++){
    if(localStorage.getItem('status') === 'ADMIN' && localStorage.getItem('token')){
      btn = `<button class="shop-form-b" style='margin: 0px 0px 40px' onclick="editGym(`+data[i].ID+`)">Edit `+data[i].name+`</button>`;
    }
    html +=   `<div id='box`+data[i].ID +`' class="s-12 m-6 l-4 box-dark" id="modalOpen" >
      <div class="content-block margin-bottom content-shop-fix"  onclick="modalOpen(`+data[i].ID +`,'gym')">

        <img src="`+data[i].photo+`" alt="gym" class='myImgGym'>
        <p class="shop-merch-block-name">`+data[i].name+`</p>
        <p class="shop-merch-block-price">Working: <br>`+data[i].workTime+`</p>
    </div>
    `+btn+`
  </div>`;
  btn = "";
  }
    $('#gymsPlaces').html(html);
});
};

function editGym(id){
  $.get( "rest/Gyms/"+id, function(data){
    $('#box'+id).html('<div class="lds-dual-ring"></div>');
    var html="";

        html +=   `
            <div class="content-block margin-bottom content-shop-fix">
              <img src="`+data.photo+`" alt="" style="max-width:285px; max-height: 189px; border-radius: 30px; margin-bottom: 20px">
                <lable style="color: white; font-size: 0.8rem">Photo</lable>
                <div class="s-12 l-4 " ><input id='photo`+data.ID+`' name="photo" placeholder="Photo, URL ONLY!" type="text" value='`+data.photo+`' /></div>
                <lable style="color: white; font-size: 0.8rem">Name</lable>
                <div class="s-12 l-4 "><input id='name`+data.ID+`' name="name" value='`+data.name+`' /></div>
                <lable style="color: white; font-size: 0.8rem">WorkTime</lable>
                <div class="s-12 l-4 "><input id='workTime`+data.ID+`' name="workTime" value='`+data.workTime+`' /></div>
                <lable style="color: white; font-size: 0.8rem">Phone</lable>
                <div class="s-12 l-4 "><input id='phone`+data.ID+`' name="phone" value='`+data.phone+`' /></div>
                <lable style="color: white; font-size: 0.8rem">Address</lable>
                <div class="s-12 l-4 "><input id='address`+data.ID+`' name="address" value='`+data.address+`' /></div>
              <button class="shop-form-b btnSaveGym" onclick="updateGym(`+data.ID+`)">Save changes</button>
              <button class="shop-form-b" onclick="reversGym(`+data.ID+`)">Back</button>
            </div>`;

        $('#box'+id).html(html);
    });
}

function updateGym(gymId){
  var id = gymId;
  var photo = $('#photo'+gymId).val();
  var name = $('#name'+gymId).val();
  var workTime = $('#workTime'+gymId).val();
  var phone = $('#phone'+gymId).val();
  var address = $('#address'+gymId).val();


  if(id == ' ' || photo == ' ' || name == ' ' || workTime == ' ' || phone == ' ' || address == ' '){
    alert("fill all inputs!");
    return false;
  }

  const data =  {
        "id": id,
        "photo": photo,
        "name": name,
        "workTime": workTime,
        "phone": phone,
        "address": address
    };


  $.ajax({
         url: 'rest/GymUp/'+gymId,
         type: 'PUT',
         beforeSend: function(xhr){
           xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
         },
         data: JSON.stringify(data),
         contentType: "application/json",
         dataType: "json",
         success: function(result) {
             reversGym(id);
         }
       });

}

function reversGym(id){
  $.get("rest/Gyms/"+id, function(data){

      $('#box'+id).html('');
      var html="";
      const type = 'gym';

        html +=   `  <div class="content-block margin-bottom content-shop-fix"  onclick="modalOpen(`+data.ID +`,'gym')">

                        <img src="`+data.photo+`" alt="gym" class='myImgGym'>
                        <p class="shop-merch-block-name">`+data.name+`</p>
                        <p class="shop-merch-block-price">Working: <br>`+data.workTime+`</p>
                    </div>
                    <button class="shop-form-b" style='margin: 0px 0px 40px' onclick="editGym(`+data.ID+`)">Edit `+data.name+`</button>`;

        $('#box'+id).html(html);
});
}

function getSingleGym(id){

      $.get( "rest/Gyms/"+id, function(data){
        $('#singleData').html('');
        var html="";

            html +=   `
                <img src="`+data.photo+`" alt="" style="max-width:285px; max-height: 189px; border-radius: 30px">
                <p class="shop-merch-block-name">`+data.name+`</p>
                <p class="shop-merch-block-name">Working: <br> `+data.workTime+`</p>
                <p class="shop-merch-block-name">Phone: <br>`+data.phone+`</p>
                <p class="shop-merch-block-name">Address: <br>`+data.address+`</p>`;



            $('#singleData').html(html);
        });


}

// ​$('#srcGm').click(function(e){
//     e.preventDefault();
//       getGyms();
// })​

// MODAL START



// MODAL END
