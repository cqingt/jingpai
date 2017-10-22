<?php
/**
 * 艺术家管理
 ***/

defined('InShopNC') or exit('Access Invalid!');
class artistControl extends SystemControl{
    const EXPORT_SIZE = 5000;
    public function __construct() {
        parent::__construct ();
        /*加载字符集*/
        Language::read('goods');
        /*添加作者页面语言包*/
        Language::read('rec_position');

        Language::read('web_config,recommend');
    }

    /**
     * 艺术家作者管理
     */
    public function artistOp() {
        /*加载模板*/
        switch ($_GET['type']) {
            // 添加作者
            case 'addArtist':
                $this->add_artist_infoOp();
                Tpl::showpage('artist.add');
                break;
            // 修改作者
            case 'updateArtist':
                $this->update_artistOp();
                Tpl::showpage('artist.update');
                break;
            // 添加职位
            case 'addPosition':
                $this->position_infoOp();
                Tpl::showpage('artist.addPosition');
                break;
            // 官网信息
            case 'webArtist':
                $this->web_artist_infoOp();
                Tpl::showpage('artist.web');
                break;
            // 开通官网
            case 'webArtistShow':
                $this->show_webOp();
                break;
            /*默认模板、所有作者*/
            default:
                $this->artist_infoOp();
                Tpl::showpage('artist.index');
                break;
        }
    }


    /*艺术作品定制*/
    public function artistGoodsCustomOp(){
        $model = Model('artist_new');

        if(!empty($_GET['yname'])){
            $condition['C_ArtistName'] = trim($_GET['yname']);
        }

        if(!empty(intval($_GET['custom_class']))){

            (intval($_GET['custom_class']) == 1) ? $condition['C_CustomType'] = 1 : $condition['C_CustomType'] = 2 ;
        }

        $custom_list = $model->getArtistCustomList($condition,'*','C_Id DESC');

        Tpl::output('custom_list',$custom_list);
        Tpl::output('page',$model->showpage(2));
        Tpl::showpage('artist.custom');
    }

    /*艺术作品定制信息查看*/
    public function artistGoodsCustomInfoOp(){
        $model = Model('artist_new');

        $condition['C_Id'] = intval($_GET['id']);

        $custom_info = $model->getArtistCustomOne($condition);

        Tpl::output('custom_info',$custom_info);
        Tpl::showpage('artist.custom.info');
    }



    /*艺术入驻*/
    public function artistJoinListOp(){
        $artist_list = Model()->table('artist_join')->page(20)->order('J_Type ASC , J_Id DESC')->select();
        Tpl::output('artist_list',$artist_list);
        Tpl::output('page',Model()->showpage(2));
        Tpl::showpage('artist.join');
    }

    /*艺术家入驻确认联系*/
    public function saveArtistTypeOp(){
        if(!empty($_GET['type'])){
            $dataArr['J_Type'] = '1';
        }else{
            $dataArr['J_Type'] = '0';
        }

        $id = intval($_GET['id']);

        $condition['J_Id'] = $id;

        if(Model()->table('artist_join')->where($condition)->update($dataArr)){
            showMessage('操作成功');
        }else{
            showMessage('操作失败');
        }

    }


    /*产品推荐*/
    public function push_goodsOp(){

        $model_goods = Model('goods');

        $where['artist_id'] = array('neq','');

        if($_GET['artist_name']){

            $artist_info = Model('artist')->getNameArtist($_GET['artist_name']);

            if(!empty($artist_info[0]['A_Id'])){
                $where['artist_id'] = $artist_info[0]['A_Id'];
            }
        }

        if($_GET['goods_name']){
            $where['goods_name'] = array(array('like',"%$_GET[goods_name]%"));
        }

        $order = "artist_order DESC , goods_id DESC";

        $goods_list = $model_goods->getGoodsList($where,$field = '*', $group = '',$order, $limit = 0, $page = 20);

        Tpl::output('goods_list', $goods_list);

        Tpl::output('page', $model_goods->showpage(2));

        Tpl::showpage('artist.push_goods');
    }


