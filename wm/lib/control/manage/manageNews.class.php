<?php
/**
 * 	文章管理系统
 *	
 *	2015-3-21	L
 */
require_once(dirname(__FILE__)."/../../model/class/PageTurn.class.php");
require_once(dirname(__FILE__)."/../../model/class/Upload.class.php");
require_once(dirname(__FILE__)."/manage.class.php");
require_once(dirname(__FILE__)."/../../plugins/edit.class.php");
class manageNews extends manage{
	public function __construct(){
		parent::__construct();
		$this->filename='news.html';
	}
	//文章列表显示页
	public function index(){
		$this->c->table('News');//连接文章表
		$resNews=$this->c->search();//查询文章表所有文章
		$this->tpl('resNews',$resNews);//结果传入模板
		$this->toString();
	}


	//文章添加界面
	public function addNews(){
		$editClass = new editClass();
		$this->tpl('editClass',$editClass->getFckEdit('content',800,500));//加载文本编辑器

		//连接文章分类表查出文章分类
		$this->c->table('newsClass');
		$resClass=$this->c->search("N_Path='"."0'");//查出一级分类列表数据
		$twoClass=$this->c->search("N_Path != '"."0'");//查出二级分类列表数据
		if(!empty($twoClass)){
		foreach(@$twoClass as $key => $val){
			$resTwoClass[$val[N_Path]][]=$val;
		}}
		$this->tpl('resClass',$resClass);//一级分类数据传入模板
		$this->tpl('resTwoClass',$resTwoClass);//二级分类数据传入模板
		$this->filename = 'pop/popAddNews.html';
		$this->toString();
	}


	//文章添加
	public function toAddNews(){
		//接收数据拼装数组
		$dateArr['N_Number']=$this->Number;//权限
		$dateArr['N_Title']=G('title','1');//标题
		$dateArr['N_Content']=G('content','1');//内容
		$dateArr['N_Nclass']=G('Nclass','1');//文章类型
		$dateArr['N_Nimg']='';//图片路径
		$dateArr['N_UID']=$_SESSION['U_ID'];//发布人UID
		$dateArr['N_Uname']=$_SESSION['U_UserName'];//发布人名称
		$dateArr['N_Time']=time();//发布时间
		$this->c->table('News');//连接文章表
		if(!empty($dateArr['N_Title']) && !empty($dateArr['N_Content'])){
			$this->c->insert($dateArr);//执行插入数据
		}
		show('文章添加成功','index.php?m=manageNews&c=index&p=manage');
	}

	//文章删除
	public function deNews(){
		$id=G('id','2');
		$this->c->table('News');//连接文章表
		$this->c->del('N_ID',$id);//根据ID删除文章
		show();
	}

	//文章编辑页面
	public function upNews(){
		$id=G('id','2');
		$this->c->table('News');//连接文章表
		$resNews=$this->c->search("N_ID='"."$id'");//根据ID查出文章数据
		$editClass = new editClass();
		$this->tpl('editClass',$editClass->getFckEdit('content',800,500,$resNews['0']['N_Content']));//加载文本编辑器
		//连接文章分类表查出文章分类
		$this->c->table('newsClass');
		$resClass=$this->c->search("N_Path='"."0'");//查出一级分类列表数据
		$twoClass=$this->c->search("N_Path != '"."0'");//查出二级分类列表数据
		if(!empty($twoClass)){
		foreach(@$twoClass as $key => $val){
			$resTwoClass[$val[N_Path]][]=$val;
		}}
		$this->tpl('resClass',$resClass);//一级分类数据传入模板
		$this->tpl('resTwoClass',$resTwoClass);//二级分类数据传入模板
		$this->tpl('update',true);
		$this->tpl('resNews',$resNews);
		$this->filename = 'pop/popAddNews.html';
		$this->toString();
	}

	//文章编辑
	public function toUpNews(){
		$id=G('cid','2');
		//接收数据拼装数组
		$dateArr['N_Number']=$this->Number;//权限
		$dateArr['N_Title']=G('title','1');//标题
		$dateArr['N_Content']=G('content','1');//内容
		$dateArr['N_Nclass']=G('Nclass','1');//文章类型
		$dateArr['N_Nimg']='';//图片路径
		$dateArr['N_UID']=$_SESSION['U_ID'];//发布人UID
		$dateArr['N_Uname']=$_SESSION['U_UserName'];//发布人名称
		$dateArr['N_Time']=time();//修改时间
		$this->c->table('News');//连接文章表
		if(!empty($dateArr['N_Title']) && !empty($dateArr['N_Content'])){
			$this->c->update($dateArr,"N_ID='"."$id'");//数据修改
		}
		show('修改成功','index.php?m=manageNews&c=index&p=manage');

	}











