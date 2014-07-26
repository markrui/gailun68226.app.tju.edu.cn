<?php
	$IVPConfig['addonslist']=array(
		'json'	=>	'json.php',
		'httpdown'	=>	'com.dedecms.httpdown.php',
		'id3tagreader'	=>	'mp3.id3tagreader.php',
		'twtapi'	=>	'com.twtstudio.php.twtapihelper.class.php',
		'imagehelper'	=>	'com.twtstudio.php.imagehelper.class.php',
		'pagehelper'	=>	'hboz.pagehelper.class.php',
		'uploadhelper'	=>	'hboz.uploadhelper.class.php'
	);
	function base_load_addons($item)
	{
		global $IVPConfig;
		if(isset($IVPConfig['addonslist'][$item]))
			include_once(dirname(__FILE__)."/".$IVPConfig['addonslist'][$item]);
	}
	if(isset($IVPConfig)&&isset($IVPConfig['addons']))
		foreach($IVPConfig['addons'] as $item=>$flag)
		{
			if(!$flag)
				continue;
			base_load_addons($item);		
		}
?>