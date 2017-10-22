<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css" />
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/navigation.css" />
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css" />

<!-- add -->
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/paimaihui_pm.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/normalize.css" />
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/demo_pm.css" />
<!-- add end -->

<section>
    <ul class="mebzj investment_title">

      <li><a href="<?php echo urlWap('member_pm','my_deposit',array('type'=>1));?>">所有状态</a></li>

      <li><a href="<?php echo urlWap('member_pm','my_deposit',array('type'=>2));?>">未返还</a></li>

      <li><a href="<?php echo urlWap('member_pm','my_deposit',array('type'=>3));?>">已返还</a></li>

    </ul>       



    <div class="investment_con">

        <div class="box">
    
<?php if(!empty($output['list'])){?>

<?php foreach ($output['list'] as $k => $v) {?>

    <div class="list_bzj">
         <div class="list_bzj2">
              <div class="list_bzj2_img">
                    <a href="<?php echo urlWap('lepai','auction',array('id'=>$v['G_Id']));?>">
                      <img src="<?php echo str_replace('/data/','http://images.96567.com/',$v['G_MainImg']);?>">
                    </a>
              </div>
              <div class="list_bzj22">
                    <div class="list_bzj_bt">
                        <a href="t_bzj2_img">
                    <a href="<?php echo urlWap('lepai','auction',array('id'=>$v['G_Id']));?>"><?php echo $v['G_Name'];?></a>
                    </div>

                <?php if($v['type'] == '1'){?>
                  <div class="lin_hg">类型：现实
                       <span class="fr"><?php echo $v['amount'].'.00元';?></span>
                  </div>
                <?php }elseif($v['type'] == '2'){?>
                    <div class="lin_hg">类型：收藏币
                       <span class="fr"><?php echo $v['amount'];?></span>
                    </div>
                <?php }else{?>
                    <div class="lin_hg">类型：免保证金
                    </div>
                <?php }?>

                  <div class="lin_hg">缴纳时间：</div>
        
                  <div class="lin_hg">
                    <p><?php echo date('Y-m-d',$v['bind_time']);?></p>
                  </div>
        
                  <div class="lin_hg">
                    <span class="c9"><a>未返还</a></span>
                  </div>
              </div>
         </div>
    </div>
            
<?php }?>

<?php }?>


    </div>

    <?php echo $output['show_page'];?>

</section>

