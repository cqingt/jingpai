<!-- wrapper start-->
        <div class="wrapper">

             <div class="guide box">
                  <span>
                      <a href="index.php?act=adminIndex&op=index">首页</a>
                  </span>
                  <a href="index.php?act=adminOrder&op=index">
                     <code>></code><i>订单管理</i>
                  </a>
                  <a href="">
                     <code>></code><i>订单详情</i>
                  </a>
             </div>

             <div class="content boxes mtop25">
                  <div class="title">订单管理</div>
                  <div class="order-status">订单状态：
  <?php if($output['result']['order_state'] == '0'){?>已取消<?php }?>
  <?php if($output['result']['order_state'] == '10'){?>未付款<?php }?>
  <?php if($output['result']['order_state'] == '20'){?>已付款<a class="go-btn mleft26" href="JavaScript:;" data-reveal-id="myModal3" data-animation="fade">去发货</a><?php }?>
  <?php if($output['result']['order_state'] == '30'){?>已发货<?php }?>
  <?php if($output['result']['order_state'] == '40'){?>已收货<?php }?>

                    

                    <?php if($output['result']['order_state'] != '30' || $output['result']['order_state'] != '40'){?>
                    
                    <?php }?>
                  </div>
                  <div class="information">
                       <h4>订单信息</h4>
                       <p>订单编号：<?php echo $output['result']['order_sn'];?></p>
                       <p>买家名称：<?php echo $output['result']['buyer_name'];?></p>
                       <p>成交时间：<?php echo date('Y-m-d',$output['result']['add_time']);?></p>
                       <?php if($output['result']['finnshed_time']){?>
                       <p>完成时间：<?php echo date('Y-m-d',$output['result']['finnshed_time']);?></p>
                       <?php }?>
                       <p>订单金额：￥<?php echo $output['result']['order_amount'];?></p>
                       <span>
                          <p>拍品信息：</p>
                          <a href=""><img src="<?php echo LEPAI_Images_URL.$output['result']['G_MainImg'];?>" alt=""></a>
                          <div class="inf-text">
                              <p><?php echo $output['result']['G_Name'];?>
                              </p>
                              
                          </div>

                       </span>
                  </div>

                  <div class="information mbottom30">
                        <h4>物流信息</h4>
                        <p>收货人：<?php echo $output['area_info']['true_name'];?></p>
                        <p>联系电话：<?php echo JieMiMobile($output['area_info']['mob_phone']);?></p>
                        <p>收货地址：<?php echo $output['area_info']['area_info'].' '.$output['area_info']['address'];?></p>
                        <p>快递公司：<?php echo $output['kuaidi']['e_name'];?></p>
                        <p>快递单号：<?php echo $output['result']['shipping_code'];?></p>
                  </div>
             </div>

             <form action="index.php?act=adminOrder&op=orderPush" method="POST">

             <!-- reveal-modal3 Start -->
             <div id="myModal3" class="reveal-modal modal-box42">
              <input type="hidden" name="order_id" id="order_id" value="<?php echo $output['result']['order_id'];?>">
                    <h1>发货</h1>
                    <div class="reveal-box2 expressage">
                         <div class="item exp-select">
                               <label>快递公司：</label>
                               <div id="dropdown" class="dropdown"> 
                                  <select required="required" name="kuaidi" id="" style="width:145px;height:33px;">
                                     <option value="">请选择</option>
                                     <?php foreach($output['express'] as $k => $v){?>
                                      <option value="<?php echo $v['id'];?>"><?php echo $v['e_name'];?></option> 
                                    <?php }?>
                                   </select>
                               </div> 
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
        <!-- wrapper end-->