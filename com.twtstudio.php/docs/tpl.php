<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title><?php if($_TPL['title']) { echo $_TPL['title'].' - '; }?>天外天PHP类库文档</title>
		<link rel="stylesheet" href="assets/style.css" type="text/css" media="all" />
		<link rel="stylesheet" href="assets/sh.css" type="text/css" media="all"/>
	</head>
	<body>
		<div id="container">
			<div id="header">
				<h1>天外天PHP类库文档</h1>
				<div id="gtoc">
					<p>
						<a href="index.html">索引</a> | <a href="all.html">所有项</a>
					</p>
				</div>
				<hr />
			</div>
			<div id="toc">
				<h2>目录</h2>
				<ul>
				<?php
					foreach($_TABLE as $key => $value) {
						$lis = sort_table($key, $value);
						echo $lis;
					}
				?>
				</ul>
				<hr />
			</div>
		<?php
			foreach($_DATA as $key => $value) {
				$h_num = count(explode('.', $key)) + 1;
				$content = "<h{$h_num} id=\"{$key}\">{$value[name]}";
				if($h_num > 2) {
					$content .= "<a href=\"#{$key}\">#</a>";
				}
				$content .= "</h{$h_num}>";
				$content .= $value['content'];
				echo $content;
			}
		?>
		</div>
		<script type="text/javascript" src="assets/init.js"></script>
	</body>
</html>