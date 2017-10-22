<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/artist_new/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">
<style>
    .ui-border {
        border: 1px solid #e0e0e0;
    }
    .ui-nowrap {
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
<div style="height:45px;"></div>

<div class="demo-writer">
    <?php if(!empty($output['artist_list']) && is_array($output['artist_list'])){ ?>
    <ul class="blogs-album-art">
        <?php foreach($output['artist_list'] as $key=>$v){?>
            <li class="ui-border">
                <i class="btn-remove" aid="<?php echo $v['C_Id'];?>"></i>
                <a href="<?php echo urlWap('artist_blog','index',array('aid'=>$v['A_Id']))?>">
                    <div class="photo">
                        <i class="img" style="background: url(<?php echo BASE_SITE_URL.'/'.$v['A_Img'];?>);"></i>
                    </div>
                    <h1 class="ui-nowrap"><?php echo $v['A_Name']?></h1>
                    <h2 class="ui-nowrap"><?php $zhi = explode('|',$v['A_ZhiCheng']);echo reset($zhi);?></h2>
                </a>
            </li>
        <?php }?>
    </ul>
<?php }else{?>
<div class="no-record">暂无记录</div>
<?php }?>
</div>
<div style="height:55px;"></div>

<script type="text/javascript">
    //加载更多
    var load_flag=false;
    var page_num = <?php echo $output['page_num']?>;
    var p = 2;
    $(function(){

        $(window).scroll(function(){

            if(load_flag){

                return;

            }

            var totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());

            if(totalheight>=$(document).height()){

                $("#loadmore").show();

                load_flag=true;

                loadMore();

            }

        });


        $(document).on('click','.btn-remove',function(){
            var id = $(this).attr('aid');
            var url = "<?php echo urlWap('member_favorites','delShoucang',array('id'=>''));?>";
            if(id){
                window.location.href=url+id;
            }
        })
    });

    function loadMore(){
        if( p <= page_num ) {
            $.ajax({
                type: 'GET',
                url: 'index.php?act=member_favorites&op=ajaxajaxfavorites_artist',
                data: 'curpage=' + p,
                success: function (msg) {
                    if (msg) {
                        var arr = eval(msg);
                        var len = arr.length;
                        var str = '';
                        for (var i = 0; i < len; i++) {
                            str+= '<li class="ui-border"><i class="btn-remove"></i><a href="index.php?act=artist_blog&amp;op=index&amp;aid=' + arr[i]['A_Id'] + '"><div class="photo"><i class="img" style="background: url(<?php echo BASE_SITE_URL;?>/' + arr[i]['A_Img'] + ');"></i></div><h1 class="ui-nowrap">' + arr[i]['A_Name'] + '</h1><h2 class="ui-nowrap">' + arr[i]['A_ZhiCheng'] + '</h2></a></li>';
                        }
                        $('.blogs-album-art > li').last().after(str);
                        p = parseInt(p) + 1;
                        load_flag = false;
                    }
                }
            });
        }
    }
</script>