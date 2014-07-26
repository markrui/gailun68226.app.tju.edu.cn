<?php
	if(isset($_POST['method']))
	{
		function calcsize($path,$preg=false) {
			if(is_file($path))
			{
				if(!$preg||preg_match($preg, $file))
					return filesize($path);
				else
					return 0;
			}
			$sum=0;
			$path.='/';
			$handle=file_exists($path)?opendir($path):false;
			while ($handle&&$file = readdir($handle)) 
			{
				if ($file != "." && $file != "..") {
					if(!$preg||preg_match($preg, $file))
						$sum+=calcsize($path.$file);
				}
			}
			return $sum;
		}

		switch($_POST['method'])
		{
			case 'gettplsize':
				$size=calcsize(dirname(__FILE__).'/../../cache','/.*?.t.php/')/1024;
				echo prettySize($size);
				exit;
				break;
			case 'cleartpl':
				$tpl=new TemplateHelper(dirname(__FILE__).'/../../template',dirname(__FILE__).'/../../cache');
	
				$tpl->clearcache();
				$tpl=new TemplateHelper(dirname(__FILE__).'/../template',dirname(__FILE__).'/../cache');
				message('主站模板已被清空');
				break;
			case 'getmngtplsize':
				$size=calcsize(dirname(__FILE__).'/../cache','/.*?.t.php/')/1024;
				echo prettySize($size);
				exit;
				break;
			case 'clearmngtpl':
				$tpl->clearcache();
				message('管理站模板已被清空');
				break;
			case 'getpreviewsize':
				$size=calcsize(dirname(__FILE__).'/../../cache/preview')/1024;
				echo prettySize($size);
				exit;
				break;
			case 'clearpreview':
				function deletedir($path) {
					if(is_file($path))
					{
						unlink($path);
						return;
					}
					$path.='/';
					$handle=file_exists($path)?opendir($path):false;
					while ($handle&&$file = readdir($handle)) 
					{
						if ($file != "." && $file != "..") {
							// echo $path.$file.'<br/>';
							if (is_file($path.$file)) 
								unlink($path.$file); //是文件删除文件
							else if (is_dir($path.$file))
							{
								deletedir($path.$file);
							}
						}
					}
					closedir($handle);
					rmdir($path);
				}
				deletedir(dirname(__FILE__).'/../../cache/preview');
				message('文档预览缓存已被清空');
				break;
		}
	}
	include $tpl->prepare('system_cache');