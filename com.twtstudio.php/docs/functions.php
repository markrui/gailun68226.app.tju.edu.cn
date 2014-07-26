<?php
function sort_table($key, $value, $prefix = '#', $intro = '') {
	global $_HASH;
	$tmp = '<li>';
	$tmp .= "<a href=\"{$prefix}{$key}\">{$_HASH[$key]}</a>";
	if (is_array($value)) {
		$tmp .= '<ul>';
		foreach ($value as $k => $v) {
			$tmp .= sort_table($key . '.' . $k, $v, $prefix, $intro);
		}
		$tmp .= '</ul>';
	}
	$tmp .= '</li>';
	return $tmp;
}

function write_file($filename, $writetext) {
	$pathinfo = pathinfo($filename);
	$name = 'data/' . $pathinfo['basename'];
	if (@$fp = fopen($filename, 'w')) {
		flock($fp, 2);
		fwrite($fp, $writetext);
		fclose($fp);
		echo $name . '写入成功<br>';
	} else {
		die($name . '写入失败，请检查data文件夹的写入权限');
	}
}

function read_file($filename) {
	if (function_exists('file_get_contents')) {
		@$content = file_get_contents($filename);
	} else {
		if (@$fp = fopen($filename, 'r')) {
			@$content = fread($fp, filesize($filename));
			@fclose($fp);
		}
	}
	return $content;
}

function htmltoubb($content) {

	$content = preg_replace("/<p>|<\/p>/", "\r\n", $content);
	$content = preg_replace("/(\r?\n)+/", "\r\n", $content);
	$content = preg_replace("/<pre>\s*<code>/", "[code]", $content);
	$content = preg_replace("/<\/code>\s*<\/pre>/", "[/code]", $content);
	$content = str_replace('<code>', '[b]', $content);
	$content = str_replace('</code>', '[/b]', $content);
	$content = str_replace('<em>', '[i]', $content);
	$content = str_replace('</em>', '[/i]', $content);
	$content = preg_replace("/<a\s+.*href=[\"\']?([^\'\"\s]*)[\"\'\s]\s*.*>(.*)<\/a>/", "[url=\1]\2[/url]", $content);

	$content = preg_replace("/(<[^<]*>)/is", ' ', $content);
	$content = shtmlspecialchars($content);
	return $content;
}

function ubbtohtml($content) {

	$content = "<p>" . $content . "</p>";
	$content = str_replace(array('[code]', '[/code]', '[b]', '[/b]', '[i]', '[/i]'), array('</p><pre><code>', '</code></pre><p>', '<code>', '</code>', '<em>', '</em>'), $content);
	$content = preg_replace("/\[url=(.+)\](.+)\[\/url\]/", "<a href=\"\1\">\2</a>", $content);
	$content = preg_replace("/\[url\](.+)\[\/url\]/", "<a href=\"\1\">\1</a>", $content);

	$array = explode('<code>', $content);

	$array2 = array();

	foreach ($array as $key => $value) {
		if ($key) {
			$arr = explode("</code>", $value);
			$array2[] = $arr[0];
			$array2[] = $arr[1];
		} else {
			$array2[] = $value;
		}
	}

	foreach ($array2 as $key => $value) {
		if ($key % 2 == 1) {
			$array2[$key] = "<code>" . $value . "</code>";
		} else {

			$array2[$key] = preg_replace("/\r?\n+/", "</p><p>", $value);
		}

	}

	$content = implode('', $array2);

	$content = preg_replace("/(<p>\s*<\/p>){2,}/", '', $content);

	return $content;
}

function shtmlspecialchars($string) {
	$string = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string);
	$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4})|[a-zA-Z][a-z0-9]{2,5});)/', '&\\1', $string);
	return $string;
}

function debug_array($arr) {
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
	exit ;
}
?>