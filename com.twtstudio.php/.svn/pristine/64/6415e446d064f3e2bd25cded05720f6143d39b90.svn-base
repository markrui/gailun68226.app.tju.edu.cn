<?php
class CurlHelper
{
	public function __construct()
	{
	}

	private $referer;
	public function getReferer()
	{
		return $this->referer;
	}

	public function setReferer($ref)
	{
		$this->referer=$ref;
	}

	private $connectTimeout;
	public function getConnectTimeout()
	{
		return $this->connectTimeout;
	}

	public function setConnectTimeout($t)
	{
		$this->connectTimeout=$t;
	}

	private $timeout;
	public function getTimeout()
	{
		return $this->timeout;
	}

	public function setTimeout($t)
	{
		$this->timeout=$t;
	}

	private $cookieSwitch=false;
	public function setCookieSwitch($flag)
	{
		$this->cookieSwitch=$flag?true:false;
	}

	public function getCookieSwitch()
	{
		return $this->cookieSwitch;
	}

	private $cookiePool;
	public function clearCookiePool()
	{
		$this->tempnam("tmp", prefix);
	}

	private function error($message,$title='error')
	{
		die("<b>$title</b><p>$message</p>");
		return false;
	}

	public function post($url,$data,$cookiePath=false,$retpack=false)
	{
		$curl=curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl, CURLOPT_REFERER,$this->getReferer());
		curl_setopt($curl, CURLOPT_HEADER,0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT,$this->getConnectTimeout()); 
		curl_setopt($curl, CURLOPT_TIMEOUT, $this->getTimeout());
		$query=$this->formatQuery($data); 
		curl_setopt($curl, CURLOPT_POSTFIELDS, $query);

		//if cookie switch on , should provide $cookiePath
		if($this->getCookieSwitch())
		{
			if(!$cookiePath)
				die($this->error("if cookie switch on , should provide $cookiePath"));
			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiePath);
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiePath);
		}

		$ret=curl_exec($curl);
		if($retpack)
    		$ret=array(
    			'exec'	=>	$ret,
    			'header'	=>	curl_getinfo($curl)
    		);
		curl_close($curl);
		$query=null;
		$curl=null;
		return $ret;
	}

	public function get($url,$data=array(),$cookiePath=false,$retpack=false)
	{
		$curl=curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl, CURLOPT_REFERER,$this->getReferer());
		curl_setopt($curl, CURLOPT_HEADER,0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT,$this->getConnectTimeout()); 
		curl_setopt($curl, CURLOPT_TIMEOUT, $this->getTimeout());
		//$query=$this->formatQuery($data); 
		//curl_setopt($curl, CURLOPT_GETFIELDS, $query);

		//if cookie switch on , should provide $cookiePath
		if($this->getCookieSwitch())
		{
			if(!$cookiePath)
				die($this->error("if cookie switch on , should provide $cookiePath"));
			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiePath);
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiePath);
		}

		$ret=curl_exec($curl);
		if($retpack)
    		$ret=array(
    			'exec'	=>	$ret,
    			'header'	=>	curl_getinfo($curl)
    		);
		curl_close($curl);
		$query=null;
		$curl=null;
		return $ret;
	}

	private function formatQuery($data)
	{
		$query="";
		foreach ($data as $key => $value) {
			$value=urlencode($value);
			$query.=($query==""?"":"&")
				."$key=$value";
		}
		return $query;
	}


}