<?php
	include_once(dirname(__FILE__).'/common.php');
	load_model('news.func');
	
	$page = base_nulltest($_GET['page']);
	$id = base_nulltest($_GET['id']);
	
	$table = $page;
	$news = news_getById($id, $table);
	$title = getTitle($page);
	echo "<script> var content = '" . str_replace(array("\n","\r"), array("",""), $news['content']) . "'; </script>";

	include $tpl->prepare('news_detail');
?>