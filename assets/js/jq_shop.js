
getMerch();

function getMerch(){

  var cat;
  var gen;

  if ($('#top').is(':checked')) {
   cat='top';
 }else if($('#shoes').is(':checked')) {
   cat='shoes';
 }else if ($('#bottom').is(':checked')) {
   cat='bottom';
 }else {
   cat=null;
 }


 if ($("#male").is(":checked")) {
    gen='male';
 }else if($("#female").is(":checked")) {
    gen='female';
 }else if ($("#unisex").is(":checked")) {
    gen='unisex';
 }else {
    gen=null;
 }

  var api = "rest/Merch";

  if(cat != null || gen != null){
    api += "?";
    if(cat != null){
      api += "category="+cat+"&";
    }
    if(gen != null){
      api += "gender="+gen;
    }
  }

  $.get(api, function(data){
  $('#shopItems').attr('style', 'display: grid');
  $('#shopItems').html('');
  var price= null;
  var html="";
  for(var i=0; i<data.length ; i++){
    price = data[i].price === 'COMING SOON' ? data[i].price : data[i].price+' $';
    html += `<div class="s-12 m-6 l-4" >
       <div class="content-block margin-bottom content-shop-fix">

           <img src="`+data[i].photo+`" alt="item" class='myImgSHop'>
           <p class="shop-merch-block-name">`+data[i].name+`</p>
           <p class="shop-merch-block-price">`+price+`</p>
       </div>
    </div>`
  }
    $('#shopItems').html(html);
  })

checkAdmin();
}


function getShop(){
  event.preventDefault();
  getMerch();
}

function checkAdmin(){
  if(localStorage.getItem('status') === 'ADMIN' && localStorage.getItem('token')){
    $('#adminShop').html('<p class="shop-merch-block-name">Shop settings</p><button class="shop-form-b" value="Add" onclick="addMerch()">Add merch</button>');
  }
}

function addMerch(){
  $('#adminShop').html('<button class="shop-form-b" value="Add" onclick="getMerch()">Back</button>');
      $('#shopItems').attr('style', 'display: block');

    $('#shopItems').html(`<form class="customform custom-log-reg" >
      <div class="custom-log-reg">
        <div class="s-12 l-4 custom-log-reg-input"><input id='name' name="name" placeholder="Enter name" type="text" /></div>
        <div class="s-12 l-4 custom-log-reg-input"><input id='price' name="price" placeholder="Enter price or 'COMING SOON'" type="text" /></div>
        <div class="s-12 l-4 custom-log-reg-input"><input id='photo' name="photo" placeholder="Photo, URL ONLY!" type="text" /></div>

        <div class="s-12 l-6" style='width: 100%'>
          <select form="select" id='gender' name='gender'>
          <option value="null" disabled selected>Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="unisex">Unisex</option>
          </select>
        </div>

        <div class="s-12 l-6" style='width: 100%'>
          <select form="select" id='category' name='category'>
          <option value="null" disabled selected>Category</option>
          <option value="top">Top</option>
          <option value="bottom">Bottom</optio>
          <option value="shoes">Shoes</option>
          </select>
        </div>

      </div>

      <div class="s-12 l-2 right"><button type="submit" onclick="addAdminShop()">Add item</button></div>

    </form>`);
}

function addAdminShop(){
  event.preventDefault();

  var name = $('#name').val();
  var price = $('#price').val();
  var photo = $('#photo').val();
  var gender = $('#gender option:selected').text();
  var category = $('#category option:selected').text();


  if(name == '' || price == '' || photo == '' || gender == '' || category == '' ){
    alert('enter sometn');
    return false;
  }

  const data =  {
        "name": name,
        "price": price,
        "photo": photo,
        "gender": gender,
        "category": category
    };

    $.ajax({
           url: 'rest/MerchAdd',
           type: 'POST',
           beforeSend: function(xhr){
             xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
           },
           data: JSON.stringify(data),
           contentType: "application/json",
           dataType: "json",
           success: function(result) {
               $('#name').val('');
               $('#price').val('');
               $('#photo').val('');
               $('#category option:selected').text('Category');
               $('#gender option:selected').text('Gender');
               getMerch();
           }
         });

}
