<?php
header('Content-Type: text/html; charset=utf-8');

require_once (dirname(__FILE__) . '/config.php');
require_once (INCPATH . 'include.php');

if ($_GET['name']) {
	$path = $_GET['name'];
}

//二级列出目录
$root = explode('.', $path);
$root = $root[0];
$query = mysql_query("SELECT * FROM `table` WHERE `name` = '$root' LIMIT 1");
$result = mysql_fetch_array($query);
if (mysql_error()) {
	die(mysql_error());
} else {
	if (empty($result)) {
		die('无此路径');
	}
}
$result = unserialize($result['list']);
$_TABLE = $result['table'];
$_HASH = $result['hash'];

//读取内容
$query = mysql_query("SELECT * FROM `data` WHERE `name` = '$path' LIMIT 1");

$result = mysql_fetch_array($query);
$_DATA = $result;

require_once (dirname(__FILE__) . '/tpl.php');
?>