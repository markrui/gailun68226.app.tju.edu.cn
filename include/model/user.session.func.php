<?php
	
	@session_start();
	load_model('base.func');
	
	function user_check($username, $password){
		global $db;
		
		$query = "SELECT * FROM `admin` WHERE `username` = '".$username."'";
		$result = $db->sql($query);
		while( $row = $db->getRow($result) ){
			if( $row['password'] == $password ){
				$_SESSION['islogin'] = true;
				$_SESSION['username'] = $username;
				return true;
			}
		}
		
		return false;
	}
	
	function user_islogin(){
		if(base_nulltest($_SESSION['islogin']) != "")
			return true;
		else
			return false;
	}
	
	function needAdmin(){
		global $_TPL, $tpl;
		
		if(!user_islogin()){
			include $tpl->prepare('login');
			exit;
		}
		else
			return true;
	}
	
	function user_logout(){
		global $_TPL, $tpl;
		
		$_SESSION['islogin'] = false;
		include $tpl->prepare('login');
	}