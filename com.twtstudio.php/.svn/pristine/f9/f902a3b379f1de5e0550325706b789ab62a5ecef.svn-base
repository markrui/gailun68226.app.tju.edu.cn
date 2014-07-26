<?php
	class iList
	{
		var $innerArray=Array();
		var $count=0;
		function add($str)
		{
			if(is_array($str))
			{
				foreach($str as $v)
					$this->add($v);
			}
			else
				$this->innerArray[$this->count++]=$str;
		}
		function addOnce($str)
		{
			if(is_array($str))
			{
				foreach($str as $v)
					$this->addOnce($v);
			}
			else
			{
				if($this->find($str)==-1)
					$this->innerArray[$this->count++]=$str;
			}
		}

		function toArray()
		{
			$arr=Array();
			for($i=0;$i<$this->count;$i++)
			{
				$arr[$i]=$this->innerArray[$i];
			}
			return $arr;
		}
		function get($index)
		{
			if($index>=0&&$index<$this->count)
			{
				$item= ($this->innerArray[$index]);
				return $item;
			}
			return NULL;
		}
		function set($index,$value)
		{
			if($index>=0&&$index<$this->count)
			{
				$this->innerArray[$index]=$value;
			}
		}
		function remove($index)
		{
			if($index>=0&&$index<$this->count)
			{
				$item=$this->get($index);
				for($i=$index;$i<$this->count;$i++)
				{
					$this->set($i,$this->get($index));
				}
				$this->innerArray=ArrayEx::arrayTrim($this->innerArray,$this->count-1);
				$this->count--;
				return $item;
			}
			return NULL;
		}
		function find($keyword)
		{
			$index=ArrayEx::getElementByValue($keyword,$this->innerArray);
			if($index>=0&&$index<$this->count)
				return $index;
			return -1;
		}
		function dump()
		{
			return ArrayEx::dump($this->innerArray,"(#K#=>#V#)");
		}
	}
?>