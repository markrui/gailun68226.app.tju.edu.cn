<?php
class HashHelper {
	var $db;
	//允许的类型
	private $allowtype = array('resetpassword','changeemail');
	function __construct(&$db){
		$this->db=$db;
	}
	public function insert($twtname, $type, $hash, $via='api') {
		if(!in_array($type, $this->allowtype)) {
			return '10:不允许的类型'; //错误代码10，不允许的类型值
		}
		
		$this->db->conn();
		
		$fromsql = "`".TWTBasicDB::Get('hashes')."`";
		$wheresql = "WHERE `twtname` = '$twtname' AND `type` = '$type' AND `isused` = 0";
		
		
		$count = $this->db->countRow($fromsql, $wheresql);
		
		
		if($count > 1) {
			//若查到多条，删除所有项并设置$count = 0
			$delsql = "DELETE FROM $fromsql $wheresql";
			$result = $this->db->sql($delsql);
			if($this->db->getAffectedRow()) {
				$count = 0;
			} else {
				return '11:删除失败'; //错误代码11，删除失败
			}
		}
		
		date_default_timezone_set('Asia/Chongqing');
		
		if($count == 1) {
			//查到一条，更新此项
			$selsql = "SELECT * FROM $fromsql $wheresql LIMIT 1";
			$result = $this->db->sql($selsql);
			if($row = $this->db->getRow($result)) {
				$now = strtotime(now);
				$createtime = strtotime($row['create']);
				$dur = $now - $createtime;
				if($dur > 60) {
					//满足条件，更新数据
					$timeline = date("Y-m-d H:i:s");
					$sets = array(
						'twtname'	=> $twtname,
						'type'		=> $type,
						'hash'		=> $hash,
						'via'		=> $via,
						'create'	=> $timeline,
						'usetime'	=> '',
						'isused'	=> 0
					);
					$setsql = array();
					foreach($sets as $key => $value) {
						$setsql[] = "`$key`='$value'";
					}
					$updatesql = "UPDATE $fromsql SET ".implode(", ", $setsql)." $wheresql";
					$result = $this->db->sql($updatesql);
					if($this->db->getAffectedRow()) {
						return true; //返回成功
					} else {
						return '13:更新失败'; //错误代码13，更新失败啊亲！
					}
				} else {
					return '12:请 '.(60-$dur).' 秒后重试'; //错误代码12，距离上次创建HASH数据不到一分钟
				}
			}
		}
		
		if($count == 0) {
			//插入数据
			$timeline = date("Y-m-d H:i:s");
			$keys = array('twtname', 'type', 'hash', 'via', 'create', 'usetime', 'isused');
			$keysql = "(`".implode("`,`", $keys)."`)";
			$values = array($twtname, $type, $hash, $via, $timeline, '', 0);
			$valsql = "('".implode("','", $values)."')";
			$insertsql = "INSERT INTO $fromsql $keysql VALUES $valsql";
			$result = $this->db->sql($insertsql);
			if($result) {
				return true; //返回成功
			} else {
				return '14:插入数据失败'; //错误代码14，插入数据失败
			}
		}
	}
}	
?>