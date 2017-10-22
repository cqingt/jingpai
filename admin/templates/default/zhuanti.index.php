<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>专题管理</h3>
      <ul class="tab-base">
        <li><a href="<?php echo urlAdmin('zhuantiad', 'index');?>" class="current"><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="<?php echo urlAdmin('zhuantiad', 'add');?>" ><span>添加</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" name="formSearch">
    <input type="hidden" value="zhuantiad" name="act">
    <input type="hidden" value="index" name="op">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="search_title">标题</label></th>
          <td><input type="text" value="<?php echo $_GET['Z_Title'];?>" name="Z_Title" id="Z_Title" class="txt"></td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search " title="<?php echo $lang['nc_query'];?>">&nbsp;</a>
        </tr>
      </tbody>
    </table>
  </form>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title">
            <h5><?php echo $lang['nc_prompts'];?></h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
		  <ul>
            <li>这里是功能介绍</li>
          </ul>
		  </td>
      </tr>
    </tbody>
  </table>
  <form method="post" id="form_article">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th>标题</th>
          <th>目录</th>
          <th class="align-center">开始时间</th>
          <th class="align-center">结束时间</th>
          <th class="align-center">连接</th>
          <th class="w96 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['zt_list'])){ ?>
        <?php foreach($output['zt_list'] as $k => $v){ ?>
        <tr class="hover">
          <td class="align-center"><?php echo $v['zhuanti_title']; ?></td>
          <td class="align-center"><?php echo $v['zhuanti_mulu']; ?></td>
          <td class="align-center">
            <?php echo date('Y-m-d', $v['start_date']); ?>
          </td>
		  <td class="align-center">
            <?php echo date('Y-m-d', $v['end_date']); ?>
          </td>
          <td class="align-center"><?php echo $v['zhuanti_link']; ?></td>

          <td class="align-center">
		  <a href="<?php echo $v['zhuanti_link']; ?>" target="_blank">查看</a> | 
		  <a href="<?php echo urlAdmin('zhuantiad', 'add', array('d_id' => $v['id']));?>">编辑</a> | 
		  <a href="javascript:void(0)" onclick="if(confirm('您确定要删除吗?')){location.href='<?php echo urlAdmin('zhuantiad', 'del', array('d_id' => $v['id']));?>';}">删除</a>
		  </td>

        </tr>
        <?php } ?>
        <?php } else { ?>
        <tr class="no_data">
          <td colspan="10"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <?php if(!empty($output['zt_list'])){ ?>
        <tr class="tfoot">
          <td colspan="16">
            <div class="pagination"> <?php echo $output['show_page'];?> </div></td>
        </tr>
        <?php } ?>
      </tfoot>
    </table>
  </form>
</div>
