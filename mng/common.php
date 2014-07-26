<?php
	define('ISDEBUG',1);
	define('IN_MNG',1);
	define('NEED_DBCONNECTION',1);
	
	date_default_timezone_set("Asia/Shanghai");
	header("Content-type: text/html; charset=utf-8");

	if(defined('ISDEBUG')&&!file_exists(dirname(__FILE__)."/../include/global.php"))
		die('未找到上级目录中的include文件夹，请保证相对位置中../include/global.php存在并且符合twt.baseframework结构');
	
	include(dirname(__FILE__)."/../include/global.php");	

	//模板初始化
	$tpl=new TemplateHelper(dirname(__FILE__).'/template',
		dirname(__FILE__).'/cache');
	//管理模板皮肤
	$tpl->theme('manage');
	//默认不自动加载模板缓存
	if(defined('ISDEBUG')&&ISDEBUG)
	{
		//测试模式不自动加载模板缓存
		$tpl->nocache(true);
	}

	$_TPL=array(
		'title'	=>	'网络课堂后台',
		'css'	=>	array('bootstrap','bootstrap-responsive','common'),
		'js'	=>	array('jquery','jquery.cookie','bootstrap','common'),
		'breadcrumb'	=>	array()
	);	

	if(defined('ISDEBUG')&&ISDEBUG)
		$_TPL['title']=$_TPL['title'];
	$_TPL['breadcrumb'][]=array('name'=>'站点','href'=>'../');
	
	$_TPL['breadcrumb'][]=array('name'=>'后台','href'=>'./');

	$inajax=isset($_GET['inajax']);

	@session_start();

	$db=new DataBase();
	//自动连接数据库
	$db->conn();
	if(defined('NEED_DBCONNECTION')&&NEED_DBCONNECTION&&
		!Database::isConnected())
	{
		$_TPL['hidemenu']=true;
		$debugadd='';
		if(defined('ISDEBUG')&&ISDEBUG)
		{
			$debugadd='<br/>'
				.'请编辑站点根目录下的config/config.inc.php设置正确的数据库参数'
				.'<br/>并于同目录config.main.php设置正确的表前缀fingerprint'
				.'<br/>需要创建数据库（默认名称twtframework）并运行初始化的SQL'
				.'<br/>默认的数据表构造SQL语句存储于config/init.sql内';
		}
		message('无法连接数据库'.$debugadd);
	}
	//数据库使用utf8编码，注意每个字段都要是utf8的编码，若使用navicat连接数据库，连接方式使用“数据库默认连接”
	//$db->sql('SET NAMES UTF8');
	base_version(2.3);
	//从2.3版本数据库开始，config.inc.php配置文件新增[database][charset]
	//用以让数据库自动执行 SET NAMES $IVPConfig['database']['charset']


	//Cookie托管
	$cookie=new CookieHelper();

	//需要引用标准框架(2012.11.22版本以上)的user.session.func.php文件
	base_version(2);
	load_model("user.session.func");
