<?php
	//查找用户
	if($_GET['uid']||$_GET['username']||$_GET['realname'])
	{
		load_model('user.func');
		if($_GET['username'])
		{
			$_GET['username']=base_protect($_GET['username']);
			$user=user_getBySQL('WHERE username="'.$_GET['username'].'"');
			if($user)
				$_GET['uid']=$user[0]['uid'];
			else
				message('用户未找到');
		}
		else if($_GET['realname'])
		{
			$_GET['realname']=base_protect($_GET['realname']);
			$user=user_getBySQL('WHERE realname="'.$_GET['realname'].'"');
			if($user)
				$_GET['uid']=$user[0]['uid'];
			else
				message('用户未找到');
		}

		$_GET['uid']=(int)$_GET['uid'];
		$user=user_getById($_GET['uid']);
		if(!$user)
			message('用户未找到');
		$_GET['uid']=$user['uid'];
		$_TPL['breadcrumb'][]=array(
			'name'	=>	'用户：'.$user['realname'],
			'href'	=>	'./?page='.$page.'&do='.$do.'&uid='.$_GET['uid']
		);
	}