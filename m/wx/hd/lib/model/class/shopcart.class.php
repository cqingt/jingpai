<?php
class ShopCart{ 
  var $sortCount; //商品种类数 
  var $totalCost; //商品总金额 
  /* 所有的商品,如：$myCart[3][$name]:商品编号为3的名称
  *               $myCart[3][$price]:商品编号为3的单价 
  *　　　　　　　   $myCart[3][$count]:商品编号为3的数量
  *               $myCart[3][$cost]:商品编号为3的合计金额
  */
  var $myCart;
  var $Id;      //每类商品的ID（数组） 
  var $Name;    //每类商品的名称（数组） 
  var $Price;   //每类商品的价格（数组） 
  var $Count;   //每类商品的件数（数组） 
  var $Cost;    //每类商品的价值（数组） 
  var $file;	//每类商品的图片(数组)
  var $code;	//每类商品的编号(数组)
  var $memo;	//每类商品的备忘(数组)
   
  //******构造函数 
  function __construct(){ 
    $this->sortCount = 0; 
    $this->totalCost = 0;
    $this->myCart    = array();
    @session_start();    //初始化一个session
    if(session_is_registered("myCart")==false)  session_register('myCart');       
    $this->update(); 
  //  $this->Calculate();
  } 
   
  //********私有，根据session的值更新类中相应数据 
  function update(){ 
    @session_start();    //初始化一个session 
    $myCart = $_SESSION["myCart"];
    if(false==$myCart){
        $this->sortCount = 0;
        $this->totalCost = 0;
        $this->myCart = array();
        return false;
    }
    //得到商品的总数量
    $this->sortCount=count($myCart); 
    if($this->sortCount>0)
    {
        //开始计算商品的金额
        $totalCost = 0;
        foreach($myCart as $key=>$val){
			            
            $myCart[$key]["count"] = round(eregi_replace(",", "",$myCart[$key]["count"]),2);
            $myCart[$key]["price"] = round(eregi_replace(",", "",$myCart[$key]["price"]),2);
					
                
            //计算每件商品的金额
            $myCart[$key]["cost"] = round($val["count"]*$val["price"], 2);
            //得到所有商品的金额
            $totalCost += $myCart[$key]["cost"];
        }
        $this->totalCost = $totalCost;
        $this->myCart = $myCart;
        $_SESSION["myCart"] = $myCart;
    }
     
  } 
   
 /**
 * 格式化数字为货币数据
 *
 *
 **/
  function formatNum($data){
  	
    foreach($data as $key=>$val)
    {
        foreach($val as $sName=>$sValue)
        {
            if($sName !="name")
            {    
                $data[$key][$sName] = number_format($sValue, 2);
            }
        }
    }
    return $data;
}

 //**************以下为接口函数 
   
 //*** 加一件商品 
 // 判断是否篮中已有，如有，加count，否则加一个新商品 
 //首先都是改session的值，然后再调用update() and calculate()来更新成员变量 
  function addOne($id,$na,$pr,$file,$code,$memo,$count=1){
  	
    @session_start();    //初始化一个session 
    $myCart = $_SESSION["myCart"];
    //设置购物车中的数量
    $myCart[$id]["name"]  = $na;
    $myCart[$id]["price"] = $pr;
    $myCart[$id]["file"] = $file;
    $myCart[$id]["code"] = $code;
    $myCart[$id]["memo"] = $memo;
    
    if (!isset($myCart[$id]["count"])) {
    	$myCart[$id]["count"] = 1;
    }else{
    	++$myCart[$id]["count"];
    }
    
    if ($count>1) {
    	$myCart[$id]["count"] = $count;
    }
    
    $_SESSION["myCart"] = $myCart;
    //更新一下类的成员数据 
    $this->update();
}

 /**
 * 向购物车中添加一组商品,如果没有，进行添加，如果已经存在，则更新为data
 * @param $data  - 要添加的商品,格式为：
 *                 $data[0][id],   $data[0][name],
 *                 $data[0][price],$data[0][count],
 * 				   $data[0][file], $data[0][code]
 * @return boolean
 */
 function addData($data){
 	
    if(count($data > 0)){
    	
        @session_start();    //初始化一个session 
        $myCart = $_SESSION["myCart"];
        foreach($data as $val){
            extract($val);
            //设置购物车中的数量
            $myCart[$id]["name"]  = $name;
            $myCart[$id]["price"] = $price;
            $myCart[$id]["count"] = $count;
            $myCart[$id]["file"] = $file;
            $myCart[$id]["code"] = $code;
            $myCart[$id]["memo"] = $memo;
        }
        $_SESSION["myCart"] = $myCart;
        //更新一下类的成员数据 
        $this->update();
    }
 }
/*
*　更改一件商品的单价
*
*
*
**/
function updatePrice($id, $price,$state=1){
    if($state){//可以执行0元写入
		if($price <=0)    return false;
	}
    @session_start();    //初始化一个session
    $myCart = $_SESSION["myCart"];
    if($myCart[$id]==true){
        $myCart[$id]["price"]=$price;

        $_SESSION["myCart"] = $myCart;
        $this->update(); 
    }
}
 //将一件商品的数量减1
  function removeOne($id){
  	
      $count = $this->myCart[$id]["count"];
      if($count>0){
          $this->modifyCount($id, --$count);
      }
  } 
   
  //改变商品的个数,如果传入单价，则一起更改单价 
  function modifyCount($id, $ncount, $price=0)
  { 
    if($ncount <= 0) return false;
    @session_start();    //初始化一个session 
    $myCart = $_SESSION["myCart"];
    if($myCart[$id]==true)
    {
        $myCart[$id]["count"]=$ncount; 
        //如果有传入单价，则一起更改单价
        if($price >0 ) $myCart[$id]["price"]=$price; 

           $_SESSION["myCart"] = $myCart;
        $this->update(); 
    }
   
  } 
   
  //清空一种商品 
  function emptyOne($i){ 
    @session_start();    //初始化一个session 
    $myCart = $_SESSION["myCart"] ;
    unset($myCart[$i]); 
    if(count($myCart)==0){
        $this->emptyAll();
    }else{
        $_SESSION["myCart"] = $myCart ;   
        $this->update(); 
    }
}
   
  /*************************** 
  清空所有的商品 
   
  因为在win里PHP不支持session_destroy()函数，所以这个清空函数不完善， 
  只是把每种商品的个数置为0。 
  如果是在linux下，可以直接用session_destroy()来做。 
  *****************************/ 
  function emptyAll(){ 
       	@session_start();    //初始化一个session 
    	$myCart = $_SESSION["myCart"];
    
	    unset($myCart);
	    $_SESSION["myCart"] = array();   
	    $this->update(); 
  } 
   
  /**
  *  返回所有购物车中的数据
  *
  **/
  function getData()
  {
      if($this->sortCount > 0){
          return $this->myCart;
      }else{
          return array();
      }
  }
  //取一件商品的信息，主要的工作函数 
  //返回一个关联数组，下标分别对应 id,name,price,count,cost 
  function getOne($i){ 
    $data = $this->myCart[$i];
    if(false==$data) return array();

    $data["id"] = $i;
    return $data; 

  } 
   
  //取总的商品种类数 
  function getSortCount(){ 
    return $this->sortCount; 
  } 
   
  //取总的商品价值 
  function getTotalCost(){ 
    return $this->totalCost; 
  } 
   
//end class  
} 

