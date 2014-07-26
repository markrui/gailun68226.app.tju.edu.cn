<?php
	class JSONHelper
	{
		static function gracefulArray($instr)
		{
			$instr=trim($instr);
			if(strlen($instr)==0)
				return array();
			if(strrpos($instr,',')==strlen($instr)-1)
				$instr=substr($instr,0,strlen($instr)-1);
			$lm=strpos($instr,'[');
			if($lm==false||$lm!=0)
				$instr="[".$instr;
			$rm=strrpos($instr,']');
			if($rm!=strlen($instr)-1)
				$instr.="]";
			//echo $instr;
			return JSONHelper::decode($instr);
		}
		static function decode($str)
		{
			return json_decode($str);
		}
		static function encode($str)
		{
			return json_encode($str);
		}

	}
?>