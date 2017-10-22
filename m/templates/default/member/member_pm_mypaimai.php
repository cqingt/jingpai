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

    <li><a href="<?php echo urlWap('member_pm','my_paimai',array('type'=>0));?>">所有状态</a></li>

    <li><a href="<?php echo urlWap('member_pm','my_paimai',array('type'=>1));?>">即将开始</a></li>

    <li><a href="<?php echo urlWap('member_pm','my_paimai',array('type'=>2));?>">正在进行</a></li>

    <li><a href="<?php echo urlWap('member_pm','my_paimai',array('type'=>3));?>">已结束的</a></li>
   
  </ul>

  <div class="investment_con">

    <div class="box">
            

<?php if(!empty($output['list'])){?>

<?php foreach ($output['list'] as $k => $v) {?>


          <div class="list_bzj">
               <div class="list_bzj2">
                    <div class="list_bzj2_img">
                  <a href="<?php echo urlWap('lepai','theme',array('tid'=>$v['T_Id']));?>">
                    <img src="<?php echo str_replace('/data/','http://images.96567.com/',$v['G_MainImg']);?>">
                  </a>
                    </div>
                    <div class="list_bzj22">
                    <div class="list_bzj_bt">
                    <a href="<?php echo urlWap('lepai','theme',array('tid'=>$v['T_Id']));?>"><?php echo $v['G_Name'];?></a>
                  </div>
                      <div class="lin_hg"><i class="icon-zc">专场</i><?php echo $v['T_Title'];?></div>
                      <div class="lin_hg">


<?php if($v['T_Ktime'] > time()){?>
  <span class="c8"><a>即将开始</a></span>
<?php }elseif($v['T_Ktime'] < time() AND $v['G_EndTime'] > time()){?>
  <span class="a3"><a>进行中</a></span>
<?php }elseif($v['G_EndTime'] < time()){?>
  <span class="l1"><a>已结束</a></span>
<?php }?>
                          


                      </div>
                    </div>
               </div>
          </div>
        
<?php }?>

<?php }?>

    
          
            
    </div>


  </div>

  <?php echo $output['show_page'];?>


</section>