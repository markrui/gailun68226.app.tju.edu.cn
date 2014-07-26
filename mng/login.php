<?php
	include(dirname(__FILE__).'/common.php');
	load_model('user.session.func');
	$username = base_nulltest($_POST['username']);
	$password = base_nulltest($_POST['password']);
	
	if( user_check($username, $password) ){
		echo "<script language=\"javascript\">location.href=\"index.php\";</script>";
	}
	else{
		include $tpl->prepare('login');
	}