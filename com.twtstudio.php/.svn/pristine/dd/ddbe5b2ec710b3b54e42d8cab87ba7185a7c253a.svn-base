<?php
	class Matrix
	{
		var $tFlag=false;
		/*
			$matrix=new TMatrix();
			$matrix->dlink("1,2,3");
			echo "Dump:\r\n".$matrix->dump();
			exit;
		*/
		var $elements=array();
		function getLinked($keyword)
		{
			//secho "\r\ngenLinkedList:";
			if(!$tFlag)
			{
				$arr=array();
				$count=0;
				//echo "Keyword[".$keyword."]".(is_array($keyword)?"array":"string");
				$pick=$this->elements[$keyword];
				if($pick&&is_array($pick))
				{
					foreach($pick as $key=>$value)
					{
						if($this->isLink($keyword,$key))
						{
							$arr[$count++]=$key;
							//echo "(".$key.")";
						}
						else
						{
							//echo "(-".$key.")";
						}
					}
				}
				//echo ":Count:".count($arr)."\r\n";
				return $arr;
			}
			else
			{
				$arr=array();
				$count=0;
				foreach($this->elements as $k=>$v)
				{
					if($k==$keyword)
					{
						foreach($v as $_k=>$_v)
						{
							if($this->isLink($k,$_k))
								$arr[$count++]=$_k;
						}
					}
					else
					{
						if($this->isLink($k,$keyword))
							$arr[$count++]=$k;
					}
				}
				return $arr;
			
			}
		}
		function link($v1,$v2)
		{	
			return $this->weightedLink($v1,$v2,1);
		}
		function weightedLink($v1,$v2,$weight)
		{
			if($this->tFlag&&$v2<$v1)
				WordEx::swap($v1,$v2);
				
			if(!$this->elements[$v1])
				$this->elements[$v1]=array();
			if(!$this->elements[$v1][$v2])
				$this->elements[$v1][$v2]=$weight;
			else
				$this->elements[$v1][$v2]+=$weight;
		
			if(!$this->tFlag) return;
			if(!$this->elements[$v2])
				$this->elements[$v2]=array();
			if(!$this->elements[$v2][$v1])
				$this->elements[$v2][$v1]=$weight;
			else
				$this->elements[$v2][$v1]+=$weight;
		
		}
		function isLink($v1,$v2)
		{
			if($v1==$v2)
				return $this->elements[$v1][$v2]?$this->elements[$v1][$v2]:1;
			if($this->tFlag&&$v2<$v1)
				WordEx::swap($v1,$v2);
			if($this->elements[$v1]&&$this->elements[$v1][$v2]&&$this->elements[$v1][$v2]>0)
				return $this->elements[$v1][$v2];
			return false;
		}
		function weightedDLink($arr,$weight)
		{
			if(!is_array($arr))
			{
				$iarr=explode(",",$arr);
				if(is_array)
					return $this->weightedDLink($iarr,$weight);
				else
					return;
			}
			$hash=array();
			for($i=0;$i<count($arr);$i++)
			{
				$hash[$arr[$i]]=true;
				for($j=0;$j<count($arr);$j++)
				{
					if($this->tFlag)
					if($hash[$arr[$j]])
						continue;
					$this->weightedLink($arr[$i],$arr[$j],$weight);
				}
			}
		}
		function dLink($arr)
		{
			return $this->weightedDLink($arr,1);
		}
		function dump()
		{
			return ArrayEx::dump($this->elements,"(#K#)->[#V#];");
		}
	}
?>