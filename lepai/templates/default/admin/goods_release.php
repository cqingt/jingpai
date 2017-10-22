<!-- wrapper start-->
<div class="wrapper">

     <div class="guide box">
          <span>
              <a href="index.php?act=adminIndex&op=index">首页</a>
          </span>
          <a href="index.php?act=adminGoods&op=index">
             <code>></code><i>拍品管理</i>
          </a>
          <a href="">
             <code>></code><i>拍品发布</i>
          </a>
     </div>

     <div class="content boxes mtop25">
          <div class="title">拍品发布</div>
          <div class="article">
               <form action="index.php?act=adminGoods&op=goods_add" method="POST">
               <div class="issue has-name">
                    <label>拍品名称</label>
                    <input required="required" name="G_Name" type="text" class="overflow issue-input" value="" placeholder="请输入拍品名称">
               </div>

               <div class="issue has-classify">
                     <label>拍品分类</label>
                      <div class='diy_select me-dro'>
                           <div class="select-text">
                              <input type='hidden' name='' id="b" class='diy_select_input' />
                              <div class='diy_select_txt'>--请选择--</div>
                              <div class='diy_select_btn'></div>
                           </div>
                           <ul class='diy_select_list'>
                              <?php foreach($output['lepai_class'] as $k=>$v){?>
                                    
                                <li id="select_goods<?php echo $v['C_Id'];?>" onmousemove="select_goods(<?php echo $v['C_Id'];?>)"><?php echo $v['C_Name'];?></li>

                              <?php }?>
                           </ul>
                      </div>
               </div>

               <input type="hidden" id="G_Class" name="G_Class" value="">
