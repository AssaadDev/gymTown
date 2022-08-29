var token = localStorage.getItem('token');

if(!token){
  window.location.replace("#home");
  window.location.reload();
}

$.ajax({
      url: 'rest/Users/'+localStorage.getItem('userID'),
      type: 'GET',
      beforeSend: function(xhr){
        xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
      },
      success: function(result) {
        // append to the list
        $("#myProf").html(`<h1 class="loginclass" id='headerName'>`+result.name+`</h1>
                              <form class="customform custom-log-reg" action="">
                                <p style='font-size: 1.3rem; padding: 0 0 30px;'>Want to change something?</p>
                                <div class="custom-log-reg">
                                  <div class="s-12 l-4 custom-log-reg-input"><input id='name' name="name"  type="text" value='`+result.name+`' /></div>
                                  <div class="s-12 l-4 custom-log-reg-input"><input id='email' name="email"  type="email" disabled value='`+result.email+`' /></div><div class="s-12 l-4 custom-log-reg-input"><input id='phone' name="phone" type="text" disabled value='`+result.phone+`' /></div>
                                  <div class="s-12 l-4 custom-log-reg-input"><input id='gender' name="gender" type="text" disabled value='`+result.gender+`' /></div>

                                  <div class="s-12 l-4 custom-log-reg-input"><input id='password' name="password" placeholder="Change password" type="password" /></div>
                                  <div class="s-12 l-4 custom-log-reg-input"><input id='cpassword' name="cpassword" placeholder="Confirm your new password" type="password" /></div>
                                  <p style='font-size: 1.1rem; padding: 20px 0 10px;'>You must enter password to confirm your cahnges!</p>
                                  <div class="s-12 l-4 custom-log-reg-input"><input id='oldpassword' name="oldpassword" placeholder="Password" type="password" /></div>
                                  </div>

                                <div class="s-12 l-2 right"><button id='changeMyProf' type="submit" onclick="updateMyProfile()">Save changes</button></div>
                                <div class="s-12 l-2 right"><button id='dltAcc' type="submit" style='background: red;' onclick='deleted()'>delete my account</button></div>
                              </form>`);
      //  toastr.success("Added !");
      }
    });

    function deleted(){
      $.ajax({
             url: 'rest/UserDelete/'+localStorage.getItem('userID'),
             type: 'POST',
             beforeSend: function(xhr){
               xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
             },
             data: JSON.stringify(localStorage.getItem('userID')),
             contentType: "application/json",
             dataType: "json",
             success: function(result) {
                 logout();
             },
             error: function(){
               alert("Something went wrong");
             }
           });
    }

    function updateMyProfile(){

      event.preventDefault();

      var name = $('#name').val();
      // var email = $('#email').val();
      //
      // var phone = $('#phone').val();
      // var gender = $('#gender').val();

      var oldpassword = $('#oldpassword').val();
      var password = $('#password').val();
      var cpassword = $('#cpassword').val();

      if(oldpassword == ''){
        return console.log('Please enter your password');
      }
      if(name == '' && password == ''){
        return console.log('Are u sure u want to update anything?');
      }
      if(password != cpassword){
        return console.log('password doesnt match');
      }

      password = $('#password').val() == '' ? oldpassword : $('#password').val();

      const oldData = {
        "id": localStorage.getItem('userID'),
        "password": oldpassword
      };
      const data ={
              "id": localStorage.getItem('userID'),
              "name": name,
              "password": password
          };
          var pass = false;

          $.ajax({
                 url: 'rest/verify',
                 type: 'POST',
                 beforeSend: function(xhr){
                   xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
                 },
                 data: JSON.stringify(oldData),
                 contentType: "application/json",
                 dataType: "json",
                 success: function(result) {
                   //console.log(result);
                   //alert(result.message);
                      pass = true;
                 },
                 error: function(err){
                   pass = false;
                   alert(err.message);
                 }
               });

            setTimeout(() =>{if(pass){
                 $.ajax({
                        url: 'rest/Users/'+localStorage.getItem('userID'),
                        type: 'PUT',
                        beforeSend: function(xhr){
                          xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
                        },
                        data: JSON.stringify(data),
                        contentType: "application/json",
                        dataType: "json",
                        success: function(result) {

                         $('#headerName').text(result.name);
                         $('#oldpassword').val('');
                         $('#password').val('');
                         $('#cpassword').val('');
                         alert('Data has been updated!');
                        },
                        error: function(){

                         alert("Baaaad");
                         $('#oldpassword').val('');
                         $('#password').val('');
                         $('#cpassword').val('');
                        }
                      });
               }else{
                 alert("Error append");
               }}, 1000);
    }