	//文章分类显示
	public function newsClass(){
	//一、显示分类
		//连接文章分类表
		$this->c->table('newsClass');
		$resClass=$this->c->search("N_Path='"."0'");//查出一级分类列表数据
		$twoClass=$this->c->search("N_Path != '"."0'");//查出二级分类列表数据
		if(!empty($twoClass)){
		foreach(@$twoClass as $key => $val){
			$resTwoClass[$val[N_Path]][]=$val;
		}}
		$this->tpl('resClass',$resClass);//一级分类数据传入模板
		$this->tpl('resTwoClass',$resTwoClass);//二级分类数据传入模板
		$this->filename='newsClass.html';//文章分类模板
		$this->toString();//加载模板
	}

	//分类添加界面
	public function popAddNewsClass(){
		//连接文章分类表
		$this->c->table('newsClass');
		$resClass=$this->c->search("N_Path='"."0'");//查出分类列表数据
		$this->tpl('resClass',$resClass);//数据传入模板
		$this->filename='pop/popAddNewsClass.html';//文章分类模板
		$this->toString();//加载模板
	}

	//分类添加
	public function addNewsClass(){
		//连接文章分类表
		$this->c->table('newsClass');
		//拼装数据
		$dateArr['N_Number']=$this->Number;//网站权限
		$dateArr['N_Class']=$_POST['N_Class'];//分类名称
		$dateArr['N_Path']=$_POST['N_Path']?$_POST['N_Path']:'0';//分类等级
		//空值检测
		if(!empty($dateArr['N_Class'])){
		//拼装好后的数据插入数据库
			$this->c->insert($dateArr);
		}
		show('添加成功','index.php?m=manageNews&c=newsClass&p=manage');
	}

	//删除分类
	public function deNewsClass(){
		$id=G('cid',2,2);
		$this->c->table('newsClass');
		$this->c->del('N_ID',$id);
		show();
	}

	//分类编辑显示页面
	public function popUpNewsClass(){
		$cid=G('cid','2','2');
		$this->tpl('update',true);
		$this->c->table('newsClass');
		$resClass=$this->c->search("N_ID='"."$cid'");//查出分类列表数据
		$this->tpl('cid',$cid);
		$this->tpl('resClass',$resClass);//数据传入模板
		$this->filename='pop/popAddNewsClass.html';//文章分类模板
		$this->toString();//加载模板
	}

	//分类编辑
	public function popToUpNewsClass(){
		$id=$_POST['cid'];
		$dateArr['N_Number']=$this->Number;//网站权限
		$dateArr['N_Class']=$_POST['N_Class'];//分类名称
		$this->c->table('newsClass');
		$this->c->update($dateArr,"N_ID='"."$id'");
		$this->filename='pop/popAddNewsClass.html';//文章分类模板
		show('添加成功','index.php?m=manageNews&c=newsClass&p=manage');
	}


	//二级分类添加界面
	public function popTwoAddClass(){
		$cid=G('cid','2','2');
		$this->tpl('addTwo',true);
		$this->c->table('newsClass');
		$resClass=$this->c->search("N_ID='"."$cid'");//查出分类列表数据
		$this->tpl('resClass',$resClass);//数据传入模板
		$this->filename='pop/popAddNewsClass.html';//文章分类模板
		$this->toString();//加载模板
	}

	//二级分类添加
	public function popToTwoAddClass(){
		//连接文章分类表
		$this->c->table('newsClass');
		//拼装数据
		$dateArr['N_Number']=$this->Number;//网站权限
		$dateArr['N_Class']=$_POST['N_Class'];//分类名称
		$dateArr['N_Path']=$_POST['N_Path']?$_POST['N_Path']:'0';//分类等级
		//空值检测
		if(!empty($dateArr['N_Class'])){
		//拼装好后的数据插入数据库
			$this->c->insert($dateArr);
		}
		show('添加成功','index.php?m=manageNews&c=newsClass&p=manage');
	}

}
?>