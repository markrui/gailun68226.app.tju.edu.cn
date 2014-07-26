<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title><?php if($_TPL['title']) { echo $_TPL['title'].' - '; }?>天外天PHP类库文档编辑</title>
		<link rel="stylesheet" href="assets/style.css" type="text/css" media="all" />
	</head>
	<body>
	<h1>天外天PHP类库文档编辑</h1>
	<div class="wrap clearfix">
		<div class="list">
<h2>索引</h2>
			<ul>
                <li>
					<a href="config">配置文件</a>
				</li>
				<li>
					<a href="others">其他</a>
				</li>
            <ul>
		</div>
		<div class="toc">
<h2>目录</h2>
<ul>
<?php
	foreach($_TABLE as $key => $value) {
		$lis = sort_table($key, $value, '');
		echo $lis;
	}
	?>
</ul>
		</div>
		<div class="edit">
			<form action="save.php" method="post">
				<h2><?php echo $path;?></h2>
				<p><label>显示标题：</label><input type="text" size="30" name="displayname" value="<?php echo $_DATA['displayname']; ?>" /></p>
				<p><label>内容：</label></p>
				<textarea name="content" cols="70" rows="25"><?php echo $_DATA['content']; ?></textarea>
				<button type="submit">提交修改</button>
			</form>
			
		</div>
	</div>
	</body>
</html>