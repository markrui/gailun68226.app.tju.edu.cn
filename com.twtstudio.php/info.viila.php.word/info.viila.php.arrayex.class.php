<?php
	class ArrayEx
	{
		static function fromObject($obj)
		{
			$arr=array();
			foreach ($obj as $key => $value)
			{
				if (is_object($value)||is_array($value)) {
					$tmp=ArrayEx::fromObject($value);
					$arr[$key] = $tmp;
				}
				else
				{
					$arr[$key]=$value;
				}
			}
			return $arr;
		}
	
		static function dump($array,$format)
		{
			$str="";
			if(is_object($array))
				$array=get_object_vars($array);
			if(is_array($array))
			foreach($array as $_k=>$_v)
			{
				$tmp=$format;
				$tmp=str_replace("#K#",$_k,$tmp);
				if(is_object($_v))
				{
					$_v=get_object_vars($_v);
					//echo ArrayEx::dump($_v,"#K#:#V#");
				}
				$tmp=str_replace("#V#",is_array($_v)?ArrayEx::dump($_v,$format):$_v,$tmp);
				$str.=$tmp;
			}
			return $str;
		}
				
		static function setEmpty($array,$mask)
		{
			if(!is_array($array))
				return $array;
			$reg=array();
			$count=0;
			foreach($array as $_k=>$_v)
			{
				if(is_null($_v)||_v=="")
					$reg[$count++]=$_k;
			}
			for($i=0;$i<$count;$i++)
				$array[$reg[$i]]=$mask;
			return $array;
		}
		
		static function arrayTrim ( $array, $index )
		{
			if(is_array($index))
			{
				foreach($index as $item)
				{
					$i=ArrayEx::getElementByValue($item,$array);
					if($i!=-1)
					{
						//echo "-".$i."(".count($array).")";
						$array=ArrayEx::arrayTrim($array,$i);
					}
				}
				return $array;
			}
	        if ( is_array ( $array ) ) {
	        	if(count($array)==1)
	        		return array();
                unset ( $array[$index] );
                array_unshift ( $array, array_shift ( $array ) );
                return $array;
	        }
	        else {
                return false;
        	}
		}
		static function getElementByKey($key, $arr)
		{
			if(!is_array($arr)) return -1;
		    $offset = -1;
		    foreach ($arr as $_k => $_v) {
		    	++$offset;
		        if($_k == $key) return $offset;
		    }
			return -1;
		}
		static function getElementByValueKeyword($key, $arr)
		{
			if(!is_array($arr)) return -1;
		    $offset = -1;
		    foreach ($arr as $_k => $_v) {
		    	++$offset;
		    	//echo "[".$_v.strlen($_v).":".strlen($key)."]";
		        if(strlen($_v)>=strlen($key)&&substr($_v,0,strlen($key)) == $key) 
		        	return $offset;
		    }
			return -1;
		}
		static function getElementByValue($value, $arr)
		{
			if(!is_array($arr)) return -1;
		    $offset = -1;
		    foreach ($arr as $_k => $_v) {
		    	++$offset;
		    	//echo "[".$_v.strlen($_v).":".strlen($value)."]";
		        if($_v == $value) 
		        	return $offset;
		    }
			return -1;
		}
	}
?>