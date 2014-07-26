<?php
	$_GET['do']=base_nulltest($_GET['do']);
	$kv['do']=$_GET['do'];

	switch($_GET['do'])
	{
		case 'act':
			if(isset($_GET['accept']))
				$kv['flag']=1;
			else
				$repo[]='failed:accept unset';
			break;
		default:
			$kv['do']='';
			$repo[]='unknown do';
			break;
	}
?>