<!--

               <div class="issue has-attribute">
                     <label>拍品属性</label>

                      1邮币卡 
                     <div id="tab-attr1" class="attribute tab-attr1 tab-boxs">
                          <span>
                             <p class="att-p1">
                              尺寸：长<input type="text" name="I_Chang_y" value="">
                              X宽<input type="text" name="I_Kuan_y" value="">
                              X厚<input type="text" name="I_Hou_y" value="">
                              （单位：毫米）
                              <strong>小于1毫米请填0 </strong>
                             </p>
                             <p class="att-p2">
                               重量：<input type="text" name="I_Zhong_y" value="">（单位：克）
                             </p>
                          </span>
                     </div>

                      2贵金属 
                     <div id="tab-attr2" class="attribute tab-attr2 tab-boxs">
                          <span>
                             <p class="att-p1">
                              尺寸：长<input type="text" name="I_Chang_j" value="">
                              X宽<input type="text" name="I_Kuan_j" value="">
                              X厚<input type="text" name="I_Hou_j" value="">
                              （单位：毫米）
                              <strong>小于1毫米请填0 </strong>
                             </p>
                             <p class="att-p2">
                               重量：<input type="text" name="I_Zhong_j" value="">（单位：克）
                             </p>
                          </span>
                     </div>

                      3书法字画 
                     <div id="tab-attr3" class="attribute tab-attr3 tab-boxs">
                          <span>
                             <p class="att-p0">
                              作者：<input type="text" name="I_Name_s" value="">
                             </p>
                             <p class="att-p3">
                             <label>作者职称：</label>
                                <div class='diy_select me-dro'>
                                     <div class="select-text">
                                        <input type="hidden" name="ZhiCheng" id="ZhiCheng">
                                        <input type='hidden' name='I_ZhiCheng' id="I_ZhiCheng" class='diy_select_input' />
                                        <div class='diy_select_txt'>--请选择--</div>
                                        <div class='diy_select_btn'></div>
                                     </div>
                                     <ul class='diy_select_list'>
                                      <?php foreach($output['goodsInfo']['sh_zhiwei'] as $k=>$v){?>
                                        <li onmousemove="select_goods_info('ZhiCheng',<?php echo $v['attr_value_id'];?>)"><?php echo $v['attr_value_name'];?></li>
                                      <?php }?>
                                     </ul>
                                </div>
                             </p>
                             <p class="att-p1">
                              尺寸：长<input type="text" name="I_Chang_s" value="">
                              X宽<input type="text" name="I_Kuan_s" value="">
                              X厚<input type="text" name="I_Hou_s" value="">
                              （单位：毫米）
                              <strong>小于1毫米请填0 </strong>
                             </p>
                             <p class="att-p2">
                               重量：<input type="text" name="I_Zhong_s" value="">（单位：克）
                             </p>
                             <p class="att-p3">
                             <label>形制：</label>
                              <div class='diy_select me-dro'>
                                   <div class="select-text">
                                      <input type="hidden" name="XingZhi" id="XingZhi">
                                      <input type='hidden' name='I_XingZhi' id="I_XingZhi" class='diy_select_input' />
                                      <div class='diy_select_txt'>--请选择--</div>
                                      <div class='diy_select_btn'></div>
                                   </div>
                                   <ul class='diy_select_list'>
                                      <?php foreach($output['goodsInfo']['sh_xingzhi'] as $k=>$v){?>
                                        <li onmousemove="select_goods_info('XingZhi',<?php echo $v['attr_value_id'];?>)"><?php echo $v['attr_value_name'];?></li>
                                      <?php }?>
                                   </ul>
                              </div>
                             </p>
                          </span>
                     </div>

                      4玉器珠宝 
                     <div id="tab-attr4" class="attribute tab-attr4 tab-boxs" style='display: block;'>
                          <span>
                             <p class="att-p3">
                             <label>材质：</label>
                              <div class='diy_select me-dro'>
                                   <div class="select-text">
                                      <input type="hidden" name="Z_XingZhi" id="Z_XingZhi">
                                      <input type='hidden' name='I_XingZhi' id="d" class='diy_select_input' />
                                      <div class='diy_select_txt'>--请选择--</div>
                                      <div class='diy_select_btn'></div>
                                   </div>
                                   <ul class='diy_select_list'>
                                      <?php foreach($output['goodsInfo']['zb_caizhi'] as $k=>$v){?>
                                        <li onmousemove="select_goods_info('Z_XingZhi',<?php echo $v['attr_value_id'];?>)"><?php echo $v['attr_value_name'];?></li>
                                      <?php }?>
                                   </ul>
                              </div>
                             </p>
                          </span>
                     </div>               

                      5瓷器紫砂  
                     <div id="tab-attr5" class="attribute tab-attr5 tab-boxs" >
                          <span>
                             <p class="att-p0">
                              作者：<input type="text" name="I_Name_z" value="">
                             </p>
                             <p class="att-p3">
                             <label>容量：</label>
                                <div class='diy_select me-dro'>
                                     <div class="select-text">
                                      <input type="hidden" name="C_XingZhi" id="C_XingZhi">
                                        <input type='hidden' name='I_XingZhi' id="e" class='diy_select_input' />
                                        <div class='diy_select_txt'>--请选择--</div>
                                        <div class='diy_select_btn'></div>
                                     </div>
                                     <ul class='diy_select_list'>
                                        <?php foreach($output['goodsInfo']['cq_rongliang'] as $k=>$v){?>
                                        <li onmousemove="select_goods_info('C_XingZhi',<?php echo $v['attr_value_id'];?>)"><?php echo $v['attr_value_name'];?></li>
                                      <?php }?>
                                     </ul>
                                </div>
                             </p>
                          </span>
                     </div>  

                       6红木文玩杂项  
                     <div id="tab-attr6" class="attribute tab-attr6 tab-boxs">
                          <span>
                             <p class="att-p0">
                              作者：<input type="text" name="I_Name_h" value=""> <strong>无作者请填无</strong>
                             </p>
                             <p class="att-p2">
                               尺寸：<input type="text" name="I_Chang_h" value="">（单位：毫米）
                             </p>
                             <p class="att-p2">
                               重量：<input type="text" name="I_Zhong_h" value="">（单位：克）
                             </p>
                          </span>
                     </div>  
                     


               </div>
