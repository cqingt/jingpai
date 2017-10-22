<?php
/**
 * ZHIMA API: zhima.auth.engine.smsauth request
 *
 * @author auto create
 * @since 1.0, 2016-07-27 17:27:59
 */
class ZhimaAuthEngineSmsauthRequest
{
	/** 
	 * 扩展业务参数
	 **/
	private $bizParams;
	
	/** 
	 * 身份参数
	 **/
	private $identityParam;
	
	/** 
	 * 
	 **/
	private $identityType;

	private $apiParas = array();
	private $fileParas = array();
	private $apiVersion="1.0";
	private $scene;
	private $channel;
	private $platform;
	private $extParams;

	
	public function setBizParams($bizParams)
	{
		$this->bizParams = $bizParams;
		$this->apiParas["biz_params"] = $bizParams;
	}

	public function getBizParams()
	{
		return $this->bizParams;
	}

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
		return "zhima.auth.engine.smsauth";
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
