// jquery 20160408 GJ

$(".btnone").bind("click", function(event) { 
   $(".popup,.btn-tier").show(); 
});

$(".btn-tier,.btn-close").bind("click", function(event) { 
    $(".popup,.btn-tier").hide();
});

function copyUrl2() {
    var Url2=document.getElementById("biao1");
    Url2.value.select();  
    document.execCommand("Copy");  
    alert("已复制好，可贴粘。");
}