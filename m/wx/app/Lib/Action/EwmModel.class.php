<?php
class EwmModel extends Model{

	protected $_validate =array(
		array('E_Name','require','标题不能为空',1,'',4),
		array('E_Desc','require','场景描述不能为空',1,'',4),
		array('E_EwmClass','require','回复模式不能为空',1,'',4),
		array('E_Token','require','token值不能为空',1,'',4),
		array('E_Uid','require','添加人不能为空',1,'',4),
	);
	

	
}