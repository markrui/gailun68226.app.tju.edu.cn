<?php
	//用浏览器访问该文件可以对类库进行安装，程序员注意类库更新后对zip文件进行更新
	define(_ROOT,dirname(__FILE__));

	function test_install(){
		// echo _ROOT.'/../global.inc.php ';
		// echo file_exists(_ROOT.'/../global.inc.php')?'exists':'not exists';
		if(file_exists(_ROOT.'/../global.inc.php'))
		{
			include(_ROOT.'/../global.inc.php');
			die('<span style="color:green">安装成功，当前版本'.CTPVersion.'，更新于'.CTPUpdateAt.'</a>');
		}
		return false;
	}

	date_default_timezone_set("Asia/Shanghai");
	header("Content-type: text/html; charset=utf-8");

	test_install();

	$path=_ROOT.'/latest_version.zip';

	$package = new ZipArchive();
	if(!$package->open($path))
		die('未找到latest_version.tar.gz文件');
	$package->extractTo(_ROOT.'/../');

	echo '解压缩安装完毕<br/>';
	if(!test_install())
		die('<a style="color:red">测试失败</a>');