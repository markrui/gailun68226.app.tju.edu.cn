<?php
	class Database
	{
		/**
		 * Amount of queries made	
		 * Add by kafei
		 *
		 * @2011-10-21 21:25
		 * @access private
		 * @var int
		 */
		var $num_queries = 0;
		
		var $connection;

		private static $isconencted=false;
		static function isConnected()
		{
			return Database::$isconencted;
		}

		static function protect($str)
		{
			if (@get_magic_quotes_gpc()) 
			{
				$str= @stripslashes($str);
			}
			else
			{
				$str= @mysql_real_escape_string($str);
			}
			return $str;
		}
		var $error;
		function getLastError(){
			return empty($this->error)?"none error":$this->error;
		}
		function error($errdef)
		{
			$this->error=$errdef;
		}
		function conn()
		{
			global $IVPConfig;
			if(!$this->connect($IVPConfig))
			{
				if(isset($this->error))
					$this->error('mysql.error','connection error');
				return false;
			}
			return true;
		}
		function connect(&$CONFIG)
		{
			if(!is_null($this->connection))
				return false;
			//echo "TRY CONN ".$CONFIG['database']['host']." DB:".$CONFIG['database']['dbname']."<br>";
			$this->connection = @mysql_connect(
					$CONFIG['database']['host'],
					$CONFIG['database']['dbuser'],
					$CONFIG['database']['dbpassword']
				);
			if(!$this->connection)
				return false;
			$selectdb=$this->selectDb($CONFIG['database']['dbname']);
			Database::$isconencted=$selectdb?true:false;
			if(Database::$isconencted&&$CONFIG['database']['charset'])
				$this->sql('SET NAMES '.$CONFIG['database']['charset']);

			return Database::$isconencted;
		}
		function selectDb($dbname)
		{
			return @mysql_select_db($dbname);
		}
		function close()
		{
			if($this->connection!=NULL)
				@mysql_close($this->connection);
			$this->connection=NULL;
			Database::$isconencted=false;
		}
		
		var $log=false;
		function logDef(&$log)
		{
			$this->log=$log;
		}
		
		function sql($query)
		{
			if(!$this->connection)
				return false;
			//$this->conn();
			$timestamp=microtime(true);
			$result=mysql_query($query,$this->connection);
			$timestamp=microtime(true)-$timestamp;
			$this->num_queries++;
			//if($timestamp>5)die($query);
			if($timestamp>5&&$this->log)
			{
				$this->log->reg("WARNING",5,"[".$timestamp."]".$this->safe($query));
			}
			return $result;
		}
		
		static function rows($result)
		{
			return $result==NULL?0:mysql_num_rows($result);
		}
		
		static function getRow($result)
		{
			return $result?mysql_fetch_assoc($result):false;
		}

		static function getRows($result)
		{
			$arr=array();
			while($row=Database::getRow($result))
				$arr[]=$row;
			return $arr;
		}
		
		static function getAffectedRow()
		{
			return  mysql_affected_rows();
		}
		static function getAutoIncrement($from,&$dbref=false)
		{
			if(!$dbref)
			{
				global $db;
				$dbref=$db;
			}
			$get_table_status_sql = "SHOW TABLE STATUS LIKE '".$from."'";
			$result =$dbref->sql($get_table_status_sql);
			while($result&&$table_status=Database::getRow($result))
			{
				if($table_status['Name']==$from)
				{				
					return $table_status['Auto_increment'];
				}
			}
			return 0;
		}
		function getLastInsertId()
		{
			return mysql_insert_id($this->connection);
		}
		
		function countRow($from,$where,&$dbref=false)
		{
			if(!$dbref)
			{
				global $db;
				$dbref=$db;
			}
			//$query="SELECT COUNT(*) AS x FROM ".$from." ".$where;
			$query="SELECT COUNT(1) AS x FROM ".$from." ".$where;
			//die($query);
			$result=$dbref->sql($query);
			if($result)
			{
				$row=$dbref->getRow($result);
				return $row['x'];
			}
			else
				return -1;	
		}
		static function safe($str)
		{
			return mysql_real_escape_string($str);
		}
		function cols($result)
		{
			return  mysql_num_fields($result);
		}
		function getCol($result,$i)
		{
			return mysql_field_name($result,$i);
		}
	}
?>