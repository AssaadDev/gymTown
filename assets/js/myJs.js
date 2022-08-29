$.get("rest/Merch", function(data){

$('#merch_Galery').html('');

var html="";
for(var i=0; i<4 ; i++){
  html += `
  <div class="s-12 m-6 l-3">
     <img src="`+data[i].photo+`" alt="alternative text" style="max-width:400px; max-height: 200px">
       <p class="subtitile">`+data[i].name+`</p>
  </div>`
}
  $('#merch_Galery').html(html);
  // console.log(data);
})

jQuery(document).ready(function($) {
      var owl = $('#header-carousel');
      owl.owlCarousel({
        nav: true,
        dots: false,
        items: 1,
        loop: true,
        navText: ["&#xf007","&#xf006"],
        autoplay: true,
        autoplayTimeout: 4000
     });
     var owl = $('#news-carousel');
     owl.owlCarousel({
        nav: true,
        dots: false,
        items: 1,
        loop: true,
        navText: ["&#xf007","&#xf006"],
        autoplay: true,
        autoplayTimeout: 4000
     });
   });
