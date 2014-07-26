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
<?php if($_SESSION['twt_uid']) { ?>
欢迎你，<?=$_SESSION['realname']?>
<?php } else { ?>
需要登录
<?php } ?>
</span>
<span class="caret"></span>
</a>
<ul class="dropdown-menu">
<?php if($_SESSION['twt_uid']) { ?>
<li><a href="./?page=user&do=logout">安全退出</a></li>
<?php } else { ?>
<li><a href="http://www.twt.edu.cn/account">去账号中心登录</a></li>
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
<?php if(0){
/*	************* 注释 *************
	关于menu.htm的介绍
	menu.htm为后台mng管理页面的左侧菜单，
	当需要新增菜单项的时候，直接在此处添加对应的dom即可
	menu.htm遵循sitemanager框架的index.php->source/*载入结构
	即 $page->$do 结构
	会通过$nav[$page_$do]自动激活菜单的active属性

	一般情况
	当需要增加一个 page:functionA 的 do:method1 时，对应需要操作

	1.在source/文件夹下创建 {functionA}_{method1}.php
	2.在menu.htm的ui#sidenav下创建新的li
		<li $nav[functionA]>
			<a>functionA</a>
			<ul class="nav nav-tabs nav-stacked">
				<li $nav[functionA_method1]>
					<a href="./?page=functionA&do=method1">
					method1
					</a>
				</li>
			</ul>
		</li>
	:修改	行15的 $nav[*] 			用以标示functionA菜单的展开
			行16的 功能名<a>*</a> 	functionA菜单显示名称
			行18的 $nav[*_*] 		用以标示method1子菜单的展开
			行19 href="./?page=*&do=*"	用以定位到method
			行20 *					method1方法名
	3.修改{functionA}_{method1}.php下的访问权限，一般使用
		load_model('auth.func')
		auth_need('manage',0,'FUNCTIONA_METHOD1');作为标示
	4.调试


	*不会载入的情况
	1. $inajax 当页面有 $_GET['inajax']=1 的标记时不会载入
	2. $_TPL['hidemenu'] 当手动设置 $_TPL['hidemenu']=true 时不会载入
*/	
} ?>
<?php if(!$inajax&&!$_TPL['hidemenu']) { ?>
<?php $_TPL['hasmenu']=1; ?>
<div class="row-fluid">
<div class="span2"><?php global $nav; ?>
<ul id="sidenav" class="nav nav-pills nav-stacked">
<li <?=$nav['index']?>>
<a href="./?page=index">运行概况</a>
</li>
<li <?=$nav['news']?>>
<a>新闻管理</a>
<ul class="nav nav-tabs nav-stacked">
<li <?=$nav['news_list']?>><a href="./?page=news&do=list&orderby=addat&desc=1">新闻列表</a></li>
<li <?=$nav['news_add']?>><a href="./?page=news&do=add">发布新闻</a></li>
<li <?=$nav['news_find']?>><a href="./?page=news&do=find">查找新闻</a></li>
<li <?=$nav['news_finduser']?>><a href="./?page=news&do=finduser">查找发布人</a></li>
</ul>
</li>
<li <?=$nav['upload']?>>
<a>上传管理(未完成)</a>
<ul class="nav nav-tabs nav-stacked">
<li <?=$nav['upload_summary']?>><a href="./?page=upload&do=summary">概况</a></li>
<li <?=$nav['upload_list']?>><a href="./?page=upload&do=list">管理文件</a></li>
<li <?=$nav['upload_add']?>><a href="./?page=upload&do=add">上传文件</a></li>
<li <?=$nav['upload_find']?>><a href="./?page=upload&do=find">查找文件</a></li>
</ul>
</li>
<li <?=$nav['system']?>>
<a>系统管理</a>
<ul class="nav nav-tabs nav-stacked">
<li <?=$nav['system_cache']?>>
<a href="./?page=system&do=cache">缓存</a>
</li>
</ul>
</li>
<li <?=$nav['user']?>>
<a >用户管理</a>
<ul class="nav nav-tabs nav-stacked">
<li <?=$nav['user_list']?>>
<a href="./?page=user&do=list">全部用户</a>
</li>
<li <?=$nav['user_grantadmin']?>>
<a href="./?page=user&do=grantadmin">管理员</a>
</li>
<li <?=$nav['user_find']?>>
<a href="./?page=user&do=find">查找用户</a>
</li>
</ul>
</li>
<?php if($canmenuauth) { ?>
<li <?=$nav['auth']?>>
<a >权限管理</a>
<ul class="nav nav-tabs nav-stacked">
<li <?=$nav['auth_list']?>>
<a href="./?page=auth&do=list">权限列表</a>
</li>
<li <?=$nav['auth_grant']?>>
<a href="./?page=auth&do=grant">赋予权限</a>
</li>
<li <?=$nav['auth_find']?>>
<a href="./?page=auth&do=find">查找权限</a>
</li>
</ul>
</li>
<?php } ?>
</ul>

</div>
<div class="span10">
<ul class="breadcrumb">
<?php if(is_array($_TPL['breadcrumb'])) { foreach($_TPL['breadcrumb'] as $i => $v) { ?>
<li>
<?php if(is_array($v)) { ?>
<a href="<?=$v['href']?>"><?=$v['name']?></a> 
<?php } else { ?>
<a href="#"><?=$v?></a> 
<?php } ?>
<?php if(count($_TPL['breadcrumb'])!=$i+1) { ?>
<span class="divider">/</span>
<?php } ?>
</li>
<?php } } ?>
</ul>
<?php } ?>
<div class="row-fluid">
<div class="hero-unit offset1 span10">
<h2><?=$title?></h2>
<p><?=$message?></p>
<p class="center">
<a href="<?=$href?>" class="btn btn-large btn-primary"><i class="icon-chevron-right icon-white"></i>继续</a> 
</p>
<div class="clearfix"></div>
</div>
</div>
<?php if(!$inajax) { ?>
<?php if($_TPL['hasmenu']) { ?>
</div>
</div>
<?php } ?>
<div class='row-fluid'>
<footer class='span12'>
<p class="pull-left">&copy; <a href="http://www.twt.edu.cn" target="_blank">TWTStudio</a> 2012</p>
<p class="pull-right">Powered by: <a href="http://www.viila.info">Viila</a></p>
</footer>
</div>
<?php } ?>