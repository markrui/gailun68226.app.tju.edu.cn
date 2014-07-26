<?php 

	load_model('user.session.func');

	function user_APISync($apiresult)
	{
		//将API查询到的用户信息同步到
		if(!$apiresult)
			return;
		$user=user_getById($apiresult->uid);
		// echo 'sync';
		// print_r($apiresult);
		if(!$user)
		{
			user_insert(array(
				'uid'	=>	$apiresult->uid,
				'type'	=>	'twt',
				'username'	=>	$apiresult->twtname,
				'realname'	=>	$apiresult->realname,
				'isforbidden'	=>	0,
				'loginat'	=>	date('Y-m-d H:i:s'),
				'loginip'	=>	getIp()
			));
		}
		else
		{
			$setarr=array(
				'username'	=>	$apiresult->username,
				'realname'	=>	$apiresult->realname,
				'loginat'	=>	date('Y-m-d H:i:s'),
				'loginip'	=>	getIp()
			);
			if($user['username']!=$apiresult->twtname)
				$user['username']=$apiresult->twtname;
			if($user['realname']!=$apiresult->realname)
				$user['realname']=$apiresult->realname;
			user_update($setarr,$apiresult->uid);
		}
	}

	function user_updateBasic($set,$where)
	{
		$set=base_protect($set);
		$where=base_protect($where);
		$flag=updatetable('user',$set,$where);
		return $flag;
	}

	function user_delete($where)
	{
		global $db;
		$where=base_protect($where);
		$query='DELETE FROM '.table('user').' WHERE ';
		$c=0;
		foreach($where as $i=>$v)
		{
			$c++;
			if($c!=count($where))
				$query.=' AND';
			$query.='`'.$i.'`="'.$v.'"';
		}
		$db->sql($query);
		return $db->getAffectedRow();
	}

	function user_countAll($row='COUNT(*) as count',$where=false){
		$query='SELECT '.$row.' FROM '.table('user').' '.$where;
		global $db;
		$result=$db->sql($query);
		// echo $query.'<br/>';
		return $db->getRow($result);
	}

	function user_getByPage($where, $start, $perpage){
		global $db;
		$limit = " limit $start, $perpage";
        $query = 'SELECT * FROM ' . table('user') ." ".$where.$limit;
		//die($query);
		$result = $db->sql($query);
		$arr = array();
        while ($row = $db->getRow($result)) {
        	$arr[] = $row;
        }
        return $arr;
	}
	
	function user_getBySQL($where){
		global $db;
	
        $query = 'SELECT * FROM ' . table('user') ." ".$where;
		// die($query);
		$result = $db->sql($query);
		$arr = array();
        while ($row = $db->getRow($result)) {
        	$arr[] = $row;
        }
        return $arr;
	}
	
	function user_getById($uid,$type='twt'){
		global $db;
		if($uid == NULL)
			return NULL;
		else{
	        $query = 'SELECT * FROM ' . table('user') 
	        	.' WHERE `type`="'.base_protect($type).'" '
	        	.' AND `uid` = '.$uid;
			$result = $db->sql($query);
			$row = $db->getRow($result);
	        return $row;
		}
	}
	
	function user_exist($username){
		global $db;
		if($username == NULL)
			return NULL;
		else{
			$query = "SELECT `uid` FROM " . table('user') . ' WHERE `username` = "'.$username.'"';
			$result = $db->sql($query);
			if($row = $db->getRow($result))
				return $row['uid'];
			else 
				return NULL;
		}
	}

	function user_insert($insertarr){
		base_protect($insertarr);
		return inserttable('user', $insertarr);
	}	

	function user_update($setarr, $index,$type='twt'){
		$wherearr = array('uid' => (int)$index,'type'=>base_protect($type));
		$setarr=base_protect($setarr);
		return updatetable('user', $setarr, $wherearr)?$index:false;
	}