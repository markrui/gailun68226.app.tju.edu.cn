<?php
	include_once(dirname(__FILE__).'/common.php');
	load_model('news.func');
	
	$page = base_nulltest($_GET['page']);
	$id = base_nulltest($_GET['id']);
	
	$table = $page;
	$title = getTitle($page);
	
	$p = $_GET['p'];
	if($p == ''){
		$p = 0;
	}
	    			
	$from = $table;
	$where = ' where 1 ORDER BY `date` DESC';
	$listArr = feature_listBypage($p,5,$from,$where);
	$list = $listArr['features'];
	$feature_navi = $listArr['feature_navi'];
	//include $tpl->prepare('theme/'.$page.'_list');
	include $tpl->prepare('news_list');
?>
	
	