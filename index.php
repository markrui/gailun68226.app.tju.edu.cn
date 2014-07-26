<?php
	include_once(dirname(__FILE__).'/common.php');
	
	$page = base_nulltest($_GET['page'],index);
	
	if($page == 'index'){
		$path = dirname(__FILE__).'/action/'.$page.'.php';
	}
	else{
		if( isset($_GET['id']) )
			$do = 'detail';
		else 
			$do = 'list';
			
		$path = dirname(__FILE__).'/action/news_'.$do.'.php';
	}
	
	include($path);
?>