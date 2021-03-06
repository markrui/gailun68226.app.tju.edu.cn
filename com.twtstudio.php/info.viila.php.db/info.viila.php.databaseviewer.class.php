<?php
	class DatabaseViewer
	{
		var $db;
		function __construct(&$db)
		{
			$this->db=$db;
		}
		
		var $limit=10;
		var $rowcount=0;
		function setPageLimit($limit)
		{
			$oldlimit=$this->limit;
			$this->limit=intval($limit);
			return $oldlimit;
		}
		function setNaviJs($navijs)
		{
			$this->navijs=$navijs;
		}

		var $indexlimit=5,$navijs="alert(";
		function genPageNavi($from,$where,&$page)
		{
			$this->nicePage($from,$where,$page);
			
			$indexlimit=$this->indexlimit;
			$pageitems=$this->limit;
			$c=$this->rowcount;
			//echo $page.":".$c." by ".$pageitems;
			$dotcount=0;
			$paging="";
			for($i=0;$i<($c)/$pageitems;$i++)
			{
				if($i==$page)
				{
					$dotcount=0;
					$paging.=" <b>".($i+1)."</b>";
					continue;
				}
				if(abs($i-$page)>=$indexlimit
					&&abs($i-0)>=$indexlimit
					&&abs($i-$c/$pageitems+1)>=$indexlimit
					)
				{
					$dotcount++;
					if($dotcount>5)
						continue;
					$paging.=".";
					continue;
				}
				$dotcount=0;
				$paging.=" <a href='javascript:' onclick=\"".$this->navijs."'".($i)."')\">".($i+1)."</a>";
			}
			$locid="iptnaviloc".rand(1000,9999);
			$paging.=" <input id=".$locid." type=text style='width:50px;text-align:center' value=".($page+1)
				." onkeydown=\"if(event.keyCode==13){".$this->navijs."document.getElementById('".$locid."').value-1)}\">";
			return $paging;
		}
		
		function genPageNaviM($from,$where,&$page)
		{
			$this->nicePage($from,$where,$page);
			
			$indexlimit=$this->indexlimit;
			$pageitems=$this->limit;
			$c=$this->rowcount;
			//echo $page.":".$c." by ".$pageitems;
			$dotcount=0;
			for($i=0;$i<($c)/$pageitems;$i++)
			{
				if($i==$page)
				{
					$dotcount=0;
					$paging.=" <span class='thispage'>".($i+1)."</span>";
					continue;
				}
				if(abs($i-$page)>=$indexlimit
					&&abs($i-0)>=$indexlimit
					&&abs($i-$c/$pageitems+1)>=$indexlimit
					)
				{
					$dotcount++;
					if($dotcount>5)
						continue;
					$paging.=".";
					continue;
				}
				$dotcount=0;
				$paging.=" <a href='javascript:' onclick=\"".$this->navijs."'".($i)."')\">".($i+1)."</a>";
			}
			$locid="iptnaviloc".rand(1000,9999);
		
			return $paging;
		}
		
		function getNaviData($from,$where,&$page)
		{
			$data=array();
			$this->nicePage($from,$where,$page);
			$pageitems=$this->limit;
			$c=$this->rowcount;
			$data['limit']=$this->limit;
			$data['count']=$c;
			$data['page']=$page;
			$data['totalpage']=floor($c/$this->limit);
			if($data['totalpage']*$this->limit!=$c)
				$data['totalpage']++;
			$data['isfirst']=$page==0&&$c!=0;
			$data['islast']=($page==($data['totalpage']-1))&&$page!=0;
			$data['hasnext']=(!$data['islast'])&&$data['totalpage']>1;
			$data['hasprev']=(!$data['isfirst'])&&$data['totalpage']>1;
			return $data;
		}

		
		function nicePage($from,$where,&$page)
		{
			$page=floor($page);
			if(!is_numeric($page)||$page<0)
			{
				$page=0;
			}
			
			$this->rowcount=$this->db->countRow($from,$where);
			if($page==0)
				return;
			if(($page+1)*$this->limit>$this->rowcount)
			{
				$page=intval($this->rowcount/$this->limit);
			}
			if((intval($page))*$this->limit==$this->rowcount&&intval($page)>=1)
			{
				$page-=1;
			}	
			$page=intval($page);
			/*while(($page*$this->limit) > $this->rowcount||($page!=0&&($page*$this->limit) == $this->rowcount))
			{
				$page--;
				//echo $page;
			}*/
		}
		var $selectCols='*';
		function setCols($in)
		{
			$this->selectCols="";
			if(is_array($in))
				foreach($in as $word)
				{
					if($this->selectCols!="")
						$this->selectCols.=",";
					$this->selectCols.='`'.$word.'`';
				}
			else
				$this->selectCols=$in;
			
		}
		var $assocTable;
		function sqlByPage($from,$where,$page)
		{
			$this->assocTable=$from;
			$this->nicePage($from,$where,$page);
			$query="SELECT ".$this->selectCols." FROM `".$from."` ".$where." LIMIT ".($page*$this->limit).",".$this->limit;
			//echo $this->rowcount." ".$query;
			$this->setCols('*');
			return $this->db->sql($query);
		}
		
		//highlight the row when match the column value, using global.css
		private $markcol='status',$markcolvalue='false';
		function regMarkCol($c,$v)
		{
			$this->markcol=$c;
			$this->markcolvalue=$v;
		}
		//primary col for indexing, using js to do the navi
		private $primarycol='_',$primaryfixjs="alert('#PRIMARY#')",$delfixjs="";
		function regPrimaryColOnly($p)
		{
			$this->primarycol=$p;
		}
		function regPrimaryCol($p,$js)
		{
			$this->primarycol=$p;
			$this->primaryfixjs=$js;
		}
		function regDelJs($js)
		{
			$this->delfixjs=$js;
		}
		function genResultList($result)
		{
			$arr=array();
			return $this->innerGenResultList($result,$arr);
			
		}
		function innerGenResultList($result,&$array)
		{
			$str="";
			//$str.=is_null($dbhandle)?"NULL":"OK";
			//$str.="count:".(Database::rows($result))."<br/>";
			//$str.="primary set:".$this->primarycol." markcol:".$this->markcol."=".$this->markcolvalue;
			$str.= "<table class='thickborder'>";
			if($result!=NULL)
			{
				$str.="<thead><tr class='fwhite black'>";
				if($this->delfixjs!=""&&isset($row[$this->primarycol]))
					$str.="<td></td>";
				for ($i = 0; $i < mysql_num_fields($result); $i++) 
				{
					if(mysql_field_name($result,$i)==$this->primarycol)
						$str.="<td class='red'>";
					else
						$str.="<td>";
					$str.=mysql_field_name($result,$i);
					
					$fieldObject=mysql_fetch_field($result,$i);
					$str.="[".($fieldObject->type)."]";
					
					$str.="</td>";
				}
				$str.="</tr></thead><tbody>";
				while($row = Database::getRow($result))
				{
					$array[]=$row;
					$row[$this->markcol]=base_nulltest($row[$this->markcol]);
					if($row[$this->markcol]==$this->markcolvalue)
						$str.="<tr class='yellow'>";
					else
						$str.="<tr>";
					if($this->delfixjs!=""&&isset($row[$this->primarycol]))
					{
						$str.="<td><a href='#' onclick=\""
							.str_replace("#PRIMARY#",$row[$this->primarycol],$this->delfixjs)
							."\">[x]</a></td>";
					}
					for($j=0; $j<mysql_num_fields($result);$j++)
					{
						$str.="<td";
						if(mysql_field_name($result,$j)==$this->primarycol)
						{
							$str.=" class=\"buttonlike\" onclick=\"".str_replace("#PRIMARY#",$row[mysql_field_name($result,$j)],$this->primaryfixjs)."\"";
						}
						$str.=">";						
						$str.="<p class='wrap'>";
						$str.=htmlspecialchars($row[mysql_field_name($result,$j)]);
						$str.="</p>";
						$str.="</td>";
					}
					$str.="</tr>";
				}
				$str.="</tbody>";
				$str.="<tfoot>";
				$str.="<tr><td colspan=".mysql_num_fields($result)."><a href='#' onclick=\"".str_replace("#PRIMARY#","",$this->primaryfixjs)."\">insert new</a></td></tr>";
				$str.="</tfoot>";
			}
			$str.="</table>";
			return $str;
		}		
		function innerForm($result,$row)
		{
			if(!is_array($row))
			{
				$row=array(
					"index"	=>	$row
				);		
			}
		
			$str="<table><tbody>";
			for($j=0; $j<mysql_num_fields($result);$j++)
			{
				$str.="<tr><td>";
				$str.=mysql_field_name($result,$j);					
				$fieldObject=mysql_fetch_field($result,$j);
				$str.="[".($fieldObject->type)."]";
				if($fieldObject->primary_key==1||$fieldObject->not_null==1)
					$str.="*";
				$str.="</td><td>";
				switch($fieldObject->type)
				{
					case "blob":
						$str.="<textarea style='width:100%;height:100px' name='".mysql_field_name($result,$j)."'>"
							.$row[mysql_field_name($result,$j)]
							."</textarea>";
						break;
					default:
						$str.="<input type='text' style='width:100%' name='".mysql_field_name($result,$j)
							."' value=\"".$row[mysql_field_name($result,$j)]."\"><br>";
						break;
				}
				$str.="</td></tr>";
			}
			$str.="</tbody></table>";
			$str.="<select name='IVPSignal' id='IVPSignal'>"
				."<option value=update>update</option>"
				."<option value='delete'>delete</option>"
				."</select>";
			$str.="<input type='submit' onclick='document.getElementById(\"IVPSignal\").value=\"delete\"' value='delete'>";
			return $str;

		}
		function genPostForm($result)
		{
			$arr=array();
			$count=0;
			if(Database::rows($result)!=0)
				while($row = Database::getRow($result))
				{
					$arr[$count]=$this->innerForm($result,$row);
					//echo $str;
					$count++;
				}
			else
			{
				$row=Array();
				if($this->assocTable!="")
				{
					$row=Database::getAutoIncrement($this->assocTable);
					//echo "AI:".$row;
				}
				$arr[0]=$this->innerForm($result,$row);
			}
			//echo $count;
			return $arr;
		}

	}//end of class `DatabaseViewer`
?>
