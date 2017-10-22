
        <!-- wrapper start-->
        <div class="wrapper">
        <form action="">

             <div class="guide box">
                  <span>
                      <a href="index.php?act=adminIndex&op=index">首页</a>
                  </span>
                  <a href="index.php?act=adminIndex&op=index">
                     <code>></code><i>账户管理</i>
                  </a>
             </div>

             <div class="content boxes mtop25">
                  <div class="title">账户档案</div>
                  <div class="con-form">
                             <div class="form-left">
                                   <div class="formbox back-eee">
                                        <p>用 户 名：</p><em><?php echo $output['result']['member_name']?></em>
                                        <!-- <a href="JavaScript:;" class="password big-link" data-reveal-id="myModal" data-animation="fade">密码修改</a> -->
                                   </div>
                                   <div class="formbox">
                                        <p>机构名称：</p>
                                        <em><?php echo $output['result']['company_name']?></em>
                                   </div>
                                   <div class="formbox back-eee">
                                        <p>联 系 人：</p>
                                        <input id="contacts_name" name="contacts_name" type="text" value="<?php echo $output['result']['contacts_name']?>" >
                                        <a class="save" href="javascript:ajaxUp('contacts_name');">保存</a>
                                   </div>
                                   <div class="formbox back-eee">
                                        <p>Email：</p>
                                        <input id="contacts_email" name="contacts_email" type="text" value="<?php echo $output['result']['contacts_email']?>" >
                                        <a class="save" href="javascript:ajaxUp('contacts_email');">保存</a>
                                   </div>
                             </div>

                             <div class="form-right">
                                 <div class="formbox">
                                     <p>用户类型：</p>
                                     <em>入驻机构</em>
                                 </div>
                                 <div class="formbox">
                                     <p>主营类目：</p>
                                     <em><?php echo $output['result']['sc_name']?></em>
                                 </div>
                                 <div class="formbox back-eee">
                                     <p>联系电话：</p>
                                     <input id="contacts_phone" name="" type="text" value="<?php echo $output['result']['contacts_phone']?>" >
                                     <a class="save" href="javascript:ajaxUp('contacts_phone');">保存</a>
                                 </div>
                                 <div class="formbox back-eee">
                                     <p>机构地址：</p>
                                     <input id="company_address" name="" type="text" value="<?php echo $output['result']['company_address']?>" >
                                     <a class="save" href="javascript:ajaxUp('company_address');">保存</a>
                                 </div>
                             </div>
                  </div>
             </div>

             <!-- reveal-modal Start -->
             <div id="myModal" class="reveal-modal modal-box52">
                    <h1>密码修改</h1>
                    <div class="reveal-box">
                         <div class="item">
                               <label>原密码：</label>
                               <input id="password" name="password" type="password" class="basic-input" tabindex="2" maxlength="20">
                         </div>
                         <div class="item">
                               <label>新密码：</label>
                               <input id="password" name="password" type="password" class="basic-input" tabindex="2" maxlength="20">
                         </div>
                         <div class="item">
                               <label>新密码确认：</label>
                               <input id="password" name="password" type="password" class="basic-input" tabindex="2" maxlength="20">
                         </div>
                         <div class="item-button">
                              <input type="button" name="login" value="确认修改" class="btn-ok">
                              <input type="button" name="login" value="取消" class="btn-cancel">
                         </div>
                    </div>
                    <a class="close-reveal-modal">&#215;</a>
             </div>
             <!-- reveal-modal End -->

             <div class="content boxes mtop25">
                  <div class="title">送拍概况</div>
                  <div class="con-list mright10">
                       <ul>
                          <li><p>累计成交额：</p><strong><?php if(!$output['userInfo']['Money_Sum']['Money_Sum']){echo '0';}else{echo $output['userInfo']['Money_Sum']['Money_Sum'];}?></strong></li>
                          <li><p>累积专场数：</p><strong><?php echo $output['userInfo']['Theme_Sum']['Theme_Sum'];?></strong></li>
                          <li><p>累计送拍数：</p><strong><?php echo $output['userInfo']['Goods_Sum']['Goods_Sum'];?></strong></li>
                          <li><p>累计成交数：</p><strong><?php echo $output['userInfo']['Goods_Sum_C']['Goods_Sum_C'];?></strong></li>
                       </ul>
                </div>
             </div>

             <div class="content boxes mtop25">
                  <div class="title">订单通知</div>
                  <div class="con-list">
                       <ul>
                          <li class="text-underline"><p>待处理订单：</p><a href="index.php?act=adminOrder&op=index"><?php echo $output['userInfo']['Order_Sum']['Order_Sum'];?></a></li>
                       </ul>
                  </div>
             </div>

        </form>
        </div>
        <!-- wrapper end-->

        
<script>
function ajaxUp(name){
  var v = $("#"+name).val();
  $.ajax({
    type: "GET",
    cache: false,
    async: false,
    url : "index.php?act=adminIndex&op=ajaxUp",
    data: name + '=' + v,
    success : function(html){
      window.location.href="index.php?act=adminIndex&op=index";
    }
  });
}
</script>