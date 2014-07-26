<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title><?=$_TPL['title']?></title>
<?php if(!empty($_TPL['css'])) { ?>
<?php if(!is_array($_TPL['css']))$_TPL['css']=array($_TPL['css']); ?>
<?php if(is_array($_TPL['css'])) { foreach($_TPL['css'] as $k => $v) { ?>
<link href="css/<?=$v?>.css" rel="stylesheet" type="text/css" />
<?php } } ?>
<?php } ?>
<?php if(!empty($_TPL['js'])) { ?>
<?php if(!is_array($_TPL['js']))$_TPL['js']=array($_TPL['js']); ?>
<?php if(is_array($_TPL['js'])) { foreach($_TPL['js'] as $k => $v) { ?>
<script src="js/<?=$v?>.js" type="text/javascript"></script>
<?php } } ?>
<?php } ?>
</head>

<body>

<div style="background-color:#77f;color:#fff;margin-bottom:5px">
<div class="container" style="padding:5px;overflow:hidden">
<h1 style="float:left">天外天工作室站点标准框架</h1>
<div style="float:right">
<?php if(user_isLogin()) { ?>
<?=$_SESSION['realname']?>已登陆，
<a style="color:#fff" href="http://www.twt.edu.cn/account/logout">登出</a>
<?php } else { ?>
尚未登录，请转向
<a style="color:#fff" href="http://www.twt.edu.cn/account">账号中心登陆</a>
<?php } ?>
</div>
</div>
</div>
<div class="container" style="min-height:500px">
<form method="get" action="./"
style="magin:20px;border:1px solid #eee;padding:10px">
<p>A+B</p>
<input type="text" name="a" value="<?=$a?>" /> 
+ 
<input type="text" name="b" value="<?=$b?>" /> 
= <?=$sum?>;
<input type="submit"/>
</form>
</div>
<div style="background-color:#eee;color:#bbb;margin-top:5px">
<div class="container" style="padding:5px;font-size:12px">
<a href="http://www.twt.edu.cn/join" style="color:#bbb">加 入 我 们</a> 
|
<a href="http://www.twt.edu.cn" style="color:#bbb">天 外 天</a>
<p>
<b>TWT Site Framework </b>
powered by 天外天工作室 Copyright©2012 TWTStudio. All 
rights reserved.</p>
</div>
</div>
</body>
</html>
