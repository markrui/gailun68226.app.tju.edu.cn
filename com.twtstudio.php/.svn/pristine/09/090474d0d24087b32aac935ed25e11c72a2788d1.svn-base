<?php
	class ID3TagReader
	{
		function __construct()
		{

		}
		function read($filename)
		{
			try
			{
				$tags=array();
				$fp = fopen($filename, "rb");  
				fseek($fp,-128,SEEK_END);  
				  
				$header = fread($fp,3); // Header[3]  
				if ('TAG'!=$header) //die("Unknown Header Information:".$header);  
					return false;
				$tags['title'] = trim(fread($fp,30)); // Title[30]  
				$tags['artist'] = trim(fread($fp,30)); // Artist[30]  
				$tags['album'] = trim(fread($fp,30));   // Album[30]  
				$tags['year'] = fread($fp,4);   // Year[4]  
				$tags['comment'] = trim(fread($fp,28)); // Comment[28]  
				  
				fseek($fp,1,SEEK_CUR);  // reserve  
				  
				$tags['track'] = ord(fread($fp,1)); // Track[1]  
				$tags['genre'] = ord(fread($fp,1)); //Genre[1]  
				fclose($fp);  
				return $tags;
			}
			catch(Exception $ex)
			{
				return false;
			}
		}
		function getID3($filename)
		{
			require_once(dirname(__FILE__).'/getid3/getid3.php');
			$getID3 = new getID3;
			$ThisFileInfo = $getID3->analyze($filename);
			getid3_lib::CopyTagsToComments($ThisFileInfo);
			//print_r($ThisFileInfo);
			return $ThisFileInfo['comments'];
		}
	}
?>