    /*产品推荐排序*/
    public function ajax_push_goodsOp(){
        $goods_id = intval($_GET['g_id']);
        $artist_order = intval($_GET['a_id']);


        if($goods_id && $artist_order){

            $dataUp['artist_order'] = $artist_order;

            $condition['goods_id'] = $goods_id;

            if(Model('goods')->editGoods($dataUp,$condition)){
                return true;
            }else{
                return false;
            }

        }

    }

    /**
    * 艺术家-相册添加
    */
    public function artist_images_oneOp(){

        $id = trim($_GET['A_Id']);

        $condition['I_ArtistId'] = $id;

        $artistImages = Model('artist_new')->getArtistImages($condition,'','I_Xu DESC , I_Id DESC');

        Tpl::output('artistImages', $artistImages);

        Tpl::showpage('artist.images.add');
    }

    /*艺术家相册删除*/
    public function del_artist_images_oneOp(){
        
        $id = $_GET['I_Id'];

        $condition['I_Id'] = $id;

        if(Model('artist_images')->where($condition)->delete()){
            showMessage('操作成功');
        }else{
            showMessage('操作失败');
        }

    }

    /**
    * 艺术家-相册提交保存
    */
    public function artist_images_saveOp(){


        $artist_id = $_POST['A_Id'];
        if(!empty($artist_id)){
            /*判断相册是否需要上传图片*/
            if(!empty($_FILES['A_Img']['name'])){
                $upload = new UploadFile();
                $upload->set('default_dir',ATTACH_ARTIST);
                $upload->set('thumb_width', '60,360');
                $upload->set('thumb_height', '60,360');
                $upload->set('thumb_ext', '_60,_360');
                $result = $upload->upfile('A_Img');
                if($result){
                //得到图片上传后的路径
                $img_path = 'data/upload/shop/artist/'.$upload->file_name;
                $dataImg['I_ArtistId'] = $artist_id;
                $dataImg['I_Name'] = $_POST['I_Name'];
                $dataImg['I_ImgXC'] = $img_path;
                }
                if(!empty($dataImg['I_ImgXC'])){
                    $img_result = Model()->table('artist_images')->insert($dataImg);

                    if($img_result){
                        showMessage('操作成功');
                    }else{
                        showMessage('操作失败');
                    }

                }
            }
        }else{
            showMessage('操作失败');
        }
    }


    /*艺术家相册*/
    public function artist_imagesOp(){
        $model = Model('artist_new');

        $condition = '';

        if(!empty($_GET['keyword'])){
            $artist_info = Model('artist')->getNameArtist($_GET['keyword']);

            if(!empty($artist_info[0]['A_Id'])){
                $condition['I_ArtistId'] = $artist_info[0]['A_Id'];
            }
        }

        $order = 'I_Xu DESC , I_Id DESC';

        $artist_imaes_info = $model->getArtistImages($condition,30,$order);

        Tpl::output('artist_imaes_info', $artist_imaes_info);

        Tpl::output('page', $model->showpage(2));

        Tpl::showpage('artist.images');

    }


    /*艺术家相册*/
    public function del_artist_imagesOp(){
        
        $images_id_array = $_POST['delbox'];

        $images_id_str = '';

        foreach ($images_id_array as $k => $v) {
            $images_id_str .= ','.$v;
        }

        $images_id_str = ltrim($images_id_str,',');

        $condition['I_Id'] = array('in',$images_id_str);

        if(Model('artist_images')->where($condition)->delete()){
            showMessage('操作成功');
        }else{
            showMessage('操作失败');
        }

    }


    /*艺术家相册图片排序*/
    public function artist_images_xuOp(){
        
        $id = intval($_GET['id']);
        $xu = intval($_GET['xu']);

        $dataXu['I_Xu'] = $xu;

        $condition['I_Id'] = $id;

        if(Model()->table('artist_images')->where($condition)->update($dataXu)){
            echo 1;
            exit;
        }else{
            echo -1;
            exit;
        }

    }


    /*艺术家相册图片排序*/
    public function artist_images_inameOp(){
        
        $id = intval($_GET['id']);
        $iname = intval($_GET['iname']);

        $dataXu['I_Name'] = $iname;

        $condition['I_Id'] = $id;

        if(Model()->table('artist_images')->where($condition)->update($dataXu)){
            echo 1;
            exit;
        }else{
            echo -1;
            exit;
        }

    }


