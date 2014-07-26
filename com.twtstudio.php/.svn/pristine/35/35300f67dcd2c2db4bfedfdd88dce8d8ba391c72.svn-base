<?php
	load_model('user.func');
	if(isset($_POST['method']))
	{
		switch($_POST['method'])
		{
			case 'turnon':
				$ret=user_update(array('isforbidden'=>0),$_POST['uid']);
				if($ret)
					message('用户启用成功');
				else
					message('用户启用失败');
				break;
			case 'turnoff':
				$ret=user_update(array('isforbidden'=>1),$_POST['uid']);
				if($ret)
					message('用户禁用成功');
				else
					message('用户禁用失败');
				break;
			case 'delete':
				$user=user_getById($_POST['uid']);
				if(!$user)
					message('用户未找到');
				$ret=user_delete(array(
						'uid'	=>	$user['uid']
					));
				if($ret)
					message('用户 '.$user['realname'].' 删除成功');
				else
					message('用户 '.$user['realname'].' 删除失败');
				break;
			case 'editstorekbyte':
				$user=user_getById($_POST['uid']);
				if(!$user)
					message('用户未找到');
				$_POST['maxstorekbyte']=(int)$_POST['maxstorekbyte'];
				$ret=user_update(array('maxstorekbyte'=>$_POST['maxstorekbyte']),
					$user['uid']);
				if($ret)
					message('用户 '.$user['realname'].' 空间大小已被设置为'
						.prettySize($_POST['maxstorekbyte']));
				else
					message('用户 '.$user['realname'].' 空间大小设置失败');
				break;
		}
	}

	//查找用户
	include(dirname(__FILE__).'/source_finduser.php');

	$orderbys=array(false,'uid','maxstorekbyte','nowusekbyte','loginat');
	$_GET['orderby']=base_nulltest($_GET['orderby']);
	if(!in_array($_GET['orderby'],$orderbys))
		$_GET['orderby']=$orderbys[0];
	$_GET['desc']=$_GET['desc']?1:0;
	if(isset($_GET['rev']))
		$_GET['desc']=$_GET['desc']?0:1;
	$where='WHERE 1=1';
	if($_GET['uid'])
		$where.=' AND `uid`='.$_GET['uid'];
	$dbv=new DatabaseViewer($db);
	$navidata=$dbv->getNaviData(table('user'),$where,$_GET['p']);
	$baseurl='./?page='.$page.'&do='.$do
		.'&orderby='.$_GET['orderby'].'&desc='.$_GET['desc'];
	if($_GET['uid'])
		$baseurl.='&uid='.$_GET['uid'];
	$nowurl=$baseurl.'&p='.$_GET['p'];
	$navidata['href']=$baseurl;
	// print_r($navi);
	if($_GET['orderby'])
	{
		$where.=' ORDER BY '.$_GET['orderby'].' ';
		if($_GET['desc'])
			$where.=' DESC';
		// echo $where;
	}
	$result=$dbv->sqlByPage(table('user'),$where,$_GET['p']);
	base_version(2.1);
	$list=$db->getRows($result);
	// print_r($list);

	include $tpl->prepare('user_list');