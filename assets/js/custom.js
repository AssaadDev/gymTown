$(document).ready(function() {

  $("main#spapp > section").height($(document).height() - 60);

   var app = $.spapp({pageNotFound : 'error_404'}); // initialize
   var app = $.spapp({
  defaultView  : "home",
  templateDir  : "./pages/",
  pageNotFound : "error_404"
});
  // define routes
  app.route({view: 'home', load: 'home.html' });
  app.route({view: 'shop', load: 'shop.html' });
  app.route({view: 'plans', load: 'plan.html' });
  app.route({view: 'trainers', load: 'trainers.html' });
  app.route({view: 'contact', load: 'contact.html' });
  app.route({view: 'login', load: 'login.html' });
  app.route({view: 'register', load: 'register.html' });
  app.route({view: 'myprofile', load: 'myprofile.html' });
  // run app
  app.run();

});

var token = localStorage.getItem('token');

if(token){
  $('#logInOut').text('Log out');
  $('#logInOut').removeAttr("href");
  $('#logInOut').attr("onclick", "logout()");
  $('#myprof').removeClass("hideNavBtn");
}
function logout(){
  localStorage.clear();

  $('#logInOut').text('Log in');
  $('#logInOut').attr("href", "#login");
  $('#logInOut').removeAttr("onclick", "logut");

  $('#myprof').addClass("hideNavBtn");

  window.location.replace("#home");
  window.location.reload();
}

// 
// function getNav(){
//   var url = $(location).attr('href');
//   console.log(url);
//   var nav = '';
//   var strNumb;
//   for(let i =0; i<url.length; i++){
//     if(url[i] == '#'){
//       strNumb = i+1;
//       break;
//     }
//   }
//   for(let i=strNumb; i<url.length; i++){
//       nav += url[i];
//     }
//     console.log(nav);
//   }