    /*所有作者信息*/
    private function artist_infoOp(){
        /*连接艺术家数据库*/
        $model_artist = Model ( 'artist' );
        /*查询条件*/
        $where['order'] = ' A_Id DESC ';
        /*搜索条件*/
        if($_GET['search']){$where['where'] = " A_Name LIKE '%".trim($_GET['search'])."%' ";}
        /*执行方法*/
        $result_list = $model_artist->getArtist($where);
        /*加载所有数据*/
        Tpl::output('result_list', $result_list);
        /*加载翻页样式*/
        Tpl::output('page', $model_artist->showpage(2));
        /*加载搜索信息*/
        Tpl::output('search', $_GET);
    }

    /*艺术家资料信息所需信息*/
    private function add_artist_infoOp(){
        /*加载所需数据*/
        $this->artist_all_infoOp();
    }

    /*艺术家资料提交*/
    public function add_artistOp(){
        /*图片上传*/
        if(!empty($_FILES['A_Img']['name'])){
            $upload = new UploadFile();
            $upload->set('default_dir',ATTACH_ARTIST);
            $result = $upload->upfile('A_Img');
            if($result){
            //得到图片上传后的路径
            $img_path = 'data/upload/shop/artist/'.$upload->file_name;
            $_POST['A_Img'] = $img_path;
            }
        }

        /*验证数值*/
        $obj_validate = new Validate();
        /*验证返回值在一个数组*/
        $validate_arr = array();
        $validate_arr[] = array("input"=>$_POST["A_Name"], "require"=>"true", "message"=>'艺术家名称不能为空');
        $validate_arr[] = array("input"=>$_POST["A_Position"], "require"=>"true", "message"=>'艺术家职位不能为空');
        $validate_arr[] = array("input"=>$_POST["A_Class"], "require"=>"true", "message"=>'艺术家分类不能为空');
        $validate_arr[] = array("input"=>$_POST["A_JiGuan"], "require"=>"true", "message"=>'艺术家籍贯不能为空');
        $validate_arr[] = array("input"=>$_POST["A_Money"], "require"=>"true", "message"=>'艺术家润格价格不能为空');
        $validate_arr[] = array("input"=>$_POST["A_Img"], "require"=>"true", "message"=>'艺术家图片不能为空');
        /*数据进行验证*/
        $obj_validate->validateparam = $validate_arr;
        /*返回错误信息装入数组*/
        $error = $obj_validate->validate();
        /*如果有错误信息则输出、中止程序*/
        if ($error != ''){showMessage($error);exit;}
        /*没有错误继续执行以下程序*/

        unset($_POST['textfield']);
        $_POST['A_Time'] = time();
        if(count($_POST["A_Position"]) >= 2){
            $_POST["A_Position"] = join(',',$_POST["A_Position"]);
        }else{
            $_POST["A_Position"] = $_POST["A_Position"]['0'];
        }

        /*调用Model 填加参数*/
        $model = Model('artist');
        if($model->addArtist($_POST)){
            showMessage('操作成功');
        }else{
            showMessage('操作失败');
        }
    }

    /*艺术家信息修改*/
    private function update_artistOp(){
        $id = trim($_GET['A_Id']);
        /*加载所需数据*/
        $this->artist_all_infoOp();
        /*加载艺术家个人详细信息*/
        $model = Model('artist');
        /*按ID搜索信息*/
        $result_info = $model->getOneArtist($id);

        $condition['I_ArtistId'] = $id;

        $artistImages = Model('artist_new')->getArtistImages($condition);

        Tpl::output('artistImages', $artistImages);

        /*加载信息*/
        Tpl::output('result_info', $result_info);
    }

