// JavaScript Document

// navhome
$(document).ready(function(){
   $(".angle-down").toggle(function(){
     $(".navhome").animate({height:"100%"}, 300);
   },function(){
     $(".navhome").animate({height:"26px"}, 200);
   });
});
$(document).ready(function(){
   $("#hea-btn").toggle(function(){
     $(".navhome-two").css({display:"block"});
   },function(){
     $(".navhome-two").css({display:"none"});
   });
});