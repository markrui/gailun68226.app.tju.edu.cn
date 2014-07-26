<?php
header('Content-Type: text/html; charset=utf-8');

require_once('functions.php');
$_TPL['title'] = '配置文件';

$filename = dirname(__FILE__).'/data/data.config.txt';
$content = read_file($filename);
$arr = unserialize($content);

$_TABLE = $arr['table'];
$_DATA = $arr['data'];

require_once('tpl.php');
?>