    /*艺术家信息修改提交*/
    public function do_save_artistOp(){


        /*判断是否需要上传图片*/
        if(!empty($_FILES['A_Img']['name'])){
            $upload = new UploadFile();
            $upload->set('default_dir',ATTACH_ARTIST);
            $result = $upload->upfile('A_Img');
            if($result){
            //得到图片上传后的路径
            $img_path = 'data/upload/shop/artist/'.$upload->file_name;
            $_POST['A_Img'] = $img_path;
            }
        }


        /*处理数据*/
        unset($_POST['textfield']);
        unset($_POST['textfield_x']);
        $_POST['A_Time'] = time();
        if(count($_POST["A_Position"]) >= 2){
            $_POST["A_Position"] = join(',',$_POST["A_Position"]);
        }else{
            $_POST["A_Position"] = $_POST["A_Position"]['0'];
        }


        /*更新数据*/
        /*调用Model 填加参数*/
        $model = Model('artist');
        if($model->saveArtist($_POST) || $img_result){
            showMessage('操作成功');
        }else{
            showMessage('操作失败');
        }
    }

    /*删除艺术家信息*/
    public function del_artistOp(){
        /*实例数据库*/
        $model = Model('artist');
        /*单项删除*/
        if(!empty($_GET['A_Id'])){
            $id = trim($_GET['A_Id']);
            /*删除数据*/
            /*调用Model 填加参数*/
            if($model->delArtist($id)){
                showMessage('操作成功');
            }else{
                showMessage('操作失败');
            }
        /*全选删除*/
        }elseif(!empty($_POST['A_Id'])){
            if(count($_POST["A_Id"]) >= 2){
                $id = join(",",$_POST["A_Id"]);
            }else{
                $id = $_POST["A_Id"]['0'];
            }
            /*删除数据*/
            /*调用Model 填加参数*/
            if($model->delAllArtist($id)){
                showMessage('操作成功');
            }else{
                showMessage('操作失败');
            }
        }
    }



    /*所有艺术家职位信息*/
    private function position_infoOp(){
        /*连接艺术家数据库*/
        $model = Model ( 'artist_position' );
        /*搜索所有数据*/
        $result = $model->select();
        /*加载所有数据*/
        Tpl::output('result_position', $result);
        /*加载翻页样式*/
        Tpl::output('page', $model->showpage(2));
    }

    /*添加艺术家职位*/
    public function add_positionOp(){
        /*验证数值*/
        $obj_validate = new Validate();
        /*验证返回值在一个数组*/
        $validate_arr = array();
        $validate_arr[] = array("input"=>$_POST["addPosition"], "require"=>"true", "message"=>'艺术家职位不能为空');
        /*数据进行验证*/
        $obj_validate->validateparam = $validate_arr;
        /*返回错误信息装入数组*/
        $error = $obj_validate->validate();
        /*如果有错误信息则输出、中止程序*/
        if ($error != ''){showMessage($error);exit;}
        /*没有错误继续执行以下程序*/

        $dataArr['P_Name'] = $_POST['addPosition'];
        $dataArr['P_Time'] = time();

        /*添加数据*/
        $model = Model('artist_position');
        /*查找是否存在数据*/
        if($model->where("P_Name='".$dataArr['P_Name']."'")->find()){
            showMessage('已存在该信息');
            exit;
        }
        /*继续添加信息*/
        $result = $model->insert($dataArr);
        if($result){
            showMessage('添加成功');
        }else{
            showMessage('添加失败');
        }
    }

    /*删除艺术家职位*/
    public function del_positionOp(){
        $id = intval(trim($_GET['id']));
        $model = Model('artist_position');
        if($model->where(array('P_Id'=>$id))->delete()){
            showMessage('操作成功');
        }else{
            showMessage('操作失败');
        }
    }

    /*AJAX艺术家职位修改*/
    public function ajax_up_positionOp(){
        $id = trim($_GET['id']);
        $dataArr['P_Name'] = trim($_GET['text']);
        $model = Model('artist_position');
        if($model->where(array('P_Id'=>$id))->update($dataArr)){
            echo $dataArr['P_Name'];
        }
    }


    /*加载所需数据*/
    private function artist_all_infoOp(){
        /*连接艺术家职位数据库*/
        $model = Model ( 'artist_position' );
        /*搜索所有数据*/
        $result = $model->select();

        /*搜索一级城市列表*/
        $model_area = Model ( 'area' );
        /*搜索所有数据*/
        $result_area = $model_area->where(array('area_parent_id'=>'0'))->select();

        /*加载数据*/
        Tpl::output('result_position', $result);
        Tpl::output('result_area', $result_area);
    }

