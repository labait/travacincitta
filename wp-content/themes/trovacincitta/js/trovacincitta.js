(function($){
  $(function(){

    /* slick carousel walkthrough */
    $('#walkthrough.slick').slick({
      dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true
    });
    setTimeout(function(){ $(".bg").show(); }, 8000);
    setTimeout(function(){ $(".overlay").show(); }, 8000);

    /* menu hamburger desktop
    $(".navbar-toggler-icon").click(function(){
        $("#navbarNavDropdown a").show();
        if($("#navbarNavDropdown a").show()){
          $(".navbar-toggler-icon").click(function(){
            $("#navbarNavDropdown a").hide();
          })
        }
    });
    */


    /* menu hamburger colorato mobile */
    $(".navbar-toggler-icon").click(function(){
        $('.bg-dark').attr('style', 'background-color: #fbba00 !important');
        $(".img-fluid").css("filter", "brightness()");
        if($("#navbarNavDropdown a").show()){
          $(".navbar-toggler-icon").click(function(){
            $(".img-fluid").css("filter", "none");
            $('.bg-dark').attr('style', 'background-color: white !important');
          })
        }
    });

    //btn walkthrough
  //  $("#slick-slide-control04").click(function() {
  //    $('.btn_inizia').show()
  //    $('.button-start').hide()
  //  })
  //  $("#slick-slide-control00, #slick-slide-control01, #slick-slide-control02, #slick-slide-control03").click(function() {
  //    $('.btn_inizia').hide()
  //    $('.button-start').show()
  //  })
  
  //$("#slick-slide04").scrollLeft(function() {
    //var $control04 = $('#slick-slide04');
    //if($control04.hasClass("slick-active")){
     // $('.btn_inizia').show();
     // $('.button-start').hide();
    //} else {
      //$('.btn_inizia').hide();
      //$('.button-start').show();			
   // }
  //})


  $('#walkthrough').on('atferChange', function(event, slick, currentSlide){
    var $control04 = $('#slick-slide04');
    if($control04.hasClass("slick-active")){
     $('.btn_inizia').show();
     $('.button-start').hide();
      } else {
      $('.btn_inizia').hide();
      $('.button-start').show();
  }});

  })
})(jQuery)
