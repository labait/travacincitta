(function($){
  $(function(){
    //loading
    $('body').loading({
      stoppable: true
    });

    // slick carousel walkthrough
    $('#walkthrough.slick').slick({
      dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true
    });
  })
})(jQuery)