    /*艺术家官网详细信息*/
    private function web_artist_infoOp(){
        $id = trim($_GET['A_Id']);
        $model = Model('artist_web');
        $result = $model->getOneArtist($id);
        Tpl::output('result_web',$result);
    }

    /*开通官网*/
    private function show_webOp(){
        $id = trim($_GET['A_Id']);
        $model = Model('artist');
        $array['A_Id'] = $id;
        $array['A_Web'] = '1';
        $result = $model->saveArtist($array);
        $url = "index.php?act=".trim($_GET['act'])."&op=".trim($_GET['op'])."&curpage=".trim($_GET['curpage']);
        header("location:$url");
    }

    /*艺术家官网详细信息提交*/
    public function add_web_artistOp(){
        /*验证数值*/
        $obj_validate = new Validate();
        /*验证返回值在一个数组*/
        $validate_arr = array();
        $validate_arr[] = array("input"=>$_POST["W_Title"], "require"=>"true", "message"=>'请填写艺术家官网名称');
        $validate_arr[] = array("input"=>$_POST["W_Keywords"], "require"=>"true", "message"=>'请填写艺术家官网页面关键字');
        $validate_arr[] = array("input"=>$_POST["W_Description"], "require"=>"true", "message"=>'请填写艺术家官网页面描述');
        $validate_arr[] = array("input"=>$_POST["W_ArtistInfo"], "require"=>"true", "message"=>'请填写艺术家简介');
        $validate_arr[] = array("input"=>$_POST["W_Aid"], "require"=>"true", "message"=>'艺术家ID不能为空');
        /*数据进行验证*/
        $obj_validate->validateparam = $validate_arr;
        /*返回错误信息装入数组*/
        $error = $obj_validate->validate();
        /*如果有错误信息则输出、中止程序*/
        if ($error != ''){showMessage($error);exit;}
        /*没有错误继续执行以下程序*/

        $_POST['W_Time'] = time();

        /*调用Model 填加参数*/
        $model = Model('artist_web');
        unset($_POST['textfield']);

        if($model->addArtist($_POST)){
            $model_art = Model('artist');
            /*修改艺术家资料开通官网*/
            $data['A_Web'] = '1';
            $model_art->where(array('A_Id'=>$_POST['W_Aid']))->update($data);


            /*官网顶部图片*/
            /*判断是否需要上传图片*/
            if(!empty($_FILES['A_Topimg']['name'])){
                $upload = new UploadFile();
                $upload->set('default_dir',ATTACH_ARTIST);
                $result = $upload->upfile('A_Topimg');
                if($result){
                //得到图片上传后的路径
                $img_path = 'data/upload/shop/artist/'.$upload->file_name;
                $dataArr['A_Topimg'] = $img_path;
                $dataArr['A_Id'] = $_POST["W_Aid"];
                /*更新数据*/
                /*调用Model 填加参数*/
                $model = Model('artist');
                $model->saveArtist($dataArr);
                }
            }


            showMessage('操作成功');
        }else{
            showMessage('操作失败');
        }
    }

    /*艺术家官网详细修改提交*/
    public function save_web_artistOp(){
        /*验证数值*/
        $obj_validate = new Validate();
        /*验证返回值在一个数组*/
        $validate_arr = array();
        $validate_arr[] = array("input"=>$_POST["W_Title"], "require"=>"true", "message"=>'请填写艺术家官网名称');
        $validate_arr[] = array("input"=>$_POST["W_Keywords"], "require"=>"true", "message"=>'请填写艺术家官网页面关键字');
        $validate_arr[] = array("input"=>$_POST["W_Description"], "require"=>"true", "message"=>'请填写艺术家官网页面描述');
        $validate_arr[] = array("input"=>$_POST["W_ArtistInfo"], "require"=>"true", "message"=>'请填写艺术家简介');
        $validate_arr[] = array("input"=>$_POST["W_Aid"], "require"=>"true", "message"=>'艺术家ID不能为空');
        /*数据进行验证*/
        $obj_validate->validateparam = $validate_arr;
        /*返回错误信息装入数组*/
        $error = $obj_validate->validate();
        /*如果有错误信息则输出、中止程序*/
        if ($error != ''){showMessage($error);exit;}
        /*没有错误继续执行以下程序*/

        $_POST['W_Time'] = time();

        /*调用Model 填加参数*/
        $model = Model('artist_web');
                unset($_POST['textfield']);

        if($model->saveArtist($_POST)){
            /*官网顶部图片*/
            /*判断是否需要上传图片*/
            if(!empty($_FILES['A_Topimg']['name'])){
                $upload = new UploadFile();
                $upload->set('default_dir',ATTACH_ARTIST);
                $result = $upload->upfile('A_Topimg');
                if($result){
                //得到图片上传后的路径
                $img_path = 'data/upload/shop/artist/'.$upload->file_name;
                $dataArr['A_Topimg'] = $img_path;
                $dataArr['A_Id'] = $_POST["W_Aid"];
                /*更新数据*/
                /*调用Model 填加参数*/
                $model = Model('artist');
                $model->saveArtist($dataArr);
                }
            }
            showMessage('操作成功');
        }else{
            showMessage('操作失败');
        }
    }




