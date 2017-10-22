<?php
// defined('InShopNC') or exit('Access Invalid!');

$config = array();
$config['base_site_url']        = 'http://base.jp.com';
$config['shop_site_url'] 		= 'http://shop.jp.com';
$config['cms_site_url'] 		= 'http://localhost/paimai/tzxy';
$config['microshop_site_url'] 	= 'http://localhost/paimai/microshop';
$config['circle_site_url'] 		= 'http://localhost/paimai/circle';
$config['admin_site_url'] 		= 'http://admin.jp.com';
$config['mobile_site_url'] 		= 'http://localhost/paimai/mobile';
$config['wap_site_url'] 		= 'http://localhost/paimai/wap';
$config['m_site_url'] 		    = 'http://m.jp.com';
$config['chat_site_url'] 		= 'http://localhost/paimai/chat';
$config['node_site_url'] 		= 'http://localhost/paimai:8090';
$config['upload_site_url']		= 'http://localhost/paimai/data/upload';
$config['resource_site_url']	= 'http://localhost/paimai/data/resource';
$config['lepai_site_url'] 		= 'http://www.jp.com';
$config['crm_site_url'] 		= 'http://localhost/paimai/crm';
$config['lepai_base_url'] 		= 'http://localhost/paimai/pm';
//圈子 路径
$config['m_tmp_def_url']	= 'http://localhost/paimai/circle/templates/default/circle';
$config['m_circle']	= 'http://localhost/paimai/m';

$config['version'] 		= '201502020388';
$config['setup_date'] 	= '2015-09-01 19:02:32';
$config['gip'] 			= 0;
$config['dbdriver'] 	= 'mysqli';
$config['tablepre']		= 'shop_';
$config['db']['1']['dbhost']       = '127.0.0.1';
$config['db']['1']['dbport']       = '3306';
$config['db']['1']['dbuser']       = 'root';
$config['db']['1']['dbpwd']        = '123456';
$config['db']['1']['dbname']       = 'paimai_online';
$config['db']['1']['dbcharset']    = 'UTF-8';
$config['db']['slave']                  = array();
$config['session_expire'] 	= 3600;
$config['lang_type'] 		= 'zh_cn';
$config['cookie_pre'] 		= '96BE_';
$config['thumb']['cut_type'] = 'gd';
$config['thumb']['impath'] = '';
$config['cache']['type'] 			= 'file';
//$config['redis']['prefix']      	= 'nc_';
//$config['redis']['master']['port']     	= 6379;
//$config['redis']['master']['host']     	= '';
//$config['redis']['master']['pconnect'] 	= 0;
//$config['redis']['master']['passwd'] 	= '';
//$config['redis']['slave']      	    = array();
//$config['fullindexer']['open']      = false;
//$config['fullindexer']['appname']   = '33hao';
$config['debug'] 			= false;
$config['default_store_id'] = '3';

$config['url_model'] = false;

$config['subdomain_suffix'] = '';
//$config['session_type'] = 'redis';
//$config['session_save_path'] = 'tcp://'.$config['redis']['master']['host'].':6379';
$config['node_chat'] = false;

$config['flowstat_tablenum'] = 3;
$config['sms']['gwUrl'] = 'http://sdkhttp.eucp.b2m.cn/sdk/SDKService';
$config['sms']['serialNumber'] = '';
$config['sms']['password'] = '';
$config['sms']['sessionKey'] = '';
$config['queue']['open'] = false;
$config['queue']['host'] = '127.0.0.1';
$config['queue']['port'] = 6379;
$config['cache_open'] = false;
$config['delivery_site_url']    = 'http://localhost/paimai/delivery';
return $config;