-->

               <div class="overflow issue has-cover">
                     <label>拍品封面</label>
                     <strong>
                    * 必填，拍品第一展示图，同时用于拍卖专题页展示，需尺寸800px*800px的实物图片
                     </strong>


                      <div class="cover-banner" id="divimg1" style="background-size:148px 125px;width:148px;background-image: url(<?php echo LEPAI_CSS_URL;?>/images/admin/img1.jpg)">
                        <input required="required" onchange="uploadImg('imgPhonto','divimg1','G_MainImg');" type="file" id="imgPhonto" name="imgPhonto"  style="width:148px;height:200px;opacity: 0;"  />
                        <input type="hidden" id="G_MainImg" name="G_MainImg" value="">
                      </div>

                     <a class="delete" href="javascript:delImg('divimg1','G_MainImg');">删除</a>
               </div>


               <div class="overflow issue has-coverimg">
                     <label>拍品图片</label>
                      <strong>
                        * 拍品展示图，至少2张，最多4张，需尺寸800px*800px的实物图片
                      </strong>
                     <ul class="img-btnimg">
                        <li>
                          <div class="cover-banner" id="divimg2" style="background-size:94px 94px;width:94px;background-image: url(<?php echo LEPAI_CSS_URL;?>/images/admin/img1.jpg)">
                            <input required="required" onchange="uploadImg('imgPhonto2','divimg2','G_MainImg2');" type="file" id="imgPhonto2" name="imgPhonto2"  style="width:94px;height:200px;opacity: 0;"  />
                            <input type="hidden" id="G_MainImg2" name="G_MainImg2" value="">
                          </div>                          
                          <a href="javascript:delImg('divimg2','G_MainImg2');">删除</a>
                        </li>
                        <li>
                          <div class="cover-banner" id="divimg3" style="background-size:94px 94px;width:94px;background-image: url(<?php echo LEPAI_CSS_URL;?>/images/admin/img1.jpg)">
                            <input required="required" onchange="uploadImg('imgPhonto3','divimg3','G_MainImg3');" type="file" id="imgPhonto3" name="imgPhonto3"  style="width:94px;height:200px;opacity: 0;"  />
                            <input type="hidden" id="G_MainImg3" name="G_MainImg3" value="">
                          </div>                           <a href="javascript:delImg('divimg3','G_MainImg3');">删除</a>
                        </li>
                        <li>
                          <div class="cover-banner" id="divimg4" style="background-size:94px 94px;width:94px;background-image: url(<?php echo LEPAI_CSS_URL;?>/images/admin/img1.jpg)">
                            <input onchange="uploadImg('imgPhonto4','divimg4','G_MainImg4');" type="file" id="imgPhonto4" name="imgPhonto4"  style="width:94px;height:200px;opacity: 0;"  />
                            <input type="hidden" id="G_MainImg4" name="G_MainImg4" value="">
                          </div>                           <a href="javascript:delImg('divimg4','G_MainImg4');">删除</a>
                        </li>
                        <li>
                          <div class="cover-banner" id="divimg5" style="background-size:94px 94px;width:94px;background-image: url(<?php echo LEPAI_CSS_URL;?>/images/admin/img1.jpg)">
                            <input onchange="uploadImg('imgPhonto5','divimg5','G_MainImg5');" type="file" id="imgPhonto5" name="imgPhonto5"  style="width:94px;height:200px;opacity: 0;"  />
                            <input type="hidden" id="G_MainImg5" name="G_MainImg5" value="">
                          </div>                           <a href="javascript:delImg('divimg5','G_MainImg5');">删除</a>
                        </li>
                     </ul>
               </div>
               <div class="overflow issue has-describe">
                     <label>拍品描述</label>
                     <!-- <textarea  required="required" name="G_Content" id="G_Content" cols="" rows="" placeholder="请输入拍品的描述"></textarea> -->
                     <?php showEditor('G_Content',$output['result']['G_Content'],'100%','480px','visibility:hidden;',"true");?></td>
                     <span class="describe-red">* 描述中的图片宽度不要超过900像素，请如实描述/展品拍品，如有瑕疵或破损请详细描述并展示</span>
               </div>
               <div class="overflow issue has-number">
                     <label>起 拍 价</label>
                     <input onkeyup="if(/\D/.test(this.value)){alert('只能输入数字');this.value='';}" required="required" id="G_Qipai" name="G_Qipai" type="textarea" class="overflow issue-input" value='0' placeholder="">
                     <span class="describe-red"></span>
               </div>
               <div class="overflow issue has-number">
                     <label>加价幅度</label>
                     <input onkeyup="if(/\D/.test(this.value)){alert('只能输入数字');this.value='';}" required="required" id="G_IncMoney" name="G_IncMoney" type="textarea" class="overflow issue-input" placeholder="">
                     <span class="describe-red"></span>
               </div>
               <div class="overflow issue has-number">
                     <label>保 证 金</label>
                     <input onkeyup="if(/\D/.test(this.value)){alert('只能输入数字');this.value='';}" required="required" id="G_BaoZhenMoney" name="G_BaoZhenMoney" type="textarea" class="overflow issue-input" placeholder="">
                     <span class="describe-red"></span>
               </div>
               <div class="overflow issue has-number">
                     <label>保 留 价</label>
                     <input onkeyup="if(/\D/.test(this.value)){alert('只能输入数字');this.value='';}" required="required" id="G_BaoliuMoney" name="G_BaoliuMoney" type="textarea" class="overflow issue-input" placeholder="">
                     <span class="describe-red">“0”或空表示无保留价（拍卖结束后，若当前领先出价低于保留价，则此拍品流拍）</span>
               </div>
               <div class="has-radio">
                     <label>延时周期</label>
                     <label><input id="G_Yanchi" name="G_Yanchi" type="radio" class="time-radio" value="5" checked="checked">5分钟/次</label>
                     <label><input id="G_Yanchi" name="G_Yanchi" type="radio" class="time-radio" value="0">不延时</label>
               </div>
               <div class="overflow issue-gobtn"><input type="submit" class="go-btn" value="确认发布"></div>
               
               </form>
          </div>
     </div>
