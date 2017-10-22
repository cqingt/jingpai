// navigation onscroll
  window.onscroll = function(){
      if((510 < $(document).scrollTop()) && ($(document).height() - $(document).scrollTop()) > 900){
          $('.navigation').fadeIn('slow');
      }else{
          $('.navigation').fadeOut('slow');
      }
}