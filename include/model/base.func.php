<?php

	//message函数会调用message模板输出提示信息，并阻断页面的执行(exit)
	function message($message,$title='提示信息',$href=false)
	{
		global $_TPL,$tpl,$inajax;
		// if(!DEFINED('IN_MNG'))
		// 	$_TPL['css']=array('bootstrap','common','downloadpage','icons');
		if(!$href)
			$href='javascript:history.go(-1)';
		include $tpl->prepare('message');
		exit;
	}

	//table函数会依据config/config.main.php文件中的fingerprint变量
	//对传入的表名称进行加前缀操作
	function table($name)
	{
		global $Config;
		
		return $Config['fingerprint'].$name;
	}

	//补全地址加载模块。
	function load_model($modelname)
	{
		//想载入sample.func.php内的函数，调用：
		//load_model('sample.func');
		@include_once(dirname(__FILE__)."/".$modelname.".php");
	}
	
	function prettysize($kb)
	{
		if($kb<768)
			return number_format($kb,2).'KB';
		else if($kb<768*1024)
			return number_format($kb/1024.0,2).'MB';
		else 
			return number_format($kb/1024.0/1024.0,2).'GB';

	}
	//添加数据
	function inserttable($tablename, $insertsqlarr, $returnid=false, $replace = false) {
		global $db;
	
		$insertkeysql = $insertvaluesql = $comma = '';
		foreach ($insertsqlarr as $insert_key => $insert_value) {
			$insertkeysql .= $comma.'`'.$insert_key.'`';
			$insertvaluesql .= $comma.'\''.$insert_value.'\'';
			$comma = ', ';
		}
		$method = $replace?'REPLACE':'INSERT';
		$db->sql($method.' INTO '.$tablename.' ('.$insertkeysql.') VALUES ('.$insertvaluesql.')');
		if(!$returnid && !$replace) {
			//echo 'ok';
			//echo mysql_error();
			return $db->getLastInsertId();
		}
		return $returnid;	
	}
	
	//更新数据
	function updatetable($tablename, $setsqlarr, $wheresqlarr,$autoprotect=true) {
		global $db;
	
		$setsql = $comma = '';
		foreach ($setsqlarr as $set_key => $set_value) {//fix
			$setsql .= $comma.'`'.$set_key.'`'.'=\''.$set_value.'\'';
			$comma = ', ';
		}
		$where = $comma = '';
		if(empty($wheresqlarr)) {
			$where = '1';
		} elseif(is_array($wheresqlarr)) {
			foreach ($wheresqlarr as $key => $value) {
				if($autoprotect)
					$value=base_protect($value);
				$where .= $comma.'`'.$key.'`'.'=\''.$value.'\'';
				$comma = ' AND ';
			}
		} else {
			$where = $wheresqlarr;
		}
		// echo 'UPDATE '.table($tablename).' SET '.$setsql.' WHERE '.$where;
		$flag=$db->sql('UPDATE '.table($tablename).' SET '.$setsql.' WHERE '.$where);
		// echo 'flag='.$flag;
		return $flag;
	}
	
	function getTitle($page){
		switch ( $page ){
			case 'zcwj':
				$title = '政策文件';
				break;
			case 'jxdg':
				$title = '教学大纲';
				break;
			case 'skja':
				$title = '授课教案';
				break;
			case 'wsdy':
				$title = '网上答疑';
				break;
			case 'xtjd':
				$title = '习题解答';
				break;
			case 'zlhb':
				$title = '资料汇编';
				break;
			case 'wsjz':
				$title = '网上讲座';
				break;
			case 'xxck':
				$title = '学习参考';
				break;
			case 'tlsj':
				$title = '讨论瞬间';
				break;
			case 'sjjy':
				$title = '实践剪影';
				break;
			case 'zyzs':
				$title = '作业展示';
				break;
		}
		
		return $title;
	}