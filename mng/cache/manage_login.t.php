<?php if(!$inajax) { ?>
<!DOCTYPE html>
<html lang="zh-cn">
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
<header class="navbar <?php echo defined('ISDEBUG')&&ISDEBUG?'debug':''; ?>" >
<div class="navbar-inner">
<div class="container-fluid">
<a class="brand" href="./"><span><?=$_TPL['title']?></span></a>

<!-- user dropdown starts -->
<div class="btn-group pull-right" >
<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
<i class="icon-user"></i>
<span class="hidden-phone"> 
<?php if($_SESSION['islogin']) { ?>
欢迎你，<?=$_SESSION['username']?>
<?php } else { ?>
需要登录
<?php } ?>
</span>
<span class="caret"></span>
</a>
<ul class="dropdown-menu">
<?php if($_SESSION['islogin']) { ?>
<li><a href="./?do=logout">安全退出</a></li>
<?php } else { ?>
<li>请先登录</li>
<?php } ?>
</ul>
</div>
<!-- user dropdown ends -->

<div class="top-nav nav-collapse">
<ul class="nav">
<li><a href="../">访问所管理网站</a></li>
</ul>
</div><!--/.nav-collapse -->
</div>
</div>
</header>
<?php } ?>
<div class="row-fluid">
<div class="hero-unit span8 offset2">
<div class="row-fluid">
<div class="span6">
<h2>后台登录<br/><small><?=$_TPL['title']?></small></h2>
</div>
<form class="span5 offset1" method="post" 
action="login.php"
autocomplete="off" spellcheck="false">
<fieldset>
<label>用户名</label>
<input name="username" type="text" placeholder="Username">
<label>密码</label>
<input name="password" type="password" placeholder="Password">
<label></label>
<input type="hidden" name="referer" 
value="<?=$referer?>" /> 
<button type="submit" class="btn btn-medium btn-danger">
<i class="icon-chevron-right icon-white"></i>
登录
</button>
</fieldset>
</form>	
</div>
</div>
</div>
<?php if(!$inajax) { ?>
<?php if($_TPL['hasmenu']) { ?>
</div>
</div>
<?php } ?>
<div class='row-fluid'>
</footer>
</div>
<?php } ?>