<?php
/**
 * App - Api 	接口
 *
 */


defined('InShopNC') or exit('Access Invalid!');

class appapiControl{

	private $sign_key = "soucang96567appkey";

    private $os_type = array('ios');

    private $api_version = array('v1');

	// public function __construct() {
        
 //    }


    public function indexOp(){
        exit;
    }

    /**
     * 请求数据
     */
	public function getAppDataOp() {
		$data = $_POST;
        // method 验证
        $this->valiMethod($data['method']);
        // os_type 验证
        $this->valiOsType($data['os_type']);
        // api_version 验证
        $this->valiApiVersion($data['api_version']);
        // time 验证
        $this->valiTime($data['time']);
        // sign 验证
        $this->valiSign($data);
        // class 验证
        $this->valiClass($data);
        // 验证全部通过的情况下调用接口调取数据
        $appClass = 'app_'.$data['os_type'].'_'.$data['api_version'];   //类名
        $fun = $data['method'];     //方法名
        // 验证类中是否存在方法
        $this->valiClassFun($data);
        echo $appClass::$fun($data);     //返回结果
	}


    /**
     * 验证method 方法
     */
    private function valiMethod($dataArr){
        if(empty($dataArr)){
            $msg['code'] = 10001;
            $msg['message'] = 'error';
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 验证os_type 版本
     */
    private function valiOsType($dataArr){
        if(empty($dataArr)){
            $msg['code'] = 10002;
            $msg['message'] = 'error';
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 验证api_version 版本号
     */
    private function valiApiVersion($dataArr){
        if(empty($dataArr)){
            $msg['code'] = 10003;
            $msg['message'] = 'error';
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 验证time 时间
     */
    private function valiTime($dataArr){
        if(empty($dataArr)){
            $msg['code'] = 10004;
            $msg['message'] = 'error';
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 验证签名
     */
    private function valiSign($dataArr){
        $data['method'] = $dataArr['method'];
        $data['os_type'] = $dataArr['os_type'];
        $data['api_version'] = $dataArr['api_version'];
        $data['time'] = $dataArr['time'];
        $data['sign'] = $this->get_sign($data);
        if($data['sign'] !== $dataArr['sign']){
            $msg['code'] = 10101;
            $msg['message'] = 'error';
            echo json_encode($msg);
            exit;
        }
    }

    /**
     * 验证class 是否存在
     */
    private function valiClass($dataArr){

        if( (!in_array($dataArr['os_type'], $this->os_type)) || (!in_array($dataArr['api_version'], $this->api_version))){
            $msg['code'] = 10011;
            $msg['message'] = 'error';
            echo json_encode($msg);
            exit;
        }

    }

    /**
     * 验证类中是否存在方法
     */
    private function valiClassFun($dataArr){

        $className = 'app_'.$dataArr['os_type'].'_'.$dataArr['api_version'];

        $class = new $className;

        if(!method_exists($class,$dataArr['method'])){
            $msg['code'] = 10012;
            $msg['message'] = 'error';
            echo json_encode($msg);
            exit;
        }

    }


	private function get_sign($params) {
        $sort_array = array();
        $arg = "";
        $params = $this->arg_sort($params);
        foreach($params as $key => $val){
            $arg .= $key.$val;
        }
        $sign = md5(md5($arg).$this->sign_key);
        return $sign;
    }

    private function arg_sort($array) {
        ksort($array);
        reset($array);
        return $array;
    }

    private function httpPOST($url, $data){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }




}