    /**
    
        艺术家首页板块

    */
    public function artist_web_configOp(){

        $model_web_config = Model('web_config');
        $style_array = $model_web_config->getStyleList();//板块样式数组
        Tpl::output('style_array',$style_array);
        $web_list = $model_web_config->getWebList(array('web_page' => 'artist'));

        Tpl::output('web_list',$web_list);
        Tpl::showpage('artist_web_config.index');
    }


    /*
    
        基本设置修改

    */

    public function artist_web_editOp(){
        
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
            showMessage(Language::get('nc_common_save_succ'),'index.php?act=artist&op=artist_web_config');
        }
        $web_list = $model_web_config->getWebList(array('web_id'=>$web_id));

        Tpl::output('web_array',$web_list[0]);

        Tpl::showpage('artist_web_edit.edit');

    }



    /*
    
        内容编辑

    */
    public function artist_web_config_editOp(){
        $model_web_config = Model('web_config');
        $web_id = intval($_GET["web_id"]);
        $code_list = $model_web_config->getCodeList(array('web_id'=>"$web_id"));


        $model_class = Model('goods_class');
        $parent_goods_class = $model_class->getTreeClassList(2);//商品分类父类列表，只取到第二级
        if (is_array($parent_goods_class) && !empty($parent_goods_class)){
            foreach ($parent_goods_class as $k => $v){
                $parent_goods_class[$k]['gc_name'] = str_repeat("&nbsp;",$v['deep']*2).$v['gc_name'];
            }
        }
        Tpl::output('parent_goods_class',$parent_goods_class);

        $goods_class = $model_class->getTreeClassList(1);//第一级商品分类
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
        Tpl::showpage('artist_web_config.edit');

    }

    /*
    
        内容编辑

    */
    public function artist_web_htmlOp(){
        $model_web_config = Model('web_config');
        $web_id = intval($_GET["web_id"]);
        $web_list = $model_web_config->getWebList(array('web_id'=>$web_id));
        $web_array = $web_list[0];

        if(!empty($web_array) && is_array($web_array)) {

            $web_html = '';
            $code_list = $model_web_config->getCodeList(array('web_id'=>"$web_id"));

            if(!empty($code_list) && is_array($code_list)) {
                Language::read('web_config,home_index_index');
                $lang = Language::getLangContent();
                $output = array();
                $output['style_name'] = 'artist';
                foreach ($code_list as $key => $val) {
                    $var_name = $val['var_name'];
                    $code_info = $val['code_info'];
                    $code_type = $val['code_type'];
                    $val['code_info'] = $model_web_config->get_array($code_info,$code_type);
                    $output['code_'.$var_name] = $val;
                }

                switch ($web_id) {
                    case '205':
                        $style_file = BASE_DATA_PATH.DS.'resource'.DS.'web_config'.DS.'artist_web_push.php';

                        break;
                    
                    default:
                        $style_file = BASE_DATA_PATH.DS.'resource'.DS.'web_config'.DS.'artist_web.php';

                        break;
                }

                
                if (file_exists($style_file)) {
                    ob_start();
                    include $style_file;
                    $web_html = ob_get_contents();
                    ob_end_clean();
                }


                $web_array = array();
                $web_array['web_html'] = addslashes($web_html);
                $web_array['update_time'] = time();
                $model_web_config->updateWeb(array('web_id'=>$web_id),$web_array);
            }

            showMessage(Language::get('nc_common_op_succ'),'index.php?act=artist&op=artist_web_config');
        } else {
            showMessage(Language::get('nc_common_op_fail'));
        }

    }
	
	/**
     * 留言管理
     */
    public function artistLiuYanOp() {
		$model = Model('artist_new');
		$artPinLun = $model->getArtistPinglun(array(),'*,(select A_Name from shop_artist where A_Id = P_ArtistId) as P_ArtistName,(select count(*) from shop_artist_pinglun_huifu where H_Pid = P_Id) as Pl_Huifu_count','20','P_Id desc');
		/*加载翻页样式*/
        Tpl::output('page', $model->showpage(2));
		Tpl::output('artPinLun',$artPinLun);
        Tpl::showpage('artist.LiuYan');
    }

	/**
     * 删除留言管理信息
     */
    public function DeleteLiuYanOp() {
		if(!empty($_GET['id'])){
			$id = intval($_GET['id']);
			if($id <= 0){
				showMessage("参数错误");
			}
		}elseif(!empty($_POST['P_Id'])){
			$id = $_POST['P_Id'];
		}else{
			showMessage("参数错误");
		}
		Model('artist_new')->delArtistPinglun($id);
		showMessage("删除成功",'index.php?act=artist&op=artistLiuYan');
    }
	
	/**
     * 删除留言管理信息
     */
    public function DeleteLiuYan1Op() {
		$id = intval($_GET['id']);
		if($id <= 0){
			showMessage("删除回复");
		}
		$condition['H_Id'] = $id;
		Model('artist_new')->table('artist_pinglun_huifu')->where($condition)->delete(); //删除回复  
		showMessage("删除成功",'index.php?act=artist&op=artistLiuYan');
	}
	
	/**
     * 查询回复类容
     */
    public function ChaKanHuiFuOp() {
		$id = intval($_POST['id']);
		$PHuiFu = Model()->table('artist_pinglun_huifu')->where(array('H_Pid'=>$id))->order('H_AddTime DESC')->select();
		$str = '';
		if($PHuiFu){
			foreach($PHuiFu as $k=>$v){
				$str .= '<tr class="hover edit"><td style="width:180px;"></td><td class="align-center" style="width:300px;">'.$v['H_MemberName'].'</td><td class="align-center" style="width:300px;">'.$v['H_Content'].'</td><td class="align-center" style="width:300px;">'.date('Y-m-d H:i:s',$v['H_AddTime']).'</td><td class="align-center" style="width:300px;"><a href="index.php?act=artist&op=DeleteLiuYan1&id='.$v['H_Id'].'" onclick="return confirm(\'您确认要删除此留言吗？\');">删除</a></td></tr>';
			}
		}else{
			$str .= '<tr class="hover edit"><td style="width: 1185px;text-align: center;font-size: 14px;">暂无回复</td></tr>';
		}
		echo $str;
		exit;
    }

    /**
     * 艺术家首页轮播图
     */
    public function focus_editOp() {
        
        $model_web_config = Model('web_config');
        $web_id = '211';
        $code_list = $model_web_config->getCodeList(array('web_id'=> $web_id));

        if(is_array($code_list) && !empty($code_list)) {
            foreach ($code_list as $key => $val) {//将变量输出到页面
                $var_name = $val['var_name'];
                $code_info = $val['code_info'];
                $code_type = $val['code_type'];
                $val['code_info'] = $model_web_config->get_array($code_info,$code_type);
                $images_result[] = $val;
                Tpl::output('code_'.$var_name,$val);
            }
        }

        $screen_adv_list = $model_web_config->getAdvList("screen");//焦点大图广告数据

        // var_dump($images_result);

        Tpl::output('screen_adv_list',$screen_adv_list);

        // $focus_adv_list = $model_web_config->getAdvList("focus");//三张联动区广告数据
        // Tpl::output('focus_adv_list',$focus_adv_list);

        Tpl::showpage('artist_web_focus.edit');
    }



}
