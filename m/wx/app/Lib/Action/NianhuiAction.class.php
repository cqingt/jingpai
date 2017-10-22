<?php
/*
 *年会投票最终结果展示
*/
class NianhuiAction extends Action{
	// protected function _initialize()
 //    {
 //        parent::_initialize();
 //        $array = array(
 //        	'hfType'=>array(
 //        		'2'=>'图文回复',
 //        		),
 //        	);
 //    }

	/*主列表*/
	public function index(){

        $result = M('NianhuiJm')->field("*,(SELECT count(*) FROM wx_nianhui_tou WHERE J_Number=T_JmNumber) as sum_tou" )->select();

        foreach($result as $k => $v){
            // $v['sum_tou'] = mt_rand(0,350);
            $v['bili'] = ceil($v['sum_tou']/3.5);
            
            $data["$v[J_Number]"] = $v;

        }

        $this->assign('data',$data);

		$this->display('img');
	}



	/*主列表*/
	// public function img(){

	// 	$result = M('NianhuiJm')->field("*,(SELECT count(*) FROM wx_nianhui_tou WHERE J_Number=T_JmNumber) as sum_tou" )->select();

	// 	foreach($result as $k => $v){
	// 		$data["$v[J_Name]"] = $v['sum_tou']+100;
	// 	}

	// 	header("content-type:image/png");

	// 	$this->createImage($data,50,25,500);

	// }




    public function setNianhuiPiao(){

        $getJm = M('NianhuiSet')->where("S_Id=1")->find();

        $result = M('NianhuiJm')->select();

        $this->assign('result',$result);

        $this->assign('getJm',$getJm);

        $this->display('setPiao');
    }


    public function doSetJm(){
        $type = $_POST['type'];

        if($type == 1){
            $data['S_Type'] = "1";
            M('NianhuiSet')->where("S_Id=1")->save($data);

            $this->success('开启成功',U("Home/Nianhui/setNianhuiPiao"));
        }else{
            $data['S_Type'] = "0";
            M('NianhuiSet')->where("S_Id=1")->save($data);

            $this->success('关闭成功',U("Home/Nianhui/setNianhuiPiao"));
        }

    }


    public function doSetPiao(){
        $id = $_GET['id'];
        $val = $_GET['val'];

        if($val == 1){
            //关闭
            $data['J_Type'] = "0";
            M('NianhuiJm')->where("J_Id='".$id."'")->save($data);

            $this->success('关闭成功',U("Home/Nianhui/setNianhuiPiao"));
        }else{
            //开启
            $data['J_Type'] = "1";
            M('NianhuiJm')->where("J_Id='".$id."'")->save($data);

            $this->success('开启成功',U("Home/Nianhui/setNianhuiPiao"));
        }



    }



    public function jiaPiao(){

        $result = M('NianhuiJm')->select();

        $this->assign('result',$result);

        $this->display('jiaPiao');
    }


    public function doJiaPiao(){
        $id = $_GET['id'];

        $data['T_JmNumber'] = $id;
        $data['T_OpenId'] = "ocmCHjvOcGWeMk".$this->getRandChar(14);
        $data['T_Time'] = time();

        M('NianhuiTou')->add($data);

        $this->success('禁用成功',U("Home/Nianhui/jiaPiao"));


    }


    public function getRandChar($length){
       $str = null;
       $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
       $max = strlen($strPol)-1;

       for($i=0;$i<$length;$i++){
        $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
       }

       return $str;
      }
     





	public function createImage($data,$twidth,$tspace,$height){
            $dataName = array();
            $dataValue = array();
            $i = 0;
            $j = 0;
            $k = 0;
            $num = sizeof($data);
            
             foreach($data as $key => $val){
                    $dataName[] = $key;
                    $dataValue[] = $val;
                 }
    
            $maxnum = max($data);
            $width = ($twidth + $tspace) * $num + 4;//image's width
            $im = imagecreate($width + 40,$height+20);
            $lineColor = imagecolorallocate($im,12,12,12);
            $bgColor = imagecolorallocate($im,255,233,233);
            $tColor = imagecolorallocate($im,123,200,56);
            imagefill($im,0,0,$bgColor);
            imageline ( $im, 30, 0, 30, $height - 2, $lineColor);
            imageline ( $im, 30, $height - 2, $width + 30 -2 , $height - 2,$lineColor);
             while($i < $num){
                imagefilledrectangle ( $im, $i * ($tspace+$twidth) + 40, $height - $dataValue[$i], $i * ($tspace+$twidth) + 40 + $twidth, $height - 3, $tColor);
                // imagestringup ( $im, 5, $i * ($tspace+$twidth) + $twidth/2 + 30, $height - 10, $dataName[$i]."(".$dataValue[$i].")", $lineColor);

                imagefttext($im,16,90,$i * ($tspace+$twidth) + $twidth/2 + 48,$height - 10,$lineColor,dirname(__FILE__)."/font/heiti.ttf",$dataName[$i]."(".$dataValue[$i].")");

                // imagefttext($im,20,mt_rand(-15,15),$i * ($tspace+$twidth) + $twidth/2 + 30,$height - 10,$lineColor,"./font/heiti.ttf",'888888888888');

                $i++;
             }
             while($j <= (500/10)){
                imagestringup ( $im, 4, 2, $height - $j * 10 + 10, $j * 10, $lineColor);
                $j = $j + 10;
             }
             while($k <= (500/10)){
                 if($k != 0)
                imageline ( $im, 28, $height - $k * 10, 32 , $height - $k * 10,$lineColor);
                $k = $k + 10;
             }

			// Rotate
			$rotate = imagerotate($im, '270', 0);

			// Output
			imagepng($rotate);

            // imagepng($im);
         }


}