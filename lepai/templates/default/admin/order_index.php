 <!-- wrapper start-->
        <div class="wrapper">

             <div class="guide box">
                  <span>
                      <a href="index.php?act=adminIndex&op=index">首页</a>
                  </span>
                  <a href="">
                     <code>></code><i>订单管理</i>
                  </a>
             </div>

             <div class="content boxes mtop25">
                  <div class="title">订单管理</div>
                  <div class="me-list">

<input type="hidden" name="select_one_goods" id="select_one_goods">
<input type="hidden" name="select_two_goods" id="select_two_goods">


        <input class="me-name pleft10" type="text" id="search" name="search" value="" placeholder='订单编号、拍品名称'>

                       <div class='diy_select me-dro'>
                           <div class="select-text">
                              <input type='hidden' name='' id="b" class='diy_select_input' />
                              <div class='diy_select_txt'>--请选择--</div>
                              <div class='diy_select_btn'></div>
                           </div>
                           <ul class='diy_select_list'>
                              <li onmousemove="select_goods('select_one_goods',1)">订单编号</li>
                              <li onmousemove="select_goods('select_one_goods',2)">拍品名称</li>
                           </ul>
                      </div> 
                      <div class='diy_select me-dro'>
                           <div class="select-text">
                              <input type='hidden' name='' id="b" class='diy_select_input' />
                              <div class='diy_select_txt'>--请选择--</div>
                              <div class='diy_select_btn'></div>
                           </div>
                           <ul class='diy_select_list'>

                              <?php foreach(C('lepai_order_type') as $k=>$v){?>
                            
                              <li onmousemove="select_goods('select_two_goods',<?php echo $k;?>)"><?php echo $v;?></li>

                              <?php }?>
                           </ul>
                      </div>
                       <input class="but-query" type="button" onclick="pushSearch();" name="" value="查询">
                  </div>
                  <div class="info order-box">
                       <h1>订单编号</h1>
                       <ul style="margin-left: 80px;">
                         <li class="li-info" style="width:300px;">商品信息</li>
                         <li class="li-info">成交时间</li>
                         <li class="li-info">订单金额</li>
                         <li class="li-info">买家</li>
                         <li class="li-info">状态</li>
                         <li class="li-info">操作</li>
                       </ul>
                  </div>
                  <ul class="info-list order-list">

<?php foreach($output['result'] as $k => $v){?>

                       <li>
                          <div class="order-number"><?php echo $v['order_sn'];?></div>
                          <div class="info-imag small-imag90" ><a href=""><img src="<?php echo LEPAI_Images_URL.$v['G_MainImg'];?>" alt=""></a></div>
                          <div class="info-boxes" style="margin-left: 20px;">
                               <dl class="info-dl1 text-dl number-dd">
                                 <dt>
                                  <a href="">
                                    <?php echo $v['G_Name'];?>
                                  </a> 
                                 </dt>
                                 <dd class="tow-line"><?php echo date('Y-m-d',$v['add_time']);?></dd>
                                 <dd>￥<?php echo $v['order_amount'];?></dd>
                                 <dd class="tow-line-text"><?php echo $v['buyer_name'];?></dd>
                                 <dd>
  <?php if($v['order_state'] == '0'){?>已取消<?php }?>
  <?php if($v['order_state'] == '10'){?>未付款<?php }?>
  <?php if($v['order_state'] == '20'){?>已付款<?php }?>
  <?php if($v['order_state'] == '30'){?>已发货<?php }?>
  <?php if($v['order_state'] == '40'){?>已收货<?php }?>

                                </dd>
                               </dl>
                               <div class="info-dl1 function mtop13 pleft40"> 
                                 <?php if($v['order_state'] == '20'){?>
                                    <a class="give" href="JavaScript:;" onclick="addVal(<?php echo $v['order_id'];?>)" data-reveal-id="myModal3" data-animation="fade">去发货</a>
                                    <?php }?>
                                    <a class="particulars"  href="index.php?act=adminOrder&op=order_info&orderid=<?php echo $v['order_id']?>">详情</a>
                               </div>
                               <!-- <dl class="number-dls">
                                 <dt>数量：</dt>
                                 <dd>69</dd>
                               </dl> -->
                          </div>
                       </li>

<?php }?>

                  </ul>
                  <div class="page_common mbottom68 mright26">
                    <?php echo $output['page'];?>
                  </div>
             </div>

             <!-- reveal-modal3 Start -->
             <form action="index.php?act=adminOrder&op=orderPush" method="POST">
             <div id="myModal3" class="reveal-modal modal-box42">
              <input type="hidden" name="order_id" id="order_id">
                    <h1>发货</h1>
                    <div class="reveal-box2 expressage">
                         <div class="item exp-select">
                               <label>快递公司：</label>
                                   <select required="required" name="kuaidi" id="" style="width:145px;height:33px;">
                                     <option value="">请选择</option>
                                     <?php foreach($output['express'] as $k => $v){?>
                                      <option value="<?php echo $v['id'];?>"><?php echo $v['e_name'];?></option> 
                                    <?php }?>
                                   </select>
                         </div>
                         <div class="item">
                               <label>快递单号：</label>
                               <input required="required" id="text" name="order_sn" type="text" value="" placeholder="请输入快递单号" class="basic-input" tabindex="2" maxlength="20">
                         </div>
                         <div class="item-button">
                              <input type="submit" name="login" value="确认发货" class="btn-ok">
                              <input type="button" name="login" value="取消" class="btn-cancel">
                         </div>
                    </div>
                    <a class="close-reveal-modal">&#215;</a>
             </div>
             </form>
             <!-- reveal-modal End -->

        </div>
        <!-- wrapper end -->


        <script>
  function select_goods(id,v){
    $("#"+id).val(v);
  }


  function pushSearch(){
    var s = $("#search").val();
    var t = $("#select_one_goods").val();
    var y = $("#select_two_goods").val();
    window.location.href="index.php?act=adminOrder&op=index&search=" + s + "&s_one=" + t + "&s_two=" + y;
  }

  function addVal(id){
    $("#order_id").val(id);
  }


        </script>