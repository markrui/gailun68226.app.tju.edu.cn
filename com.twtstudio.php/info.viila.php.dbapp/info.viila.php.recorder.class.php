<?php
	class Recorder
	{
		var $db;
		function __construct(&$db)
		{
			$this->db=$db;
		}
		
		function init()
		{
			global $IVPConfig;
		
			$query="CREATE TABLE `".$IVPConfig['basedatabase']['record']."` ("
				."  `index` bigint(20) unsigned NOT NULL auto_increment,"
				."  `key` char(128) NOT NULL,"
				."  `intro` text,"
				."  `value` bigint(20) default NULL,"
				."  `last_update` datetime default NULL,"
				."  PRIMARY KEY  (`index`,`key`),"
				."  UNIQUE KEY `k` (`key`)"
				.") ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8";	
			return $this->db->sql($query);
		}

		
		function incWithDateTime($key)
		{
			$this->incWithIntro($key,date("Y-m-d H:i:s"));
		}
		function incWithIntro($key,$intro)
		{
			global $IVPConfig;
			$this->db->conn();
			$key=$this->db->safe($key);
			$query="UPDATE `".$IVPConfig['basedatabase']['record']."` SET `value`=`value`+1,`intro`='".$intro."',"
				."`last_update`='".date("Y-m-d H:i:s")."' WHERE `key`='".$key."'";
			$result=$this->db->sql($query);
			if($this->db->getAffectedRow($result)==0)
			{
				//echo "insert record";
				$query="INSERT INTO `".$IVPConfig['basedatabase']['record']."` (`key`,`value`,`intro`,`last_update`)"
					." VALUES ('".$key."','1','".$intro."','".date("Y-m-d H:i:s")."')";
				$result=$this->db->sql($query);
			}
		}
		function set($key,$value)
		{
			global $IVPConfig;
			$this->db->conn();
			$key=$this->db->safe($key);
			$query="UPDATE `".$IVPConfig['basedatabase']['record']."` SET `value`=`value`+1,"
				."`last_update`='".date("Y-m-d H:i:s")."' WHERE `key`='".$key."'";
			$result=$this->db->sql($query);
			if($this->db->getAffectedRow($result)==0)
			{
				//echo "insert record";
				$query="INSERT INTO `".$IVPConfig['basedatabase']['record']."` (`key`,`value`,`last_update`)"
					." VALUES ('".$key."','".$value."','".date("Y-m-d H:i:s")."')";
				$result=$this->db->sql($query);
			}
		}

		function inc($key)
		{
			global $IVPConfig;
			$this->db->conn();
			$key=$this->db->safe($key);
			$query="UPDATE `".$IVPConfig['basedatabase']['record']."` SET `value`=`value`+1,"
				."`last_update`='".date("Y-m-d H:i:s")."' WHERE `key`='".$key."'";
			$result=$this->db->sql($query);
			//die($query);
			if($this->db->getAffectedRow($result)==0)
			{
				//echo "insert record";
				$query="INSERT INTO `".$IVPConfig['basedatabase']['record']."` (`key`,`value`,`last_update`)"
					." VALUES ('".$key."','1','".date("Y-m-d H:i:s")."')";
				$result=$this->db->sql($query);
			}
		}
		
		function fetch($key)
		{
			global $IVPConfig;
			$this->db->conn();
			$query="SELECT `value` FROM `".$IVPConfig['basedatabase']['record']."` WHERE `key`='".$key."' LIMIT 1";
			$result=$this->db->sql($query);
			if($result&&$this->db->rows($result)==1)
			{
				$row=$this->db->getRow($result);
				return $row['value'];
			}
			return 0;
		}
		
		function fetchLike($key)
		{
			global $IVPConfig;
			$this->db->conn();
			$query="SELECT `key`,`value` FROM `".$IVPConfig['basedatabase']['record']."` WHERE `key` LIKE '".$key."'";
			//echo $query;
			$result=$this->db->sql($query);
			$arr=Array();
			if($result&&$this->db->rows($result)>0)
			{
				$count=$this->db->rows($result);
				//echo $count;
				for($i=0;$i<$count;$i++)
				{
					$row=$this->db->getRow($result);	
					$arr[$row['key']]=$row['value'];
				}
			}
			return $arr;
		}
	}
?>