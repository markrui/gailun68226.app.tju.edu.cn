<?php
	load_model('auth.func');
	if(isset($_POST['method']))
	{
		switch($_POST['method'])
		{
			case 'turnon':
				$ret=auth_update(array('iscancel'=>0),array(
						'aid'	=>	$_POST['aid'],
						'ownertype'	=>	$_POST['ownertype'],
						'ownerid'	=>	$_POST['ownerid'],
						'domain'	=>	'manage',
						'did'	=>	0,
						'auth'	=>	'ADMIN'
					));
				if($ret)
					message('管理员启用成功');
				else
					message('管理员启用失败');
				break;
			case 'turnoff':
				$ret=auth_update(array('iscancel'=>1),array(
						'aid'	=>	$_POST['aid'],
						'ownertype'	=>	$_POST['ownertype'],
						'ownerid'	=>	$_POST['ownerid'],
						'domain'	=>	'manage',
						'did'	=>	0,
						'auth'	=>	'ADMIN'
					));
				if($ret)
					message('管理员禁用成功');
				else
					message('管理员禁用失败');
				break;
			case 'add':
				$_POST['uid']=(int)$_POST['uid'];
				load_model('user.func');
				$user=user_getById($_POST['uid']);
				if(!$user)
					message('用户未找到');
				$ret=auth_add('user',$_POST['uid'],'manage',0,'ADMIN',1,
					isset($_POST['grant'])?0:1);
				if($ret)
					message('管理员添加成功');
				else
					message('管理员添加失败');
				break;
			case 'delete':
				$ret=auth_delete(array(
						'aid'	=>	$_POST['aid'],
						'ownertype'	=>	$_POST['ownertype'],
						'ownerid'	=>	$_POST['ownerid'],
						'domain'	=>	'manage',
						'did'	=>	0,
						'auth'	=>	'ADMIN'
					));
				if($ret)
					message('管理员删除成功');
				else
					message('管理员删除失败');
				break;
		}
	}

	$list=auth_query('ADMIN','manage',0);
	
	load_model('user.func');
	foreach($list as $i => $v)
	{
		$list[$i]['owner']=$v['ownertype']=='user'?user_getById($v['ownerid']):false;
		$list[$i]['grant']=user_getById($v['grantby']);
	}
	// print_r($list);

	include $tpl->prepare('user_grant');