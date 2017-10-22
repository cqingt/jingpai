<?php
$mem=new memcache;
$mem->connect("localhost",11211);
$mem->add("mystr","this is a memcache test!",MEMCACHE_COMPRESSED,3600);  
$str=$mem->get("mystr");
echo "string: ".$str."<br />"; 
?>