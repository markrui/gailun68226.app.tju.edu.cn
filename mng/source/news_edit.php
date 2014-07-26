<?php
	load_model('news.func');
	
	$index=(int)base_nulltest($_GET['id']);
	$page = base_nulltest($_GET['page']);
	$table = $page;
	if($_POST)
	{
		$index=(int)base_nulltest($_POST['index']);
		$isinsert=false;
		if(!$index)
			$isinsert=true;

		$date = date('Y-m-d', time());
		$setarr=array(
			'content'	=>	base_nulltest(urldecode(base64_decode($_POST['content']))),
			'title'		=>	base_nulltest(urldecode(base64_decode($_POST['title']))),
			'date'		=>	$date
		);
		
		if($isinsert)
			$flag=news_insert($setarr, $table);
		else
			$flag=news_update($setarr,$index,$table);

		if($flag)
			message('成功','新闻提交','./?page='.$page.'&do=list&id='.$flag);
		else
			message('遇到了一个错误','新闻提交','./?page='.$page.'&do=edit&id='.$flag);
	}
	if($index)
		$news=news_getById($index,$table);

	if(!$news)
		message('编辑新闻未找到');

	include $tpl->prepare('news_edit');
