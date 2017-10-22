<?php defined('InShopNC') or exit('Access Invalid!');?>

    <style>
        .last {
            margin-left: 0 !important;
        }
        .bean-list {
            width: 980px;
            overflow: hidden;
            padding-top: 14px;
        }
        .bean-list ul li {
            float: left;
            margin-left: 22px;
            margin-bottom: 20px;
            border: 2px #fff solid;
        }
        .bean-list ul li a {
            border: 1px #e6e6e6 solid;
            display: block;
            width: 306px;
            height: 340px;
            overflow: hidden;
        }
        .bean-list ul li a .beanimg {
            position: relative;
            width: 240px;
            height: 240px;
            overflow: hidden;
        }
        .bean-list ul li a .beanimg .over {
            position: absolute;
            bottom: 10px;
            right: 10px;
        }
        .bean-list ul li a .beanimg img {
            width: 100%;
        }
        .bean-list ul li a .beaniword {
            width: 234px;
            float: left;
            padding: 0 10px;
        }
        .bean-list ul li a .beaniword h2 {
            font-size: 14px;
            line-height: 16px;
            height: 32px;
            width: 292px;
            margin-top: 10px;
            overflow: hidden;
            color: #555;
        }
        .bean-list ul li a .beaniword .p1 {
            font: 14px/16px 'Microsoft YaHei';
            color: #999;
            margin-top: 8px;
        }
        .bean-list ul li a .beaniword .p1 em {
            text-decoration:line-through;
        }
        .bean-list ul li a .beaniword .finish {
            font-size: 16px;
            color: #ec4f4a;
            margin-top: 2px;
            font-family: 'Microsoft YaHei';
        }
        .bean-list ul li a .beaniword .finish em {
            font: 12px/20px 'Microsoft YaHei';
            color: #999;
            display: block;
            float: left;
            margin-right: 8px;
        }
        .bean-list ul li a .beaniword .finish em i {
            margin: 0 6px;
        }
        .bean-list ul li a .beaniword .finish strong {
            color: #000;
        }
        .bean-list ul li a .numberbox {
            float: right;
            width: 42px;
            height: 44px;
            margin: 45px 10px 0 0;
            color: #fff;
            background: #ef4d4a;
            text-align: center;
        }
        .bean-list ul li a .numberbox h4 {
            font-size: 20px;
            font-size: 14px;
            padding-top: 2px;
            border-top: 2px #dd2429 solid;
        }
        .bean-list ul li a .numberbox p {
            font-size: 12px;
            line-height: 12px;
            font-size: 14px;
        }
        .bean-title {
            border-bottom: 1px #e7e7e7 solid;
            margin-bottom: 20px;
        }
        .bean-title h2 {
            font-size: 16px;
            padding-bottom: 6px;
        }
        .bean-title h2 strong {
            color: #ec4f4a;
        }
        .bean-title h2 a {
            font-size: 14px;
            color: #3672ae;
            text-decoration: underline;
            margin-left: 4px;
        }

        .form-edit {
            margin: 10px 0 0 46px;
        }
        .form-edit .form-control {
            width: 272px;
        }
    </style>
    <div id="edit_addr" class="dialog_wrapper ui-draggable" ><div class="dialog_body" style="position: relative;"><div class="dialog_content" style="margin: 0px; padding: 0px;">
                <div class="eject_con">
                    <div class="adds">
                        <div id="warning" style="display: none;"></div>
                        <form method="post" action="index.php?act=cangdou&op=exchange_on" id="address_form" target="_parent">
                            <input type="hidden" name="form_submit" value="ok">
                            <input type="hidden" name="gift_id" value="<?php echo $_GET['gift_id']?>">

                            <?php if(!empty($output['address_list'])){?>
                                <div class="form-edit">
                                    <select name="addr" class="form-control">
                                        <option value="0">选择已有收货地址</option>
                                        <?php foreach($output['address_list'] as $k=>$v){ ?>
                                            <option value="<?php echo $v['address_id']?>">收货人：<?php echo $v['true_name']?>（<?php echo $v['mob_phone']?>）<?php echo $v['area_info'].$v['address']?></option>
                                        <?php } ?>
                                        <select>
                                </div>
                            <?php } ?>

                            <div id="new_addr">

                            </div>


                            <div class="bottom">
                                <label class="submit-border">
                                    <input type="submit" class="submit" value="兑换">
                                </label>
							<!--
                                <a class="ncm-btn ml5" href="javascript:;" id="cancel">取消</a> </div>
								-->
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <div style="clear:both; display:block;"></div>
    </div>

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js" charset="utf-8"></script>
<script type="text/javascript">
$(function(){

    function addAddr(){
        $('#new_addr').load(SITEURL+'/index.php?act=cangdou&op=add_address');
    }
    addAddr();
    
    $("select[name=addr]").change(function(){
        if($(this).val() == 0){
            addAddr();
        }else{
            $('#new_addr').html('');
        }
    })

});
</script>