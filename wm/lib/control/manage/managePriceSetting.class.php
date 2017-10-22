<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：managePriceSetting
 * 
 * @功能：推荐设置类
 *
 * @开发人：杜飞
 *
 * @文件名称：managePriceSetting.class.php
 * 
 * @开发时间：2014-10-8 16:28:17
 * 
 * @价格区间设置类
 * 
 */
require_once(dirname(__FILE__)."/../../model/class/PageTurn.class.php");
require_once(dirname(__FILE__)."/manage.class.php");
require_once(dirname(__FILE__)."/../../plugins/tool.class.php");
class managePriceSetting extends manage{

	public function __construct(){
		parent::__construct();
		$this->c->table('pricesetting');
	}

	/**
	 * @ 默认主控类方法
	 */
	public function index(){
		$url = "index.php?m=managePriceSetting&p=manage";
		$page = new PageTurn($this->c,G('page',2,2),'pricesetting',$url,20,'id desc');
		$dataArr = $page->dataArr;
		$this->tpl('dataArr',$dataArr);
		$this->tpl('pageStr',$page->pageStr(3));
		$this->filename = 'pricesetting_list.html';
	}

	/**
	 * @ 添加或编辑价格区间信息
	 */
	public function popPriceSetting(){
		$id = intval(G('id',3));
		$dataArr=$this->c->search("id = ".$id."");
		$this->tpl('dataArr',$dataArr[0]);
		$this->tpl('id',$id);
		$this->filename = 'pop/popPriceSetting.html';
	}
	
	/**
	 * @ 执行添加或编辑价格区间信息
	 */
	public function execute(){
		$id = intval(G('id',3));
		$dataArr['P_mini'] = G('P_mini',3); //最小值	
		$dataArr['P_max'] = G('P_max',3);//最大值	
		if($id > 0){//编辑价格区间信息
			$this->c->update($dataArr,"id='".$id."'");//更新信息
		}else{//添加价格区间
			$dataArr['P_time'] = time();//时间
			$this->c->insert($dataArr);//插入信息
		}
		show('操作成功!');
	}

    /**
	 * @ 删除信息
	 */
	public function del(){
		$id = intval(G('id',3));
		$this->c->del('id',$id);
		show('操作成功!');
	}
		
	/**
	 * @ 定义系统析构方法
	 */
	public function __destruct(){
		$this->toString();
	}
}
?>