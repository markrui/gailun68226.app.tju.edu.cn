<?php
	load_model('auth.func');
	auth_need('manage',0,'ADMIN_AUTH');

	if(isset($_POST['method']))
	{
		switch($_POST['method'])
		{
			case 'turnon':
				$ret=auth_update(array('iscancel'=>0),array(
						'aid'	=>	$_POST['aid']
					));
				if($ret)
					message('权限项启用成功');
				else
					message('权限项启用失败');
				break;
			case 'turnoff':
				$ret=auth_update(array('iscancel'=>1),array(
						'aid'	=>	$_POST['aid']
					));
				if($ret)
					message('权限项禁用成功');
				else
					message('权限项禁用失败');
				break;
			// case 'add':
			// 	$_POST['uid']=(int)$_POST['uid'];
			// 	load_model('user.func');
			// 	$user=user_getById($_POST['uid']);
			// 	if(!$user)
			// 		message('用户未找到');
			// 	$ret=auth_add('user',$_POST['uid'],'manage',0,'ADMIN',1,
			// 		isset($_POST['grant'])?0:1);
			// 	if($ret)
			// 		message('管理员添加成功');
			// 	else
			// 		message('管理员添加失败');
			// 	break;
			case 'delete':
				$ret=auth_delete(array(
						'aid'	=>	$_POST['aid']
					));
				if($ret)
					message('权限项删除成功');
				else
					message('权限项删除失败');
				break;
		}
	}

	//查找用户
	include(dirname(__FILE__).'/source_finduser.php');

	$orderbys=array(false,'owner','domain','auth','grantat');
	$_GET['orderby']=base_nulltest($_GET['orderby']);
	if(!in_array($_GET['orderby'],$orderbys))
		$_GET['orderby']=$orderbys[0];
	$_GET['desc']=$_GET['desc']?1:0;
	if(isset($_GET['rev']))
		$_GET['desc']=$_GET['desc']?0:1;

	//构造Where语句
	$where='WHERE 1=1';
	if($_GET['uid'])
		$where.=' AND `uid`='.$_GET['uid'];
	$filter="";
	if($_GET['nocancel'])
	{
		$where.=' AND `iscancel`=0';
		$filter.=" 除去禁用掉的";
	}
	if($_GET['owner'])
	{
		$_GET['ownertype']=base_protect($_GET['ownertype']);
		$_GET['ownerid']=(int)$_GET['ownerid'];
		$where.=' AND `ownertype`='.$_GET['ownertype'];
		$filter.=" 指定所有者".$_GET['ownertype'];
		if($_GET['did'])
		{
			$where.=' AND `ownerid`="'.$_GET['ownerid'].'"';
			$filter.="(".$_GET['ownerid'].")";
		}
	}
	if($_GET['domain'])
	{
		$_GET['domain']=base_protect($_GET['domain']);
		$_GET['did']=(int)$_GET['did'];
		$where.=' AND `domain`="'.$_GET['domain'].'"';
		$filter.=" 指定作用域".$_GET['domain'];
		if($_GET['did'])
		{
			$where.=' AND `did`="'.$_GET['did'].'"';
			$filter.="(".$_GET['did'].")";
		}
	}
	if($_GET['auth'])
	{
		$_GET['auth']=str_replace("%", "", $_GET['auth']);
		$_GET['auth']=base_protect($_GET['auth']);
		if(strpos( $_GET['auth'],"*")!==false)
		{
			$where.=' AND `auth` LIKE "'.str_replace("*", "%", $_GET['auth']).'"';
			$filter.=" 查询权限".$_GET['auth'];
		}
		else
		{
			$where.=' AND `auth` ="'.$_GET['auth'].'"';
			$filter.=" 指定权限".$_GET['auth'];
		}
	}
	if($_GET['orderby'])
	{
		switch($_GET['orderby'])
		{
			case 'owner':
				$where.=' ORDER BY `ownertype` ';
				if($_GET['desc'])
					$where.=' DESC';
				$where.=',`ownerid` ASC';
				break;
			case 'domain':
				$where.=' ORDER BY `domain` ';
				if($_GET['desc'])
					$where.=' DESC';
				$where.=',`did` ASC';
				break;
			default:
				$where.=' ORDER BY '.$_GET['orderby'].' ';
				if($_GET['desc'])
					$where.=' DESC';
				break;
		}
	}


	//标示本页地址
	$baseurl='./?page='.$page.'&do='.$do
		.'&orderby='.$_GET['orderby'].'&desc='.$_GET['desc'];
	if($_GET['uid'])
		$baseurl.='&uid='.$_GET['uid'];
	if($_GET['nocancel'])
		$baseurl.='&nocancel=1';
	if($_GET['fid'])
		$baseurl.='&fid='.urlencode($_GET['fid']);
	if($_GET['filename'])
		$baseurl.='&filename='.urlencode($_GET['filename']);
	$nowurl=$baseurl.'&p='.$_GET['p'];

	if($filter)
	{
		$_TPL['breadcrumb'][]=array(
			'name'	=>	'过滤：'.$filter,
			'href'	=>	$nowurl
		);
	}

	//分页
	$dbv=new DatabaseViewer($db);
	$navidata=$dbv->getNaviData(table('authmap'),$where,$_GET['p']);
	$navidata['href']=$baseurl;
	// print_r($navi);
	$result=$dbv->sqlByPage(table('authmap'),$where,$_GET['p']);
	base_version(2.1);
	$list=$db->getRows($result);

	//检查是否拥有获取文件源文件地址的权限
	$cangetorigin=auth_checkTF('manage',0,'ADMIN_FILE_GETORIGINPATH');

	load_model('user.func');
	foreach ($list as $i => $v) {
		if($_GET['uid'])
			$list[$i]['user']=$user;
		else
			$list[$i]['user']=user_getById($v['uid']);
		$list[$i]['filename']=base_escape($v['filename']);
	}
	// print_r($list);
	
	load_model('user.func');
	foreach($list as $i => $v)
	{
		$list[$i]['owner']=$v['ownertype']=='user'?user_getById($v['ownerid']):false;
		$list[$i]['grant']=user_getById($v['grantby']);
	}
	// print_r($list);

	include $tpl->prepare('auth_list');