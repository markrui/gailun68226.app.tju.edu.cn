<?php
	class CacheHelper
	{
		static function Record()
		{
			ob_start();
		}
		static function Flush()
		{
			ob_end_flush();
		}
		static function End()
		{
			ob_end_clean();
		}
		static function CacheAndFlush($cachepath)
		{
			CacheHelper::CacheToFile($cachepath);
			CacheHelper::Flush();			
		}
		static function CacheAndEnd($cachepath)
		{
			CacheHelper::CacheToFile($cachepath);
			CacheHelper::End();			
		}
		static function CacheToFile($cachepath)
		{
			$str=ob_get_contents();
			$f=fopen($cachepath,"w");
			fwrite($f,$str);
			fclose($f);
		}
		
		static function ObjToFile($obj,$cachepath,$encrypt=false)
		{
			$str=JSONHelper::encode($obj);
			$f=fopen($cachepath,"w");
			fwrite($f,$str);
			fclose($f);
		}
		
		static function FileToObj($cachepath,&$obj,$encrypt=false)
		{
			if(!file_exists($cachepath))
				return false;
			$f=fopen($cachepath,"r");
			$str=fread($f,filesize($cachepath));
			$obj=JSONHelper::decode($str);
			//print_r($obj);
			return $obj;
		}
		
		
	}
?>