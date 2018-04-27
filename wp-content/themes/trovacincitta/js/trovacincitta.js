(function($){
  $(function(){

    // slick carousel walkthrough
    $('#walkthrough.slick').slick({
      dots: true,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true
    });
    setTimeout(function(){ $(".bg").show(); }, 8000);
    setTimeout(function(){ $(".overlay").show(); }, 8000);
  })
})(jQuery)
