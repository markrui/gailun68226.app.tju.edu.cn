<?php
	define('ISDEBUG',1);
	//引用配置文件
	include(dirname(__FILE__)."/config.inc.php");
	//引用类库
	include(dirname(__FILE__).'/../com.twtstudio.php/global.inc.php');
	
	//实例化模板引擎
	$tpl=new TemplateHelper(dirname(__FILE__).'/template',dirname(__FILE__).'/cache');
	
	//模板引擎不优先读取缓存
	$tpl->nocache(true);
	
	//在一般情况下通过include $tpl->prepare 加载的模板可以调用php页面内全部的变量
	//但一些特殊情况比如页面标题，可能是由common.php等页面定义
	//并且在方法内进行模板调用 比如 message('弹出消息页')
	//在方法内调用的变量如果未经过global关键字处理，是无法调用到外部的变量，这时候就需要约定一个公用变量
	//在siteframework等站点的base.func.php内message函数的生命中
	//一般有以下 global $tpl,$_TPL 进行 变量上下文的继承，所以一般考虑把数据存储于$_TPL
	//当然可以依据自己的喜好选择存储的方式
	$_TPL=array();
	
	//模拟从数据库查出list
	$_TPL['album']=array(
		'title'	=>	'专辑名称',
		'list'	=>	array(
						123123	=>	'第一首歌',
						908234	=>	'第二首歌',
						123490	=>	'第三首歌'
					)
	);
	
	//模拟额外增加一个list项
	$_TPL['album']['list'][7788]='新的歌曲';

	//执行模板渲染
	include $tpl->prepare('album');
?>