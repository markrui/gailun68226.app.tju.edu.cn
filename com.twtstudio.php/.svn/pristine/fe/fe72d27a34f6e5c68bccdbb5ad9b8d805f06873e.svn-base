<?php
	load_model('news.func');
	
	$index=(int)base_nulltest($_GET['index']);

	if($_POST)
	{
		$index=(int)base_nulltest($_POST['index']);
		$isinsert=false;
		if(!$index)
			$isinsert=true;

		$setarr=array(
			'subject'	=>	base_nulltest($_POST['subject']),
			'content'	=>	base_nulltest($_POST['content']),
			'addbyname'	=>	base_nulltest($_POST['addbyname']),
			'visitcount'	=>	(int)base_nulltest($_POST['visitcount'],0),
			'istop'		=>	$_POST['istop']?1:0,
			'ishide'		=>	$_POST['ishide']?1:0,
			'isdelete'		=>	$_POST['isdelete']?1:0
		);

		$addat=date('Y-m-d H:i:s',
			$_POST['addat']?strtotime($_POST['addat']):time());

		if($isinsert)
		{
			$setarr['addby']=$_SESSION['twt_uid'];
		}

		if($isinsert)
			$flag=news_insert($setarr);
		else
			$flag=news_update($setarr,$index);

		if($flag)
			message('成功','新闻提交','./?page=news&do=list&index='.$flag);
		else
			message('遇到了一个错误','新闻提交');
	}

	if($index)
		$news=news_getById($index);

	if(!$news)
		message('编辑新闻未找到');

	include $tpl->prepare('news_edit');
