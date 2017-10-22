function showHideFilter(obj){
var hasClass = $(obj).hasClass('on');
$(obj).parent().siblings().children('div').hide();
$(obj).siblings().hide();
$(obj).addClass('on');
$(obj).parent().siblings().children('a').addClass('on');
if(hasClass){
$(obj).removeClass('on');
$(obj).siblings().show();
}
}
$(function(){
columnHigth = $('.new-mu_l2w').eq(0).find('li').eq(0).height();
$('a[f="1"]').click(function(e){
var cobj = e.srcElement || e.target;
var id = $(cobj).attr('id');
if(!id)id=$(cobj).parent('a').attr('id')||$(cobj).parent('span').parent('a').attr('id');
if($('#'+id).hasClass('on')){return;}
if(id!='btn_filter'){
$('.new-tab-type2').hide();
$('.new-tab-type3').hide();
$('.new-tab-type4').hide();
}
if($('#'+id).hasClass('on')){
//$('a[f="1"]').removeClass('on');
}else{
var tagSort = !$('#btn_sort').hasClass('on');
var tagStock = !$('#btn_stock').hasClass('on');
var tagDelivery = !$('#btn_delivery').hasClass('on');
if(id!='btn_filter'){
$('a[f="1"]').removeClass('on');
$('#'+id).addClass('on');
}
if(id=='btn_sort'){
if(tagStock && tagDelivery){
$('.new-tab-type2').css({'display':'block','height':'0px'});
$('.new-tab-type2').animate({'height':'34px'},{'duration':'fast'});
}else{
//$('.new-tab-type2').css({'display':'block'});
$('.new-tab-type2').css({'opacity':'0','display':'block'});
$('.new-tab-type2').animate({'opacity':10},'slow');
}
}else if(id=='btn_stock'){
if(tagSort && tagDelivery){
$('.new-tab-type3').css({'display':'block','height':'0px'});
$('.new-tab-type3').animate({'height':'34px'},{'duration':'fast'});
}else{
//$('.new-tab-type3').css({'display':'block'});
$('.new-tab-type3').css({'opacity':'0','display':'block'});
$('.new-tab-type3').animate({'opacity':10},'slow');
}
}else if(id=='btn_delivery'){
if(tagSort && tagStock){
$('.new-tab-type4').css({'display':'block','height':'0px'});
$('.new-tab-type4').animate({'height':'34px'},{'duration':'fast'});
}else{
//$('.new-tab-type4').css({'display':'block'});
$('.new-tab-type4').css({'opacity':'0','display':'block'});
$('.new-tab-type4').animate({'opacity':10},'slow');
}
}else if(id=='btn_filter'){
$('#filterbar').show();
var height = ((document.body||document.documentElement).clientHeight+20)+'px';
if(parseInt($('#slidebar').css('height').replace('px',''))>parseInt(height.replace('px',''))-20){
height = (parseInt($('#slidebar').css('height').replace('px',''))+50)+'px';
}
$('#filterbar').css('height',(parseInt(height.replace('px',''))-50)+"px");
var width = '100%';
var maskArrow = document.createElement("a");
maskArrow.setAttribute('class','new-abtn-slid');
maskArrow.setAttribute('style','z-index:8889;left:auto;right:185px;');
maskArrow.setAttribute('id','_maskArrow');
var mask = document.createElement("div");
mask.setAttribute('id','_mask');
mask.setAttribute('style','position:absolute;left:0px;top:0px;background-color:rgb(13, 13, 13);filter:alpha(opacity=60);opacity: 0.6;width:'+width+';height:'+height+';z-index:8888;');
(document.body||document.documentElement).appendChild(mask);
(document.body||document.documentElement).appendChild(maskArrow);
var scrolltop = (document.body||document.documentElement).scrollTop;
$('#filterbar').css("top",(scrolltop-28)+"px");
document.getElementById('slidebar').setAttribute('style',' -webkit-transform-style: preserve-3d; -webkit-transition: -webkit-transform 0.4s; -webkit-transform-origin: 0px 0px; -webkit-transform: translate(0px, 0); ');
$('#_maskArrow').click(function(){
closeFilter();
});
$('#_mask').click(function(){
closeFilter();
});
}
}
});
$('#select_region').change(function(){
var text = document.getElementById('select_region').options[document.getElementById('select_region').selectedIndex].text;
$('#regionShow').html(text+'<span></span>');
var val = $('#select_region').val();
$('#region').val(val);
if(val=='0'){
$('#stock').val('');
}
$('#condtion').submit();
});
if($('#region').val()!='' && $('#region').val()!='0'){
$('#checkbox_stock').click(function(){
if($('#checkbox_stock').children('span').hasClass('on')){
$('#checkbox_stock').children('span').removeClass('on')
$('#stock').val("");
}else{
$('#checkbox_stock').children('span').addClass('on')
$('#stock').val("1");
}
$('#condtion').submit();
});
}
$('#self_all').click(function(){
$('#self_all').children('span').removeClass('on');
$('#self_jd').children('span').removeClass('on');
$('#self_other').children('span').removeClass('on');
$('#self_all').children('span').addClass('on');
$('#self').val("");
$('#condtion').submit();
});
$('#self_jd').click(function(){
$('#self_all').children('span').removeClass('on');
$('#self_jd').children('span').removeClass('on');
$('#self_other').children('span').removeClass('on');
$('#self_jd').children('span').addClass('on');
$('#self').val("1");
$('#condtion').submit();
});
$('#self_other').click(function(){
$('#self_all').children('span').removeClass('on');
$('#self_jd').children('span').removeClass('on');
$('#self_other').children('span').removeClass('on');
$('#self_other').children('span').addClass('on');
$('#self').val("2");
$('#condtion').submit();
});
$('#btn_prop').click(function(){
$(this).addClass('on');
$('#btn_cat').removeClass('on');
$('#filter_prop').show();
$('#filter_cat').hide();
});
$('#btn_cat').click(function(){
$(this).addClass('on');
$('#btn_prop').removeClass('on');
$('#filter_prop').hide();
$('#filter_cat').show();
});
$('#runtop').hide();
$('#loadmore').on('click', function(){
loadData(true);
});
$('#goToTop').on('click', function(){
window.location.href='#top';
});
$('#geToIndex').on('click', function(){
window.location.href='/index.html?sid='+sid;
});
$('.new-fr').remove();
operaSwitch();
$(window).scroll(function(){
operaSwitch();
loadPage();
}); 
})

  var columnHigth,//列高
    pageNum=1,
    totalPage= 200,//总页数
    reloadNum = 1,//加载次数
    loading = false,//是否在加载中
    provinceId = '',
    resourceType = 'index_category',
    resourceValue='',
    sid='b23369b0b818c26a215f1c51f0c4d68e',
    keyword = '';
  function showHideFilter(obj){
    var hasClass = $(obj).hasClass('on');
    $(obj).parent().siblings().children('div').hide();
    $(obj).siblings().hide();
    $(obj).addClass('on');
    $(obj).parent().siblings().children('a').addClass('on');
    if(hasClass){
      $(obj).removeClass('on');
      $(obj).siblings().show();
    }
  }
  function selectExpandSort(obj){
    $(obj).parent().siblings().children('a').removeClass('on');
    $(obj).addClass('on');
    var div = $('#filter_prop a.on[data]');
    var esId = '';
    for(var i=0,len=div.size();i<len;i++){
      if(esId!='')esId+='-';
      esId+=$(div[i]).attr('data');
    }
    var more = 7-div.length;
    if(more>0){
      for(var i=0;i<more;i++){
        if(esId!='')esId+='-0';
      }
    }
    $('#expandSortId').val(esId);
    $('#condtion').submit();
    closeFilter();
  }
  function selectCategory(obj){
    $(obj).parent().siblings().children('a').removeClass('on');
    $(obj).addClass('on');
    closeFilter();
  }
  function selectCategoryFilter(obj){
    $(obj).parent().siblings().children('a').removeClass('on');
    $(obj).addClass('on');
    
    var param = '';
    var express = $('#filter_prop a.on[data][type="1"]');
    for(var i=0,len=express.size();i<len;i++){
      if($(express[i]).attr('data')!=''){
        if(param!='')param+=',';
        param+=($(express[i]).attr('parent')+":"+$(express[i]).attr('data'));
      }
    }
    $('#expressionKey').val(param);
    
    var price = $('#filter_prop a.on[data][type="2"]');
    $('#minprice').val('');
        $('#maxprice').val('');
    for(var i=0,len=price.size();i<len;i++){
      if($(price[i]).attr('data')!=''){
        content = $(price[i]).attr('data');
        if(content){
              var tmpPrice = content.split('-');
              if(tmpPrice.length==2){
                $('#minprice').val(tmpPrice[0]);
                $('#maxprice').val(tmpPrice[1]);
              }
        }
      }
    }
    
    param = '';
    var expand = $('#filter_prop a.on[data][type="3"]');
    for(var i=0,len=expand.size();i<len;i++){
      if($(expand[i]).attr('data')!=''){
        if(param!='')param+=',';
        param+=($(expand[i]).attr('parent')+":"+$(expand[i]).attr('data'));
      }
    }
    $('#expandName').val(param);
    $('#condtion').submit();
    closeFilter();
  }
  function closeFilter(){
    (document.body||document.documentElement).removeChild(document.getElementById('_mask'));
    (document.body||document.documentElement).removeChild(document.getElementById('_maskArrow'));
    //$('a[f="1"]').removeClass('on');
    document.getElementById('slidebar').setAttribute('style','-webkit-transition: -webkit-transform 0.4s;-webkit-transform-origin: 0px 0px; -webkit-transform-style: preserve-3d;-webkit-transform: translate(190px, 0);');
    setTimeout(function(){
      $('#filterbar').hide();
    },400);
  }
  
  /**悬浮回到顶部开关
   *
   *
  **/
  function operaSwitch(){
    if($('.new-mu_l2w').length > 0){
      if( $(window).scrollTop() >= $(window).height() && totalPage > 0){
        if($('#runtop').css('display') != 'block' || $('#runtop').css('display') != ''){
          $('#runtop').show();
        }
      }else{
        if($('#runtop').css('display') != 'none'){
          $('#runtop').hide();
        }
      }
    }
  }
  /**加载新页
   *
   *
  **/
  function loadPage(){
    if(reloadNum < 4){ //加载次数小于4
        if((columnHigth * $('.new-mu_l2w').length * 15 - columnHigth * 6) < $(window).scrollTop()){
          if(!loading && (pageNum+1) <= totalPage){
            loadData();
          }
        }
    }else{
      if((pageNum+1) <= totalPage){ //如果是最后一页
        $('.list-loading').hide();
        $('.list-nomore').hide()
        $('#page').show();
      }else{
        $('#page').hide();
        $('.list-loading').hide();
        $('.list-nomore').show()
      }
    }
  }
  /**加载数据
   *reload 重置加载次数
  */
  function loadData(reload){
    var loadImg = window.onscroll;// 见/js/html5/common.js
    loading = true;
    $('#page').hide();
    $('.list-nomore').hide();
    $('.list-loading').show();
    Zepto.getJSON(getUrl(pageNum+1), function(data, status, xhr){
      var json = Zepto.parseJSON(data);
      renderColumn(json.wares);
      pageNum++;
      if(reload){
        reloadNum = 1;
      }else{
        reloadNum++;
      }
      loadImg()
      $('.list-loading').hide();
      if(pageNum >= totalPage){
        $('.list-nomore').show();
        $('#page').hide();
      }else{
        loading = false;
      }
    })  
  }
  
  function renderColumn(json){
    var html = ''; 
    html+='<ul class="new-mu_l2w">';
    for(var i = 0 ;i < json.length ; i++){
      var ware = json[i];
      var adword = ware.adword.length > 0 ? ware.adword.replace(/<[^>]*>/g,'') : '';
      var price = parseFloat(ware.jdPrice,10);
      price = price =='NaN'?'':price;
      html+='<li class="new-mu_l2">';
      html+=' <a href="/product/'+ware.wareId+'.html?provinceId=' + provinceId + '&resourceType=' + resourceType + '&resourceValue='+ resourceValue +'&sid='+ sid +'" class="new-mu_l2a">';
      html+='   <span class="new-mu_tmb"><img src="http://st.360buyimg.com/m/images/touch2013/no_100_100.png?v=jd2014121218" imgsrc="' + ware.imgUrlN5.replace('/n4/','/n7/') + '" width="100" height="100" /></span>';
            html+='     <span class="new-mu_l2cw">';
            html+='       <strong class="new-mu_l2h">'+ware.wname+'</strong>';
            html+='       <span class="new-mu_l2h"><span class="new-txt-rd2 new-elps">' + adword + '</span></span>';
            html+='       <span class="new-mu_l2c"><strong class="new-txt-rd2">' + (price?('￥'+price):'暂无报价') + '</strong></span>';
            html+='       <span class="new-mu_l2c new-p-re">';
      html+='         <span class="new-txt">' + ware.totalCount + '人评价' + ((ware.good && !ware.good.indexOf('%')>0)?(ware.good+'好评') : '') +'</span>';
      html+='         <span class="new-sale-icon">' + getShortPromotion(ware.promotionFlag) + '</span>';
      html+='       </span>';
      html+=(ware.canFreeRead?'<span class="new-mu_l2c"><span class="new-online-rd">可在线试读</span></span>':'');
      html+='   </span>';
      html+=' </a>';
            html+='</li>';
    }
    html+='</ul>';
    $('.new-mu_l2w').eq(-1).after(html);
  }
  
  function getShortPromotion(promotionFlag){
    var html ='';
    for(var k in promotionFlag){
      if(k == 100){
        html += '<span class="new-add">享</span>';
      }else if(k == 1){
        html += '<span class="new-del">降</span>';
      }else if(k == 5){
        html += '<span class="new-add2">赠</span>';
      }else if(k == 4){
        html += '<span class="new-del2">豆</span>';
      }else if(k == 3){
        html += '<span class="new-add">券</span>';
      }else{
        html += '<span class="new-add">'+promotionFlag[k]+'</span>';
      }
    }
    return html;
  }
  function getUrl(page){
    var url='';
    if(keyword){
      url = '/ware/search.json?cid=0&keyword=&sort=1&page=' + page + '&expressionKey=&expandName=&minprice=&maxprice=&stock=&resourceType=index_category&resourceValue=&sid=b23369b0b818c26a215f1c51f0c4d68e';
    }else{
      url='/products/1315-1342-1348-0-0-0-0-0-0-0-1-1-' + page + '.html?cid=1348&stock=&resourceType=index_category&resourceValue=&sid=b23369b0b818c26a215f1c51f0c4d68e&_format_=json';
    }
    return url;
  }
  $(function(){
    columnHigth = $('.new-mu_l2w').eq(0).find('li').eq(0).height();
    $('a[f="1"]').click(function(e){
        var cobj = e.srcElement || e.target;
        var id = $(cobj).attr('id');
        if(!id)id=$(cobj).parent('a').attr('id')||$(cobj).parent('span').parent('a').attr('id');
      if($('#'+id).hasClass('on')){return;}
      if(id!='btn_filter'){
          $('.new-tab-type2').hide();
            $('.new-tab-type3').hide();
            $('.new-tab-type4').hide();
      }
      if($('#'+id).hasClass('on')){
        //$('a[f="1"]').removeClass('on');
      }else{
        var tagSort = !$('#btn_sort').hasClass('on');
        var tagStock = !$('#btn_stock').hasClass('on');
        var tagDelivery = !$('#btn_delivery').hasClass('on');
        if(id!='btn_filter'){
          $('a[f="1"]').removeClass('on');
          $('#'+id).addClass('on');
        }
            if(id=='btn_sort'){
          if(tagStock && tagDelivery){
              $('.new-tab-type2').css({'display':'block','height':'0px'});
                $('.new-tab-type2').animate({'height':'34px'},{'duration':'fast'});
          }else{
            //$('.new-tab-type2').css({'display':'block'});
            $('.new-tab-type2').css({'opacity':'0','display':'block'});
            $('.new-tab-type2').animate({'opacity':10},'slow');
          }
            }else if(id=='btn_stock'){
          if(tagSort && tagDelivery){
              $('.new-tab-type3').css({'display':'block','height':'0px'});
                $('.new-tab-type3').animate({'height':'34px'},{'duration':'fast'});
          }else{
            //$('.new-tab-type3').css({'display':'block'});
            $('.new-tab-type3').css({'opacity':'0','display':'block'});
            $('.new-tab-type3').animate({'opacity':10},'slow');
          }
            }else if(id=='btn_delivery'){
          if(tagSort && tagStock){
              $('.new-tab-type4').css({'display':'block','height':'0px'});
                $('.new-tab-type4').animate({'height':'34px'},{'duration':'fast'});
          }else{
            //$('.new-tab-type4').css({'display':'block'});
            $('.new-tab-type4').css({'opacity':'0','display':'block'});
            $('.new-tab-type4').animate({'opacity':10},'slow');
          }
            }else if(id=='btn_filter'){
          $('#filterbar').show();
          var height = ((document.body||document.documentElement).clientHeight+20)+'px';
          if(parseInt($('#slidebar').css('height').replace('px',''))>parseInt(height.replace('px',''))-20){
            height = (parseInt($('#slidebar').css('height').replace('px',''))+50)+'px';
          }
          $('#filterbar').css('height',(parseInt(height.replace('px',''))-50)+"px");
          var width = '100%';
          var maskArrow = document.createElement("a");
          maskArrow.setAttribute('class','new-abtn-slid');
          maskArrow.setAttribute('style','z-index:8889;left:auto;right:185px;');
          maskArrow.setAttribute('id','_maskArrow');
              var mask = document.createElement("div");
          mask.setAttribute('id','_mask');
          mask.setAttribute('style','position:absolute;left:0px;top:0px;background-color:rgb(13, 13, 13);filter:alpha(opacity=60);opacity: 0.6;width:'+width+';height:'+height+';z-index:8888;');
          (document.body||document.documentElement).appendChild(mask);
          (document.body||document.documentElement).appendChild(maskArrow);
          var scrolltop = (document.body||document.documentElement).scrollTop;
          $('#filterbar').css("top",(scrolltop-28)+"px");
          document.getElementById('slidebar').setAttribute('style',' -webkit-transform-style: preserve-3d; -webkit-transition: -webkit-transform 0.4s; -webkit-transform-origin: 0px 0px; -webkit-transform: translate(0px, 0); ');
          $('#_maskArrow').click(function(){
                  closeFilter();
                });
          $('#_mask').click(function(){
                  closeFilter();
                });
            }
      }
      });
    $('#select_region').change(function(){
      var text = document.getElementById('select_region').options[document.getElementById('select_region').selectedIndex].text;
      $('#regionShow').html(text+'<span></span>');
      var val = $('#select_region').val();
      $('#region').val(val);
      if(val=='0'){
        $('#stock').val('');
      }
      $('#condtion').submit();
    });
    if($('#region').val()!='' && $('#region').val()!='0'){
        $('#checkbox_stock').click(function(){
          if($('#checkbox_stock').children('span').hasClass('on')){
            $('#checkbox_stock').children('span').removeClass('on')
            $('#stock').val("");
          }else{
            $('#checkbox_stock').children('span').addClass('on')
            $('#stock').val("1");
          }
          $('#condtion').submit();
        });
    }
    $('#self_all').click(function(){
      $('#self_all').children('span').removeClass('on');
      $('#self_jd').children('span').removeClass('on');
      $('#self_other').children('span').removeClass('on');
      $('#self_all').children('span').addClass('on');
      $('#self').val("");
      $('#condtion').submit();
    });
    $('#self_jd').click(function(){
      $('#self_all').children('span').removeClass('on');
      $('#self_jd').children('span').removeClass('on');
      $('#self_other').children('span').removeClass('on');
      $('#self_jd').children('span').addClass('on');
      $('#self').val("1");
      $('#condtion').submit();
    });
    $('#self_other').click(function(){
      $('#self_all').children('span').removeClass('on');
      $('#self_jd').children('span').removeClass('on');
      $('#self_other').children('span').removeClass('on');
      $('#self_other').children('span').addClass('on');
      $('#self').val("2");
      $('#condtion').submit();
    });
    $('#btn_prop').click(function(){
      $(this).addClass('on');
      $('#btn_cat').removeClass('on');
      $('#filter_prop').show();
      $('#filter_cat').hide();
    });
    $('#btn_cat').click(function(){
      $(this).addClass('on');
      $('#btn_prop').removeClass('on');
      $('#filter_prop').hide();
      $('#filter_cat').show();
    });
    $('#runtop').hide();
    $('#loadmore').on('click', function(){
      loadData(true);
    });
    $('#goToTop').on('click', function(){
      window.location.href='#top';
    });
    $('#geToIndex').on('click', function(){
      window.location.href='/index.html?sid='+sid;
    });
    $('.new-fr').remove();
    operaSwitch();
    $(window).scroll(function(){
      operaSwitch();
      loadPage();
    }); 
  })