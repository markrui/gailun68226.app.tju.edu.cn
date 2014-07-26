<?php
	load_model('news.func');
	$page = base_nulltest($_GET['page']);
	$table = $page;
	if(isset($_POST['method']))
	{
		switch($_POST['method'])
		{
			case 'delete':
				$id = intval($_POST["id"]);
				$flag = news_delete($id, $table);
				if($flag)
					message($message."删除成功");
				else 
					message($message."删除失败");
				break;
		}
	}
	$where='WHERE 1=1';
	if($_GET['id'])
	{
		$_GET['id'] = (int)$_GET['id'];
		$where .=' AND `id` = '.$_GET['id'];
		$filter .="指定新闻编号".$_GET['id'];
	}
	//标示本页地址
	$baseurl = './?page='.$page.'&do='.$do;
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
	$navidata=$dbv->getNaviData($table,$where,$_GET['p']);
	$navidata['href']=$baseurl;
	//print_r($navidata);
	$result=$dbv->sqlByPage($table,$where,$_GET['p']);
	base_version(2.1);
	$list=$db->getRows($result);

	include $tpl->prepare('news_list');
	include $tpl->prepare('pagination');