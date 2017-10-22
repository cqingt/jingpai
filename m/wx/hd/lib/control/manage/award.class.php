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

require_once(dirname(__FILE__)."/manage.class.php");
require_once(dirname(__FILE__)."/public/order.class.php");
require_once(dirname(__FILE__)."/../../model/class/PageTurn.class.php");
class award extends manage{

	public function __construct(){
		parent::__construct();
	}

	/**
	 * @ 默认主控类方法
	 */
	public function index(){

	}

	/**
	 * @ 中奖清单
	 */
	public function showlist(){
		$w = $this->createWhere();
		$url = 'index.php?m=award&c=showlist&p=manage'.$w[1];
		$where = 'a.openid=b.openid'.$w[0];
		$fields = 'a.id,a.openid,a.fu as fu1,a.mobile,a.status,a.isOrder,a.type,a.time,b.img,b.nickname,b.fu as fu2,b.guanzhu';
		$page = new PageTurn($this->c,G('page',2,2),'jiang a,user b',$url,20,'a.isOrder ASC,a.time DESC',$where,$fields);
		$this->tpl('dataArr',$page->dataArr);
		$this->tpl('pageStr',$page->pageStr(3));
		$this->tpl('num',$this->num($where));
		$this->filename = 'award_list.html';
	}

	/**
	 * @ 计算中奖人数
	 */
	private function num($where){
		if($where){
			$this->c->table('jiang a,user b');
			return $this->c->sumRows($where);
		}
	}

	/**
	 * @ 创建搜索条件
	 */
	private function createWhere(){
		$a = G('a',2);
		if($a == 'search'){
			$type = G('type',2,2);
			$isOrder = G('isOrder',2,2);
			$key = G('key',2);
			if($key==''){
				$w[] = "a.status='".$type."'";
				$u[] = 'type='.$type;
				
				$w[] = "a.isOrder='".$isOrder."'";
				$u[] = 'isOrder='.$isOrder;
			}else{
				$w[] = "(a.mobile='".$key."' OR a.name='".$key."' OR b.nickname='".$key."')";
				$u[] = 'key='.$key;
			}
			
			if(!empty($w)){
				$where = ' AND '.join(' AND ',$w);
				$url = '&'.join('&',$u);
			}

			return array($where,$url);
		}
	}

	/**
	 * @ 执行领奖操作
	 */
	public function setAward(){
		$id = G('id',2,2);
		$this->tpl('dataArr',$this->getAward($id));
		$this->filename = 'pop/award_show.html';
	}

	/**
	 * @ 加载指定id的用户信息
	 */
	private function getAward($id){
		$this->c->table('jiang a,user b');
		$where = "a.id='".$id."' AND a.openid=b.openid";
		$fields = 'a.id,a.openid,a.fu as fu1,a.mobile,a.name,a.jop,a.birthday,a.sex,a.content,a.address,a.isOrder,a.status,a.time,b.img,b.nickname,b.fu as fu2,b.guanzhu,(SELECT region_name FROM sw_region WHERE region_id=a.province) as province,(SELECT region_name FROM sw_region WHERE region_id=a.city) as city';
		$dataArr = $this->c->search($where,'','',$fields);
		return $dataArr[0];
	}

	/**
	 * @ 取消领奖操作
	 */
	public function noJiang(){
		$id = G('id',2,2);
		$arr = $this->getAward($id);
		$dataArr['status'] = -1;
		if($arr['status']==1){
			show('领奖成功后无法取消','index.php?m=award&c=setAward&p=manage&id='.$id);
		}else{
			$this->c->table('jiang');
			$this->c->update($dataArr,"id='".$id."'");
			show('操作成功','index.php?m=award&c=setAward&p=manage&id='.$id);
		}
	}

	/**
	 * @ 记录领奖信息
	 */
	public function insert(){
		$id = G('id',1,2);
		$dataArr['name'] = G('name');
		$dataArr['birthday'] = G('birthday') ? strtotime(G('birthday')) : 0;
		$dataArr['mobile'] = G('mobile');
		$dataArr['sex'] = G('sex',1,2);
		$dataArr['jop'] = G('jop');
		$dataArr['type'] = G('type');
		$dataArr['province'] = G('province',1,2);
		$dataArr['city'] = G('city',1,2);
		$dataArr['address'] = G('address');
		$dataArr['content'] = G('content');
		$dataArr['status'] = 0;

		//写入订单信息
		$order = new order($this->c);
		$dataArr['isOrder'] = $order->createOrder($id,$dataArr);
		
		//更新用户信息
		$this->c->table('jiang');
		$this->c->update($dataArr,"id='".$id."'");
		show('领奖成功','index.php?m=award&c=setAward&p=manage&id='.$id);
	}
		
	/**
	 * @ 定义系统析构方法
	 */
	public function __destruct(){
		$this->toString();
	}
}
?>