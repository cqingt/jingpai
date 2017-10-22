<?php
/**
 * ZHIMA API: zhima.auth.info.authquery request
 *
 * @author auto create
 * @since 1.0, 2016-03-31 14:34:57
 */
class ZhimaAuthInfoAuthqueryRequest
{
	/** 
	 * 根据identity_type的值，如果为是0，表示传递的是openId，如果是2，表示是证件号
	 **/
	private $identityParam;
	
	/** 
	 * 标识鉴权的时候，所传递的鉴权类型
	 **/
	private $identityType;

	private $apiParas = array();
	private $fileParas = array();
	private $apiVersion="1.0";
	private $scene;
	private $channel;
	private $platform;
	private $extParams;

	
	public function setIdentityParam($identityParam)
	{
		$this->identityParam = $identityParam;
		$this->apiParas["identity_param"] = $identityParam;
	}

	public function getIdentityParam()
	{
		return $this->identityParam;
	}

	public function setIdentityType($identityType)
	{
		$this->identityType = $identityType;
		$this->apiParas["identity_type"] = $identityType;
	}

	public function getIdentityType()
	{
		return $this->identityType;
	}

	public function getApiMethodName()
	{
		return "zhima.auth.info.authquery";
	}

	public function setScene($scene)
	{
		$this->scene=$scene;
	}

	public function getScene()
	{
		return $this->scene;
	}
	
	public function setChannel($channel)
	{
		$this->channel=$channel;
	}

	public function getChannel()
	{
		return $this->channel;
	}
	
	public function setPlatform($platform)
	{
		$this->platform=$platform;
	}

	public function getPlatform()
	{
		return $this->platform;
	}

	public function setExtParams($extParams)
	{
		$this->extParams=$extParams;
	}

	public function getExtParams()
	{
		return $this->extParams;
	}	

	public function getApiParas()
	{
		return $this->apiParas;
	}
	
	public function getFileParas()
	{
		return $this->fileParas;
	}

	public function setApiVersion($apiVersion)
	{
		$this->apiVersion=$apiVersion;
	}

	public function getApiVersion()
	{
		return $this->apiVersion;
	}

}
