<?php 

	load_model('base.func');
	
	function news_countAll($row='COUNT(*) as count',$where=false){
		$query='SELECT '.$row.' FROM '.table('news').' '.$where;
		global $db;
		$result=$db->sql($query);
		// echo $query.'<br/>';
		return $db->getRow($result);
	}

	function news_incvisit($index){
		$index=(int)$index;
		global $db;
		$query="UPDATE " .table('news').' SET visitcount=visitcount+1 WHERE `index`='.$index.' LIMIT 1';
		// die($query);
		$result=$db->sql($query);
	}
	
	function news_getBySQL($where,$col="*"){
		global $db;
	
        $query = 'SELECT '.$col.' FROM ' . table('news') .' '.$where;
		//die($query);
		$result = $db->sql($query);
		$arr = array();
        while ($row = $db->getRow($result)) {
        	$row['newsname']=base_escape($row['newsname']);
        	$arr[] = $row;
        }
        return $arr;
	}
	
	function  news_indexShow($table, $limit = 5){
		global $db;
		
		$query = 'SELECT * FROM '.$table.' WHERE 1 ORDER BY `date` DESC LIMIT '.$limit;
		$result = $db->sql($query);
		$arr = array();
		while( $row = $db->getRow($result) ){
			$arr[] = $row;
		}
		
		return $arr;
	}
	
	function news_getById($index,$table,$autoprotect=true){
		global $db;
		if($index == NULL)
			return NULL;
		else{
			$index=(int)$index;
	        $query = "SELECT * FROM ".$table." WHERE `id` = '$index'";
			$result = $db->sql($query);
			$row = $db->getRow($result);
	        return $row;
		}
	}
	
	function news_delete($index, $table){
		global $db;
		if($index == NULL)
			return NULL;
		else{
			$index = (int)$index;
			$query = 'DELETE FROM '.$table.' WHERE `id` ='.$index;
			echo $query;
			$result = $db->sql($query);
			
			return $result;
		}
	}
	
	function news_update($setarr, $index, $table){
		$wherearr = array('id' => (int)$index);
		$setarr=base_protect($setarr);
		return updatetable($table, $setarr, $wherearr)?$index:false;
	}
	
	function news_insert($insertarr, $table){
		$insertarr=base_protect($insertarr);
		return inserttable($table, $insertarr);
	}

	//分页获取
	function feature_listBypage($page,$pagesize,$from,$where){
		global $db;
		
		$dbv=new DataBaseViewer($db);   
		$dbv->setPageLimit($pagesize);
		$dbv->setNaviJs("jump(");			
		
		if(!is_numeric($page)){
			$page=0;
		}else if($page<0){
			$page = 0;
		}
				
		//获取前$pagesize个
		$result = $dbv->sqlByPage($from,$where,$page);
		$features = array();
		
		while($row = $db->getRow($result)){
			$features[] = $row;
			
		}
		//保存返回的查询信息
		$featureArr['features'] = $features;
		
		//获取分页导航栏
		$feature_navi = $dbv->getNaviData($from,$where,$page);			//获取分页导航数据
		$feature_navi['prev']= $page-1;									//上页
		$feature_navi['next'] = $page+1;								//下页
		$feature_navi['pages']=$dbv->genPageNaviM($from,$where,$page);	//显示分页
		
		//保存分页导航栏
		$featureArr['feature_navi'] = $feature_navi;
		
		return $featureArr;
	}
