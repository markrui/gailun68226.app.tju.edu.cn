<?php
	class PageHelper{
		var $limit;
		var $nowPage;
		var $allPages;
		var $db;
		function __construct(&$db){
			$this->db=$db;
		}
		function setLimit($limit){
			$this->limit=$limit>0?$limit:1;
		}
		function setNowPage($nowpage){
			$this->nowPage=$nowpage>$this->allPages?$this->allPages:$nowpage;
			$this->nowPage=$nowpage<1?1:$nowpage;
		}
		function setAllPages($dbname,$where){
			$sql="SELECT count(*) as `nums` FROM {$dbname} WHERE {$where}";
			$re=$this->db->sql($sql);
			$row=$this->db->getRow($re);
			$nums=$row['nums'];
			$this->allPages=ceil($nums/$this->limit)>0?ceil($nums/$this->limit):1;
		}
		/*
			$parameter=array(
				'dbname'	=>		'',
				'where'		=>		'TRUE',
				'now'		=>		1,
				'limit'		=>		10
			);
		*/
		function setParameter($parameter){
			$this->setLimit($parameter['limit']);
			$this->setAllPages($parameter['dbname'],$parameter['where']);
			$this->setNowPage($parameter['now']);
		}
		function prev(){
			return ($this->nowPage-1<1)?1:$this->nowPage-1;
		}
		function next(){
			return ($this->nowPage+1>$this->allPages)?$this->allPages:$this->nowPage+1;
		}
		function now(){
			return $this->nowPage;
		}
		function getLimit(){
			return $this->limit;
		}
		function getAllPages(){
			return $this->allPages;
		}
	}
	
?>