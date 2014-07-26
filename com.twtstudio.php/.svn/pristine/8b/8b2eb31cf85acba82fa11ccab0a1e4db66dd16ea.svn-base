<?php
	class CookieHelper
	{
		function innerSet($key,$value,$seconds)
		{	
			global $IVPConfig;
			
			setcookie($IVPConfig['cookie']['prefix'].$key, $value,time()+$seconds,'/'); 
			//echo "SETCOOKIE [".$MUSICConfig['cookie']['prefix'].$key."|".$value."|".(time()+$seconds)."]"; 
			//echo "=".$this->get($key);
		}
		function clear($key)
		{
			global $IVPConfig;
			
			$this->innerSet(
			
			
			$key, NULL,time()-3600); 
		}
		function lock()
		{
			$this->setLock=true;
		}
		var $setLock=false;
		function setDuration($key,$duration)
		{
			$this->innerSet($key,$this->get($key),$duration);
		}
		function set($key,$value)
		{
			if($this->setLock)
				return;
			global $IVPConfig;
			$this->innerSet($key, $value, $IVPConfig['cookie']['duration']);  
		}
		function setHash($key,$value)
		{			
			$this->set($key, $this->prepareHash($value));  
		}
		static function prepareHash($value)
		{
			global $IVPConfig;
			
			return md5($IVPConfig['cookie']['hashfix'].$value);
		}
		function get($key)
		{
			global $IVPConfig;
			return isset($_COOKIE[$IVPConfig['cookie']['prefix'].$key])?$_COOKIE[$IVPConfig['cookie']['prefix'].$key]:NULL;
		}
		function checkHash($key,$value)
		{
			global $IVPConfig;
			return $this->get($key)==$IVPConfig['cookie']['hashfix'].$value?true:false;  
		}
	}
?>