<? if(!defined('IN_ASK2')) exit('Access Denied'); include template(header,admin); ?>
<div id="append">
</div>
<div class="page">
    <div class="fixed-bar">
        <div class="item-title">
            <h3>更新缓存</h3>
        </div>
    </div>
    <div class="fixed-empty"></div><? if(isset($message)) { $type=isset($type)?$type:'correctmsg';  ?><div class="alert alert-info-inverse with-icon">
<i class="icon-info-sign"></i>
<div class="content"> <?=$message?></div>
</div><? } ?><table class="table tb-type2" id="prompt">
    <tbody>
    <tr class="space odd" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%;">
        <th class="nobg" colspan="12"><div class="title"><h5>设置说明</h5><span class="arrow"></span></div></th>
    </tr>
    <tr class="odd" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; display: table-row;">
        <td>
            <ul>
                <li>当后台的设置发生改变后，需要及时更新下缓存，才能立即生效</li>
            </ul>
        </td>
    </tr>
    </tbody>
</table>
<form action="index.php?admin_setting/cache<?=$setting['seo_suffix']?>" method="post">
 <table class="table tb-type2">
<tr>
<td class="altbg2" width="10"><input class="checkbox" type="checkbox"  checked value="data" name="type[]"></td><td class="altbg2" >更新数据缓存</td>
</tr>
<tr>
<td class="altbg2" width="10"><input class="checkbox" type="checkbox"  checked  value="tpl" name="type[]"></td><td class="altbg2">更新模板缓存</td>
</tr>
<tr>
<td colspan="2" class="altbg1"><input class="btn btn-info" type="submit" name="submit" value="提 交"></td>
</tr>
</table>
</form>
</div>
<? include template(footer,admin); ?>
