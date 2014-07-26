<?php
	class WordEx
	{
		static function swap(&$v1,&$v2)
		{
			$s=$v1;
			$v1=$v2;
			$v2=$s;
		}
		static function U2G($word)
		{
			return iconv("UTF-8","GBK//IGNORE",$word);
		}
		static function G2U($word)
		{
			return iconv("GBK","UTF-8//IGNORE",$word);
		}
	}
?>