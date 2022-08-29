
var token = localStorage.getItem('token');

if(token){
  window.location.replace("#home");
  window.location.reload();
}



function register(){
  event.preventDefault();

  var name = $('#name').val();
  var email = $('#email').val();
  var password = $('#password').val();
  var cpassword = $('#cpassword').val();
  var phone = $('#phone').val() ? $('#phone').val() : null;
  var gender = $('#gender option:selected').text();

  if(name.length < 3){
    return alert('name must be longer than 3 !');
  }
  if(email.length < 6){
    return alert('enter valid email !');
  }
  if( password.length < 5){
      return alert("Please enter valid password! Mininum length is 5");
  }
  if(password != cpassword){
    return alert("Pasword doenst match!");
  }

  if(gender == 'Gender'){
    return alert("Please select your gender");
  }


  const data =  {
        "name": name,
        "email": email,
        "password": password,
        "phone": phone,
        "gender": gender,
        "status": "ACTIVE"
    };

//console.log(data);
  // $.post( "rest/register", function( data ) {
  //   console.log(data);
  //
  // });
  $.ajax({
         url: 'rest/register',
         type: 'POST',
         // beforeSend: function(xhr){
         //   xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
         // },
         data: JSON.stringify(data),
         contentType: "application/json",
         dataType: "json",
         success: function(result) {
             $('#name').val('');
             $('#email').val('');
             $('#password').val('');
             $('#cpassword').val('');
             $('#phone').val('')
             $('#gender option:selected').text('Gender');
             window.location.replace("#login");
         }
       });
}


function login(){

  event.preventDefault();

  var mail = $('#mail').val();
  var pass = $('#pass').val();

  if(mail.length <= 0 && pass.length <= 0){
    return alert('Enter password and email');
  }

  const data = {
    "email": mail,
    "password": pass
  }

  $.ajax({
         url: 'rest/login',
         type: 'POST',
         data: JSON.stringify(data),
         contentType: "application/json",
         dataType: "json",
         success: function(result) {
             //alert("you are in");
             localStorage.setItem("token", result.token);
             localStorage.setItem("userID", result.userID);
             localStorage.setItem("status", result.status);
             $('#myprof').removeClass("hideNavBtn");

                $('#logInOut').text('Log out');
                $('#logInOut').removeAttr("href");
                $('#logInOut').attr("onclick", "logout()");

             $('#mail').val('');
             $('#pass').val('');
             window.location.replace("#home");
             window.location.reload();
         },
         error: function(){
           alert("STOP");

         }
       });
}
