<?php
	class DatabaseHelper
	{
		//将数组中的指定项(param)取出。转化为set可用的sql串
		static function arrayDumpSet($arr,$paramsDefine)
		{
			$query="";
			foreach($paramsDefine as $val)
			{
				$arr[$val]=base_nulltest($arr[$val],NULL);
				if(is_null($arr[$val]))
					continue;
				//echo "ok[".$query."]";
				if($query!="")$query.=",";
				$query.="`".$val."`='".$arr[$val]."'";
			}
			return $query;
		}
		static function arraySafe($arr,$paramsDefine,&$db)
		{
			$db->conn();
			$newarr=Array();
			foreach($paramsDefine as $val)
			{
				$arr[$val]=base_nulltest($arr[$val],NULL);
				if(is_null($arr[$val]))
					continue;
				//echo "[".$arr[$val]."]";
				$newarr[$val]=$db->safe($arr[$val]);
			}
			//echo "{".count($newarr)."}";
			return $newarr;
		}
	}
?>