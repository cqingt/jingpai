// JavaScript Document
$(function(){
    var oUl=document.getElementById('ul_container'),
        l = oUl.offsetWidth/2,
        t = oUl.offsetHeight/2,
        aLi=oUl.getElementsByTagName('li');
    oUl.onmousemove = function( ev ){
        var oEv = ev || event,
            iL = oEv.clientX,
            iT = oEv.clientY;

        for(var i=0; i<aLi.length; i++){
            aLi[i].style.marginLeft=(iL - l )/100*aLi[i].style.zIndex+'px';
            aLi[i].style.marginTop=(iT - t )/70*aLi[i].style.zIndex+'px';
        }
    }
});
// navigation onscroll
  window.onscroll = function(){
      if((620 < $(document).scrollTop()) && ($(document).height() - $(document).scrollTop()) > 1500){
          $('.navigation').fadeIn('slow');
      }else{
          $('.navigation').fadeOut('slow');
      }
}