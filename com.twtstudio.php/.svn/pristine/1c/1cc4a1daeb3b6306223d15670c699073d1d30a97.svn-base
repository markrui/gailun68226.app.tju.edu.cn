<?php
	class FTPHelper
	{
		var $conn;
		var $localpath;
		function __construct($path)
		{
			$this->localpath=$path;
		}
		
		function connect($host,$port=21,$username="anonymous",$password="")
		{
			if(is_array($host))
			{
				$port=$host[1];
				$username=$host[2];
				$password=$host[3];
				$host=$host[0];
			}
			$this->conn=ftp_connect($host,$port,5);
			if(!$this->conn)
				return false;
			$login=@ftp_login($this->conn,$username,$password);
			return ($login==true)?true:false;
		}
		function rm($filepath) 
		{
			if(!$this->conn)return false;
			if ($this->isfolder($filepath)) 
			{
				if ($dh = $this->ls($filepath)) 
				{
					foreach($dh as $k=>$file)
					{
						$flag=$this->rm($filepath."/".$file);
					}
				}
				$flag=$this->rmdir($filepath);
				return $flag;
			}
			return $this->delete($filepath);
		}
		function rename($oldname,$newname)
		{
			if(!$this->conn)return false;
			return @ftp_rename($this->conn,$oldname,$newname);
		}
		
		function ls($path=".",$recursive=0)
		{
			if(!$this->conn)return false;
			$list=@ftp_nlist($this->conn,$path);
			if($recursive<=0)
				return $list;
			else if($list)
			{
				$len=count($list);
				for($i=0;$i<$len;$i++)
				{
					if($this->isfolder($path."/".$list[$i]))
					{
						$tmp=$this->ls($path."/".$list[$i],$recursive-1);
						if($tmp)
						foreach($tmp as $k=>$v)
							$list[count($list)]=$list[$i]."/".$v;
						//unset($list[$i]);$len--;$i--;
					}
					else
					{
						
					}
				}
				return $list;
			}
			return false;
		}
		
		function lsmore($path='.')
		{
			if(!$this->conn)return false;
			return @ftp_rawlist($this->conn,$path);
		}
		
		function pwd()
		{
			if(!$this->conn)return false;
			return @ftp_pwd($this->conn);
		}
		
		function pasv()
		{
			if(!$this->conn)return false;
			@ftp_pasv($this->conn, 1);
			return true;
		}
		
		function cd($folder)
		{
			if(!$this->conn)return false;
			if($folder=='..')
				return @ftp_cdup($this->conn);
			else
				return @ftp_chdir($this->conn, $folder);
		}
		
		function sizeof($file)
		{
			if(!$this->conn)return;
			return @ftp_size($this->conn, $file);
		}
		
		function isfolder($file)
		{
			return $this->sizeof($file)==-1;
		}
		
		function mkdir($directory)
		{
			if(!$this->conn)return;
			return @ftp_mkdir($this->conn,$directory)==$directory;
		}
		
		function rmdir($directory)
		{
			if(!$this->conn)return false;
			$flag=@ftp_rmdir($this->conn,$directory);
			return $flag;
		}
		
		function delete($file)
		{
			if(!$this->conn)return;
			return @ftp_delete($this->conn,$file);
		}

		
		function put($local,$remote)
		{
			if(!$this->conn)return;
			return @ftp_put($this->conn, $remote, $this->localpath."/".$local, FTP_BINARY);
		}
	
		function get($remote,$local)
		{
			if(!$this->conn)return;
			return @ftp_get($this->conn, $this->localpath."/".$local, $remote, FTP_BINARY);
		}

		function closeConn()
		{
			if(!$this->conn)return;
			ftp_quit($this->conn);
			$this->conn=false;
		}
		
		function mkdir_r($dir)
		{
			$ftp_stream=$this->conn;
			if($this->ftp_is_dir($ftp_stream, $dir) || @ftp_mkdir($ftp_stream, $dir)) return true;
			if(!$this->mkdir_r($ftp_stream, dirname($dir))) return false;
			return ftp_mkdir($ftp_stream, $dir);
		}
		
		function ftp_is_dir($ftp_stream, $dir)
		{
			$ftp_stream=$this->conn;
			$original_directory = ftp_pwd($ftp_stream);
			if(@ftp_chdir( $ftp_stream, $dir)){
				ftp_chdir( $ftp_stream, $original_directory);
				return true;
			} else {
				return false;
			}
		}
	}
?>