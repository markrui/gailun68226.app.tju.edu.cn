<?php

	//会调用user.session.func.php中的user_islogin函数对页面的登录状况进行检查
	function need_login()
	{
		if(!user_islogin())
		{
			message('您所访问的页面需要登录','登陆提醒','http://www.twt.edu.cn/account/');
		}
	}

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
		//调用 table('admin') -> 2012twt_admin
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
?>