<?php
	include_once(dirname(__FILE__).'/common.php');
	load_model('news.func');

	$jxdg = news_indexShow('jxdg', 5);
	$skja = news_indexShow('skja', 5);
	$zcwj = news_indexShow('zcwj', 5);
	$wsdy = news_indexShow('wsdy', 5);
	$xtjd = news_indexShow('xtjd', 5);
	//$zlhb = news_indexShow('zlhb', 5);
	$xxck = news_indexShow('xxck', 5);
	$wsjz = news_indexShow('wsjz', 5);
	$tlsj = news_indexShow('tlsj', 5);
	$sjjy = news_indexShow('sjjy', 5);
	$zyzs = news_indexShow('zyzs', 5);
	
	include $tpl->prepare('index');
?>