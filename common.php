<?php
	define('ISDEBUG',1);
	date_default_timezone_set("Asia/Shanghai");
	header("Content-type: text/html; charset=utf-8");
	include(dirname(__FILE__)."/include/global.php");	
	
	//请于config/config.inc.php修改类库默认的数据库连接信息
	$db=new DataBase();
	$db->conn();
	
	//数据库使用utf8编码，注意每个字段都要是utf8的编码，若使用navicat连接数据库，连接方式使用“数据库默认连接”
	//$db->sql('SET NAMES UTF8');
	base_version(2.3);
	//从2.3版本数据库开始，config.inc.php配置文件新增[database][charset]
	//用以让数据库自动执行 SET NAMES $IVPConfig['database']['charset']

	//模板初始化
	$tpl=new TemplateHelper(dirname(__FILE__).'/template',dirname(__FILE__).'/cache');
	if(defined('ISDEBUG')&&ISDEBUG)
	{
		//测试模式不自动加载模板缓存
		$tpl->nocache(true);
	}
//	$_TPL=array(
//		'title'	=>	'',
//		'css'	=>	array('global'),
//		'js'	=>	array('jquery','common'),
//	);


?>