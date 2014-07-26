<?php
	load_model('news.func');

	if(isset($_POST['method']))
	{
		switch($_POST['method'])
		{
			case 'changesubject':
				$id = intval($_POST["id"]);
				$subject=base_nulltest($_POST["subject"]);
				$subject=trim($subject);
				if(!$subject)
				{
					message('新闻标题不能为空');
					break;
				}
				$news=news_getById($id);
				if(!$news)
					message('新闻未找到');

				$result = news_update(array('subject'=>$subject),$news['index']);
				if($result)
					message('新闻标题修改成功');
				else
					message('新闻标题修改失败');

				break;
			case 'top':
			case 'hide':
			case 'delete':
				$word=array('top'=>'置顶','hide'=>'隐藏','delete'=>'删除');
				$word=$word[$_POST['method']];
				$id = intval($_POST["id"]);
				$val=$_POST['value']?1:0;
				if(!$val)
					$word='解除'.$word;
				$news=news_getById($id);
				if(!$news)
					message('新闻未找到');
				if($news['is'.$_POST['method']]==$val)
					message('新闻已被'.$word);

				$flag=news_update(
					array('is'.$_POST['method']=>$val),
					$id);
				if($flag)
					message('新闻'.$word.'成功');
				else
					message('新闻'.$word.'失败');
				break;
		}
	}

	//查找用户
	include(dirname(__FILE__).'/source_finduser.php');

	$orderbys=array(false,'index','addat','visitcount','istop','ishide','isdelete');
	$_GET['orderby']=base_nulltest($_GET['orderby']);
	if(!in_array($_GET['orderby'],$orderbys))
		$_GET['orderby']=$orderbys[0];
	$_GET['desc']=$_GET['desc']?1:0;
	if(isset($_GET['rev']))
		$_GET['desc']=$_GET['desc']?0:1;
	// echo 'rev='.$_GET['rev'].' desc='.$_GET['desc'];
	//构造Where语句
	$where='WHERE 1=1';
	if($_GET['uid'])
		$where.=' AND `addby`='.$_GET['uid'];
	$filter="";
	if($_GET['nohide'])
	{
		$where.=' AND `ishide`=0';
		$filter.=" 除去隐藏新闻";
	}
	if($_GET['nodelete'])
	{
		$where.=' AND `isdelete`=0';
		$filter.=" 除去已删除新闻";
	}
	if($_GET['index'])
	{
		$_GET['index']=(int)$_GET['index'];
		$where.=' AND `index`='.$_GET['index'];
		$filter.=" 指定新闻编号 ".$_GET['index'];
	}
	if($_GET['subject'])
	{
		$_GET['subject']=str_replace("%", "", $_GET['subject']);
		$_GET['subject']=base_protect($_GET['subject']);
		if(strpos( $_GET['subject'],"*")!==false)
		{
			$where.=' AND `subject` LIKE "'.str_replace("*", "%", $_GET['subject']).'"';
			$filter.=" 查询新闻标题【".$_GET['subject'].'】';
		}
		else
		{
			$where.=' AND `subject` ="'.$_GET['subject'].'"';
			$filter.=" 指定新闻标题【".$_GET['subject'].'】';
		}
	}
	if($_GET['addbyname'])
	{
		$_GET['addbyname']=str_replace("%", "", $_GET['addbyname']);
		$_GET['addbyname']=str_replace("*", "", $_GET['addbyname']);
		$_GET['addbyname']=base_protect($_GET['addbyname']);
		$where.=' AND `addbyname` LIKE "%'.$_GET['addbyname'].'%"';
		$filter.=" 模糊查询编辑【".$_GET['addbyname'].'】';
		
	}
	if($_GET['orderby'])
	{
		$where.=' ORDER BY `'.$_GET['orderby'].'` ';
		if($_GET['desc'])
			$where.=' DESC';
	}

	//标示本页地址
	$baseurl='./?page='.$page.'&do='.$do
		.'&orderby='.$_GET['orderby'].'&desc='.$_GET['desc'];
	if($_GET['uid'])
		$baseurl.='&uid='.$_GET['uid'];
	if($_GET['nohide'])
		$baseurl.='&nohide=1';
	if($_GET['nodelete'])
		$baseurl.='&nodelete=1';
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
	$navidata=$dbv->getNaviData(table('news'),$where,$_GET['p']);
	$navidata['href']=$baseurl;
	// print_r($navi);
	$result=$dbv->sqlByPage(table('news'),$where,$_GET['p']);
	base_version(2.1);
	$list=$db->getRows($result);


	//特殊权限的检查
	//检查是否拥有获取文件源文件地址的权限
	$cangetorigin=auth_checkTF('manage',0,'ADMIN_FILE_GETORIGINPATH');

	load_model('user.func');
	foreach ($list as $i => $v) {
		if($_GET['addby'])
			$list[$i]['user']=$user;
		else
			$list[$i]['user']=user_getById($v['addby']);
		//防止新闻标题xss跨站注入攻击
		$list[$i]['subject']=base_escape($v['subject']);
	}
	// print_r($list);

	include $tpl->prepare('news_list');