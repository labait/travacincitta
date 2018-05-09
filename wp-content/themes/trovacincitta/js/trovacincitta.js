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

    $('#walkthrough').on('afterChange', function(event, slick, currentSlide){
      $((currentSlide == 4 ? '.button-skip' : '.button-start')).hide();
      $((currentSlide == 4 ? '.button-start' : '.button-skip')).show();
    });

  })
})(jQuery)
