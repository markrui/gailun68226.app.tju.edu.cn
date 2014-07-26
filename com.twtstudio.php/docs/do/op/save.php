<?php
header('Content-Type: text/html; charset=utf-8');

require_once (dirname(__FILE__) . '/config.php');
require_once (INCPATH . 'include.php');

$content = $_POST['content'];
$content = ubbtohtml($content);
$content = str_replace(array('"', "'", '$'), array('\"', "\'", '\$'), $content);


date_default_timezone_set('Asia/Chongqing');
$timeline = date("Y-m-d H:i:s");

$postarr = array(
	'path'			=>	'config',
	'name'			=>	'config',
	'displayname'	=>	'配置文件',
	'content'		=>	$content,
	'lastupdate'	=>	$timeline,
	'editor'		=>	'kafeill',
	'status'		=>	'ok'
);

$colsql = "(`".implode("`,`", array_keys($postarr))."`)";
$valsql = "('".implode("','", array_values($postarr))."')";

//debug_array($content);

$sql = "INSERT INTO `data` $colsql VALUES $valsql";

$query = mysql_query($sql, $conn);

$inser_id = mysql_insert_id($conn);

die(mysql_error());

?>