</div>
<!-- wrapper end-->


<!-- 需先加载所有XHTML 执行 -->
<script src="<?php echo LEPAI_JS_URL;?>/js/lepai_admin/attribute.js"></script>

<script>
  function select_goods(id){
    $("#G_Class").val(id);
    for(var i=1;i<=7;i++){
      if(i==id){
        $("#tab-attr"+i).show();
      }else{
        $("#tab-attr"+i).hide();
      }
    }
  }

  function select_goods_info(id,vid){
    $("#"+id).val(vid);
  }

  function uploadImg(pid,id,vid){
    var data = new FormData();
    $.each($('#' + pid )[0].files, function(i, file){
      data.append('imgPhonto', file);
    })
    $.ajax({
        url:"index.php?act=adminTheme&op=ajaxUpload",
        type:"POST",
        data:data,
        dataType:'json',
        cache:false,
        contentType:false,
        processData:false,
        success:function(data){
          var u = "<?php echo LEPAI_Images_URL;?>";
          $("#" + id ).css("background-image","url(" + u + data +")");
          $("#" + vid ).val(data);
        }
    });

}

function delImg(id,vid){
  $("#"+vid).val();
  $("#"+id).css("background-image","url(<?php echo LEPAI_CSS_URL;?>/images/admin/img1.jpg)");
}

</script>