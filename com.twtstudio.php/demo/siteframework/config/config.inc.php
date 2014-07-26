<?php
	$IVPConfig= array (
		'version'		=>	'1.1',
		'lastupdate'	=>	'2011-08-26',
		'database'		=>	array(
			'host'		=>	'202.113.13.180',
			'host'		=>	'localhost',
			'dbname'	=>	'viila_product',
			'dbuser'	=>	'viila_product',
			'dbpassword'=>	'',
			'charset'	=>	'UTF8'
		),
		'cookie'		=>	array(
			'prefix'	=>	'F_',
			'hashfix'	=>	'F@2012',
			'duration'	=>	24*3600
		),
		'basedatabase'	=>	array(
			'log'		=>	'_log',
			'record'	=>	'_record',
			'lock'		=>	'_lock'
		),
		'basedbconfig'	=>	array(
			'lockdomain'=>	"2012FRAMEWORK"
		),
		'addons'		=>	array(
			'json'		=>	false,
			'httpdown'	=>	false,
			'id3tagreader'	=>	false,
			'pagehelper'	=>	false,
			'twtapi'	=>	true,
		),
		'cacheswitch'	=>	false,
	);
?>