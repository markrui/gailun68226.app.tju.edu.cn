<?php $_TPL['js'][]='ckeditor/ckeditor' ?>
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
<li <?=$nav['zcwj']?>>
<a>政策文件</a>
<ul class="nav nav-tabs nav-stacked">
<li <?=$nav['zcwj_list']?>><a href="./?page=zcwj&do=list&desc=1">政策文件列表</a></li>
<li <?=$nav['zcwj_add']?>><a href="./?page=zcwj&do=add">添加政策文件</a></li>
</ul>
</li>
<li <?=$nav['jxdg']?>>
<a>教学大纲</a>
<ul class="nav nav-tabs nav-stacked">
<li <?=$nav['jxdg_list']?>><a href="./?page=jxdg&do=list&desc=1">教学大纲列表</a></li>
<li <?=$nav['jxdg_add']?>><a href="./?page=jxdg&do=add">添加教学大纲</a></li>
</ul>
</li>
<li <?=$nav['skja']?>>
<a>授课教案</a>
<ul class="nav nav-tabs nav-stacked">
<li <?=$nav['skja_list']?>><a href="./?page=skja&do=list&desc=1">授课教案列表</a></li>
<li <?=$nav['skja_add']?>><a href="./?page=skja&do=add">添加授课教案</a></li>
</ul>
</li>
<li <?=$nav['wsdy']?>>
<a>网上答疑</a>
<ul class="nav nav-tabs nav-stacked">
<li <?=$nav['wsdy_list']?>><a href="./?page=wsdy&do=list&desc=1">网上答疑列表</a></li>
<li <?=$nav['wsdy_add']?>><a href="./?page=wsdy&do=add">添加网上答疑</a></li>
</ul>
</li>
<li <?=$nav['xtjd']?>>
<a>习题解答</a>
<ul class="nav nav-tabs nav-stacked">
<li <?=$nav['xtjd_list']?>><a href="./?page=xtjd&do=list&desc=1">习题解答列表</a></li>
<li <?=$nav['xtjd_add']?>><a href="./?page=xtjd&do=add">添加习题解答</a></li>
</ul>
</li>
<!--li <?=$nav['zlhb']?>>
<a>资料汇编</a>
<ul class="nav nav-tabs nav-stacked">
<li <?=$nav['zlhb_list']?>><a href="./?page=zlhb&do=list&desc=1">资料汇编列表</a></li>
<li <?=$nav['zlhb_add']?>><a href="./?page=zlhb&do=add">添加资料汇编</a></li>
</ul>
</li-->
<li <?=$nav['wsjz']?>>
<a>网上讲座</a>
<ul class="nav nav-tabs nav-stacked">
<li <?=$nav['wsjz_list']?>><a href="./?page=wsjz&do=list&desc=1">网上讲座列表</a></li>
<li <?=$nav['wsjz_add']?>><a href="./?page=wsjz&do=add">添加网上讲座</a></li>
</ul>
</li>
<li <?=$nav['xxck']?>>
<a>学习参考</a>
<ul class="nav nav-tabs nav-stacked">
<li <?=$nav['xxck_list']?>><a href="./?page=xxck&do=list&desc=1">学习参考列表</a></li>
<li <?=$nav['xxck_add']?>><a href="./?page=xxck&do=add">添加学习参考</a></li>
</ul>
</li>
<li <?=$nav['tlsj']?>>
<a>讨论瞬间</a>
<ul class="nav nav-tabs nav-stacked">
<li <?=$nav['tlsj_list']?>><a href="./?page=tlsj&do=list&desc=1">讨论瞬间列表</a></li>
<li <?=$nav['tlsj_add']?>><a href="./?page=tlsj&do=add">添加讨论瞬间</a></li>
</ul>
</li>
<li <?=$nav['sjjy']?>>
<a>实践剪影</a>
<ul class="nav nav-tabs nav-stacked">
<li <?=$nav['sjjy_list']?>><a href="./?page=sjjy&do=list&desc=1">实践剪影列表</a></li>
<li <?=$nav['sjjy_add']?>><a href="./?page=sjjy&do=add">添加实践剪影</a></li>
</ul>
</li>
<li <?=$nav['zyzs']?>>
<a>作业展示</a>
<ul class="nav nav-tabs nav-stacked">
<li <?=$nav['zyzs_list']?>><a href="./?page=zyzs&do=list&desc=1">作业展示列表</a></li>
<li <?=$nav['zyzs_add']?>><a href="./?page=zyzs&do=add">添加作业展示</a></li>
</ul>
</li>
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
<script type="text/javascript" src="js/Base64Code.js"></script>
<script type="text/javascript" src="js/Base64-80.js"></script>
<script type="text/javascript">
<!--
function post(URL, PARAMS) {      
    var temp = document.createElement("form");      
    temp.action = URL;      
    temp.method = "post";      
    temp.style.display = "none";      
    for (var x in PARAMS) {      
        var opt = document.createElement("textarea");      
        opt.name = x;      
        opt.value = PARAMS[x];      
        // alert(opt.name)      
        temp.appendChild(opt);      
    }      
    document.body.appendChild(temp);      
    temp.submit();      
    return temp;
}

function encodeContent(){
CKEDITOR.tools.callFunction(7,event);
var sourceCode = document.getElementsByClassName("cke_source");
var content = document.getElementsByName("content");
content.item(0).value = encodeBase64(encodeURI(sourceCode.item(0).value));

var title = document.getElementsByName("title");
title.item(0).value = encodeBase64(encodeURI(title.item(0).value));

var index = document.getElementsByName("index").item(0).value;

post('./?page=<?=$page?>&do=edit', {"index": index, "content" :content.item(0).value,"title":title.item(0).value});
}  
     
//调用方法 如      
//-->
</script>

<div class="page-header" id="filesummary">
<h3><?=$pagetitle?>新闻</h3>
</div>
<form class="form-horizontal" method="post"
action="./?page=<?=$page?>&do=edit">
<div class="control-group">
<label class="control-label" >新闻标题</label>
<div class="controls">
<input type="text" name="title" class="span6" placeholder="新闻标题" value="<?=$news['title']?>">
</div>
</div>
<div class="control-group">
<label class="control-label" >正文</label>
<div class="controls">
<div class="span11">
<textarea id="CKEDITOR_content" name="content"><?=$news['content']?></textarea>
</div>
</div>
</div>
<div class="control-group">
<div class="controls">
<input type="hidden" name="index" value="<?=$news['id']?>" />
<input type="button" class="btn" value="提交" onclick="encodeContent()">
</div>
</div>
</form>
<script type="text/javascript">
 CKEDITOR.replace('content',{
       filebrowserBrowseUrl : 'ckeditor/ckfinder/ckfinder.html',
       filebrowserImageBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?Type=Images',
       filebrowserFlashBrowseUrl : 'ckeditor/ckfinder/ckfinder.html?Type=Flash',
       filebrowserUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
       filebrowserImageUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
       filebrowserFlashUploadUrl : 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
     });
</script>