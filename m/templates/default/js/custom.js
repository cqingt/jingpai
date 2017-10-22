// JavaScript Document

// navhome
$(document).ready(function(){
   $(".angle-down").toggle(function(){
     $(".navhome").animate({height:"100%"}, 300);
   },function(){
     $(".navhome").animate({height:"32px"}, 200);
   });
});