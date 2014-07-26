<?php
	load_model('auth.func');
	function manage_needAdmin()
	{
		global $_TPL,$tpl;
		if(!user_isLogin())
		{
			include $tpl->prepare('login');
			exit;
		}
		$flag=auth_check('manage',0,'ADMIN');
		if($flag>0)
			return true;
		// message('您不拥有指定的管理权限');
		// user_logout();
		$_TPL['hidemenu']=true;
		$message='您不拥有指定的管理权限';
		if(defined('ISDEBUG')&&ISDEBUG)
		{
			$message.='<br/>请于auth表添加自己天外天uid:'
				.$_SESSION['twt_uid']
				.'的("manage",0,"ADMIN",1)权限';
		}
		include $tpl->prepare('login');
		exit;
	}