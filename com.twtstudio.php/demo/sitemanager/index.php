<?php
//框架的用户入口页面大致由以下代码组成

//第一部分	引用站点的共有文件common.php	
//			在该文件中调用了com.twtstudio.php的基础类库，对数据库等进行了实例化
//			以及对用户的天外天账号登录情况进行了检查
	include_once(dirname(__FILE__).'/common.php');
//第一部分	结束

//第二部分	对本页面需要引用的特殊代码进行模块载入
//			可以用load_model函数进行代码的载入，代码存储于include/model下
	//样例代码
	load_model('sample.func');
	//载入额外的配置文件
	load_model('config/sample.config');


//第二部分	结束

//第三部分	对本页面进行权限检查
//			如果这是一个需要登录后才能查看的页面，可以把逻辑代码加于此处
//			常用做法是调用include/model/base.func.php中的以下函数
//			function need_login() //请于base.func.php中查看该函数的声明
	//need_login();
//			如果这是一个需要特殊权限才能查看的页面，可以使用
//			include/model/auth.func.php中的auth_need()函数做阻断检查
	//load_model('auth.func');
	//auth_need('home',0,'NOTGUEST');
//第三部分	结束

//第四部分	页面的业务逻辑
	$a=(int)base_nulltest($_GET['a']);
	$b=(int)base_nulltest($_GET['b']);
	$sum=$a+$b;
//第四部分	结束


//第五部分	载入V层进行页面展现
	include $tpl->prepare('index');

//			若要载入自己的皮肤 用以下代码
	//include $tpl->prepare('theme/index');
//第五部分	结束