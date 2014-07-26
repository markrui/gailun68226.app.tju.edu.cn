<?php
	include(dirname(__FILE__).'/../common.php');

	//在action/model新增模块后应该在$mods变量增加新的模块名
	$mods=array('testmod');

	$kv=array(
		'flag'		=> 0,
		'report'	=> array()
	);
	$repo=array();
	$_GET['mod']=base_nulltest($_GET['mod']);
	//mod数组，若传参mod不在该数组中则弹出错误
	if(!in_array($_GET['mod'],$mods))
		$repo[]='mod miss';	
	else
	{
		$kv['mod']=$_GET['mod'];
		include(dirname(__FILE__).'/model/'.$_GET['mod'].'.php');
	}
	//echo 'out';
	$kv['report']=$repo;
	//header('Content-type:text/json');
	if(isset($_GET['silent']))
	{
		exit;
	}
	echo json_encode($kv);
?>