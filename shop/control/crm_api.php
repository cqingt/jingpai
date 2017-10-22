<?php
/**
 * CRM操作接口
 *
 *
 *
 ***/
defined('InShopNC') or exit('Access Invalid!');
class crm_apiControl extends BaseMemberControl {

	public function __construct() {
		parent::__construct();
	}
    
    /**
     * CRM——修改用户密码
     */
    public function update_passwordOp() {
		if(empty($_GET)){
			exit;	
		}
        $model_member = Model('member');
		$update	= $model_member->editMember(array('member_id'=>$_GET['UID']),array('member_passwd'=>md5($_GET['PWD']),'ec_salt'=>''));
        if($update){
            $ToApi = new ToApi();
            $ToApi->update_password($_GET['NAME'],md5($_GET['PWD']));
        }
		echo 1;
    }
 
}
