<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：manageAffiliate
 * 
 * @功能：推荐设置类
 *
 * @开发人：杜飞
 *
 * @文件名称：manageAffiliate.class.php
 * 
 * @开发时间：2014-9-26 16:28:17
 * 
 * @推荐设置类
 * 
 */
require_once(dirname(__FILE__)."/../../model/class/PageTurn.class.php");
require_once(dirname(__FILE__)."/manage.class.php");
require_once(dirname(__FILE__)."/../../plugins/tool.class.php");
class manageAffiliate extends manage{

	public function __construct(){
		parent::__construct();
		$this->c->table('affiliate');
	}

	/**
	 * @ 默认主控类方法
	 */
	public function index(){
		$url = "index.php?m=manageAffiliate&p=manage";
		$page = new PageTurn($this->c,G('page',2,2),'affiliate',$url,20,'id desc');
		$dataArr = $page->dataArr;
		if($dataArr){
			foreach($dataArr as $k=>$v){
				if($v['affiliate_range']){
					$affiliate_range = explode(',',$v['affiliate_range']);
					foreach($affiliate_range as $k1=>$v1){
						if($v1 == 1){
							$str .= '注册&nbsp;';
						}
						if($v1 == 2){
							$str .= '下单';
						}
						
					}
					$dataArr[$k]['affiliate_range'] = $str;
				}
			}
		}
		$this->tpl('dataArr',$dataArr);
		$this->tpl('pageStr',$page->pageStr(3));
		$this->filename = 'affiliate_list.html';
	}

	/**
	 * @ 添加或修改推荐信息
	 */
	public function popAffiliate(){
		$id = intval(G('id',2,2));
		$dataArr = $this->c->search("id = '$id'");
		if($dataArr[0]['affiliate_range']){
			$this->tpl('affiliate_range',explode(',',$dataArr[0]['affiliate_range']));
		}
		$this->tpl('config',$dataArr[0]);
		$this->tpl('id',$id);
		$this->filename = 'pop/popAffiliate.html';
	}

	/**
	 * @ 插入或修改配置
	 */
	public function up_end(){
		$id = intval($_POST['id']);
		$dataArr['name'] =$_POST['name'];       //COOKIE过期数字
		$dataArr['expire'] =$_POST['expire'];       //COOKIE过期数字
		$dataArr['expire_unit'] = $_POST['expire_unit'];   //单位：小时、天、周
		$dataArr['level_register_all'] =$_POST['level_register_all']; //推荐注册奖励积分
		$dataArr['order_all']    =$_POST['order_all']; //下单赠送积分数量
		$dataArr['level_register_up'] = $_POST['level_register_up'];   //推荐注册奖励积分上限
		$dataArr['affiliate_like'] =$_POST['affiliate_like'];    //链接地址
		$dataArr['affiliate_range'] = $_POST['affiliate_range'] != '' ? implode(',',$_POST['affiliate_range']) : '';    //范围
		$dataArr['is_k'] =$_POST['is_k'];    //是否开启
		if($id > 0){
			 $this->c->update($dataArr,"id='".$id."'");//更新信息
			 show('更新信息成功!');
		 }else{
			 $this->c->insert($dataArr);
			 show('添加信息成功!');
		 }

		 
	}

	/**
	 * @ 删除信息
	 */
	public function delCategory(){
		$id = intval(G('id',2,2));
		if($id <= 0 ){show('参数错误!');exit;}
		$this->c->del('id',$id);
		show('删除成功!');
	}

	/**
	 * @ 定义系统析构方法
	 */
	public function __destruct(){
		$this->toString();
	}
}
?>