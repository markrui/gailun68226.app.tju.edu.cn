<?php
	$IVPConfig= array (
		'version'		=>	'1.1',
		'lastupdate'	=>	'2013-05-01',
		'database'		=>	array(
			'host'		=>	'localhost',
			'dbname'	=>	'gailun',
			'dbuser'	=>	'root',
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
		'cacheswitch'	=>	false,
	);
?>