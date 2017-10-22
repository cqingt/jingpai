<?php
/**
 * 艺术家首页管理
 ***/

defined('InShopNC') or exit('Access Invalid!');
class artist_webControl extends SystemControl{
    public function __construct() {
        parent::__construct ();
        Language::read('web_config,recommend');
    }

    /**
     * 艺术家首页管理
     */
    public function artist_webOp() {
        $model_web_config = Model('web_config');
		$style_array = $model_web_config->getStyleList();//板块样式数组
		Tpl::output('style_array',$style_array);
		$web_list = $model_web_config->getWebList(array('web_page' => 'artist_index'));
		Tpl::output('web_list',$web_list);
		Tpl::showpage('artist_web.index');
    }
	/**
	 * 基本设置
	 */
	public function web_editOp(){
		$model_web_config = Model('web_config');
		$web_id = intval($_GET["web_id"]);
		if (chksubmit()){
			$web_array = array();
			$web_id = intval($_POST["web_id"]);
			$web_array['web_name'] = $_POST["web_name"];
			$web_array['style_name'] = $_POST["style_name"];
			$web_array['web_sort'] = intval($_POST["web_sort"]);
			$web_array['web_show'] = intval($_POST["web_show"]);
			$web_array['update_time'] = time();
			$model_web_config->updateWeb(array('web_id'=>$web_id),$web_array);
			$model_web_config->updateWebHtml($web_id,$web_array['style_name']);//更新前台显示的html内容
			$this->log(l('web_config_code_edit').'['.$_POST["web_name"].']',1);
			showMessage(Language::get('nc_common_save_succ'),'index.php?act=artist_web&op=artist_web');
		}
		$web_list = $model_web_config->getWebList(array('web_id'=>$web_id));
		Tpl::output('web_array',$web_list[0]);
		Tpl::showpage('artist_web.edit');
	}
	/**
	 * 板块编辑
	 */
	public function code_editOp(){
		$model_web_config = Model('web_config');
		$web_id = intval($_GET["web_id"]);
		$code_list = $model_web_config->getCodeList(array('web_id'=>"$web_id"));
		if(is_array($code_list) && !empty($code_list)) {
			$model_class = Model('goods_class');
			$cidary = $model_class->getChildClass(79);
			$prid = array();
			if($cidary){
				foreach($cidary as $cik=>$civ){
					$prid[] = $civ['gc_id'];
				}
			}
			
			$parent_goods_class = $model_class->getTreeClassList(3,array('gc_id'=>array('in',$prid)));//商品分类父类列表，只取到第二级
			if (is_array($parent_goods_class) && !empty($parent_goods_class)){
				foreach ($parent_goods_class as $k => $v){
					$parent_goods_class[$k]['gc_name'] = str_repeat("&nbsp;",$v['deep']*2).$v['gc_name'];
				}
			}
			Tpl::output('parent_goods_class',$parent_goods_class);

			$goods_class = $model_class->getTreeClassList(1,array('gc_id'=>79));//第一级商品分类
			Tpl::output('goods_class',$goods_class);

			foreach ($code_list as $key => $val) {//将变量输出到页面
				$var_name = $val["var_name"];
				$code_info = $val["code_info"];
				$code_type = $val["code_type"];
				$val['code_info'] = $model_web_config->get_array($code_info,$code_type);
				Tpl::output('code_'.$var_name,$val);
			}
			$style_array = $model_web_config->getStyleList();//样式数组
			Tpl::output('style_array',$style_array);
			$web_list = $model_web_config->getWebList(array('web_id'=>$web_id));
			Tpl::output('web_array',$web_list[0]);
			Tpl::showpage('artist_code.edit');
		} else {
			showMessage(Language::get('nc_no_record'));
		}
	}
   /**
	 * 更新前台显示的html内容
	 */
	public function web_htmlOp(){
		$model_web_config = Model('web_config');
		$web_id = intval($_GET["web_id"]);
		$web_list = $model_web_config->getWebList(array('web_id'=>$web_id));
		$web_array = $web_list[0];
		if(!empty($web_array) && is_array($web_array)) {
			$model_web_config->updateWebHtml($web_id,$web_array['style_name']);
			showMessage(Language::get('nc_common_op_succ'),'index.php?act=artist_web&op=artist_web');
		} else {
			showMessage(Language::get('nc_common_op_fail'));
		}
	}


	/**
	 * 编辑促销区域
	 */
	public function sale_editOp() {
	    $model_web_config = Model('web_config');
	    $web_id = '216';
	    $code_list = $model_web_config->getCodeList(array('web_id'=> $web_id));
	    if(is_array($code_list) && !empty($code_list)) {
	        $model_class = Model('goods_class');
			$goods_class = $model_class->getTreeClassList(1,array('gc_id'=>79));//第一级商品分类 只获取书画分类
			Tpl::output('goods_class',$goods_class);
			foreach ($code_list as $key => $val) {//将变量输出到页面
				$var_name = $val['var_name'];
				$code_info = $val['code_info'];
				$code_type = $val['code_type'];
				$val['code_info'] = $model_web_config->get_array($code_info,$code_type);
				Tpl::output('code_'.$var_name,$val);
			}
		}
		Tpl::showpage('artist_sale.edit');
	}
	
	/**
	 * 艺术家推荐信息
	 */
	public function tuijian_editOp() {
		$model_web_config = Model('web_config');
		$web_id = intval($_GET["web_id"]);
		$web_id = 217;
		$code_list = $model_web_config->getCodeList(array('web_id'=> $web_id));
		if(is_array($code_list) && !empty($code_list)) {
			foreach ($code_list as $key => $val) {//将变量输出到页面
				$var_name = $val["var_name"];
				$code_info = $val["code_info"];
				$code_type = $val["code_type"];
				$val['code_info'] = $model_web_config->get_array($code_info,$code_type);
				Tpl::output('code_'.$var_name,$val);
			}
			$style_array = $model_web_config->getStyleList();//样式数组
			Tpl::output('style_array',$style_array);
			$web_list = $model_web_config->getWebList(array('web_id'=>$web_id));
			Tpl::output('web_array',$web_list[0]);
			Tpl::showpage('artist_tuijian.edit');
		} else {
			showMessage(Language::get('nc_no_record'));
		}
	}
	 
}
