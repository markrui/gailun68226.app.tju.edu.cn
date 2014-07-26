<?php
	function base_version($requireVersion)
	{
		if(!defined('CTPVersion')||CTPVersion<$requireVersion)
			die('类库过于老旧，请更新类库版本到 Ver '.$requireVersion);
	}

	function base_protect($word,$trimit=true)
	{
		if(is_array($word)||is_object($word))
		{
			$tmp=array();
			foreach ($word as $key => $value) {
				$tmp[base_protect($key)]=base_protect($value);
			}
			return $tmp;
		}
		if($trimit)
			$word=trim($word);
		if (get_magic_quotes_gpc()) 
		{
			$word= stripslashes($word);
		}
		else if(Database::isConnected())
		{
			$word= mysql_real_escape_string($word);
		}
		else
		{
			$word=addslashes($word);
		}
		return $word;
	}
	
	function base_multi($num, $perpage, $curpage, $mpurl, $ajaxdiv='', $todiv='',$fixclass=' "') {

		$page = 5;
	
		$multipage = '';
		$mpurl .= strpos($mpurl, '?') ? '&' : '?';
		$realpages = 0;
		if($num > $perpage) {
			$offset = 2;
			$realpages = @ceil($num / $perpage);
			//echo $realpages;
			$pages = $realpages;
			if($page > $pages) {
				$from = 1;
				$to = $pages;
			} else {
				$from = $curpage - $offset;
				$to = $from + $page - 1;
				if($from < 1) {
					$to = $curpage + 1 - $from;
					$from = 1;
					if($to - $from < $page) {
						$to = $page;
					}
				} elseif($to > $pages) {
					$from = $pages - $page + 1;
					$to = $pages;
				}
			}
			$multipage = '';
			$urlplus = $todiv?"#$todiv":'';
			global $_TPL;

			if($curpage - $offset > 1 && $pages > $page) {
				$multipage .= "<a class=\"page-numbers{$fixclass}";
				$multipage .= "href=\"{$mpurl}nowpage=0{$urlplus}\"";
				$multipage .= " class=\"{$fixclass}first\">1 ...</a>";
			}
			if($curpage >= 1) {
				$multipage .= "<a class=\"page-numbers{$fixclass}";
				$multipage .= "href=\"{$mpurl}nowpage=".($curpage-1)."$urlplus\"";
				$multipage .= " class=\"prev{$fixclass}>&lsaquo;&lsaquo;</a>";
			}
			for($i = $from; $i <= $to; $i++) {
				if($i-1 == $curpage) {
					$multipage .= '<span class="page-numbers current">'.$i.'</span>';
				} else {
					$multipage .= "<a class=\"page-numbers{$fixclass}";
					$multipage .= "href=\"{$mpurl}nowpage=".($i-1)."{$urlplus}\"";
					$multipage .= ">$i</a>";
				}
			}
			if($curpage < $pages-1) {
				$multipage .= "<a class=\"page-numbers{$fixclass}";
				$multipage .= "href=\"{$mpurl}nowpage=".(intval($curpage)+1)."{$urlplus}\"";
				$multipage .= " class=\"next{$fixclass}>&rsaquo;&rsaquo;</a>";
			}
			if($to < $pages) {
				$multipage .= "<a class=\"page-numbers{$fixclass}";
				$multipage .= "href=\"{$mpurl}nowpage=".($pages-1)."{$urlplus}\"";
				$multipage .= " class=\"last{$fixclass}>... $realpages</a>";
			}
		}
		return $multipage;
	}

	
	function base_protect_r($word,$trimit=true)
	{
		if(is_array($word))
		{
			$arr=array();
			foreach($word as $k=>$v)
			{
				$arr[base_protect_r($k,$trimit)]=base_protect_r($v,$trimit);
			}
			return $arr;
		}
	
		if($trimit)
			$word=trim($word);
		if (get_magic_quotes_gpc()) 
		{
			$word= stripslashes($word);
		}
		else
		{
			$word= mysql_real_escape_string($word);
		}
		return $word;
	}

	function base_nulltest(&$val,$default="")
	{
		return isset($val)&&!is_null($val)?$val:$default;
	}
	
	function base_escape($str)
	{
		$str=str_replace('<','&lt;',$str);
		$str=str_replace('>','&gt;',$str);
		$str=str_replace('\n','<br/>',$str);
		$str=str_replace(' ','&nbsp;',$str);
		$str=str_replace('\t','&nbsp;&nbsp;&nbsp;&nbsp;',$str);
		return $str;
	}
	
	global $_BASEGLOBAL;
	$_BASEGLOBAL=array();
	
	function base_global($key,$value=false,$domain=false)
	{
		global $_BASEGLOBAL;
		
		if($domain)
			$tpl=&$_BASEGLOBAL[$domain];
		else
			$tpl=&$_BASEGLOBAL;
			
		//print_r($tpl);
		$seek=explode('.',$key);
		$last=false;
		foreach($seek as $k=>$v)
		{
			if($k!=(count($seek)-1))
			{
				if(!isset($tpl[$v]))
				{
					//echo '+'.$v;
					$tpl[$v]=array();
				}
				$tpl=&$tpl[$v];
				//echo '>enter '.$v;
				//print_r($tpl);

			}
			else
			{
				if($value!==false)
				{
					$tpl[$v]=$value;
					//echo '>>set '.$v.'='.$value;
					//print_r($tpl);
					return $value;
				}
				else
				{
					return isset($tpl[$v])?$tpl[$v]:false;
				}
			}
		}
		return false;		
	}

?>