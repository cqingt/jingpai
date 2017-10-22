// navigation onscroll
  window.onscroll = function(){
      if((530 < $(document).scrollTop()) && ($(document).height() - $(document).scrollTop()) > 2300){
          $('.navigation').fadeIn('slow');
      }else{
          $('.navigation').fadeOut('slow');
      }
}

// CSS3 
 

