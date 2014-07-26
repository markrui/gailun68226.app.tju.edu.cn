<?php
	class UploadHelper{
		var $tmpName;
		var $originalName;
		var $fileSizeLimit;
		var $fileTypeLimit;
		var	$type;
		var $size;
		var $newName;
		var $error="none";
		var $uploadFileFolder;
		function __construct($file,$uploadFileFolder){
			$this->originalName=$file['name'];
			$this->type=$file['type'];
			$this->size=$file['size'];
			$this->tmpName=$file['tmp_name'];
			$this->uploadFileFolder=$uploadFileFolder;
			$this->fileSizeLimit=false;
			$this->fileTypeLimit=false;
		}
		function move(){
			if($this->check()){
				$tmp=pathinfo($this->originalName);
				$this->newName=md5($this->originalName.date("Ymd h:i:s")).".".$tmp['extension'];
				move_uploaded_file($this->tmpName,$this->uploadFileFolder."/".$this->newName);
				return true;
			}
			else
				return false;
		}
		function getLastError(){
			return $this->error;
		}
		//$parameter['fileSizeLimit'] should be integer
		//$parameter['fileSizeLimit'] should be array()
		function setParameter($parameter){	
			if($this->argumentExistNotEmpty($parameter['fileSizeLimit'])){
				$this->fileSizeLimit=$parameter['fileSizeLimit'];
			}	
			if(
				$this->argumentExistNotEmpty($parameter['fileTypeLimit'])&&
				is_array($parameter['fileTypeLimit'])
			){
				$this->fileTypeLimit=$parameter['fileTypeLimit'];
			}
				
		}
		function argumentExistNotEmpty($argument){
			if(isset($argument)&&!empty($argument))
				return true;
			else
				return false;
		}
		function check(){
			if(
				$this->checkUploadFile()&&
				$this->checkUploadFolder()&&
				$this->checkFileSize()&&
				$this->checkFileType()
			){
				return true;
			}
			else{
				return false;
			}
		}
		function checkUploadFile(){
			if(is_uploaded_file($this->tmpName))
				return true;
			else{
				$this->error="上传文件不存在";
				return false;
			}
		}
		function checkUploadFolder(){
			if(is_dir($this->uploadFileFolder)){
				return true;
			}
			else{
				$this->error="上传文件夹不存在";
				return false;
			}
		}
		function checkFileSize(){
			if(!$this->fileSizeLimit)
				return true;
			else{				
				if($this->size<=$this->fileSizeLimit){
					return true;
				}
				else{
					$this->error="文件超出指定大小";
					return false;
				}
			}
		}
		function checkFileType(){
			if(!$this->fileTypeLimit)
				return true;
			else{
				if(strtolower($this->type)=='php')
				{
					$this->error='类型被禁止';
					return false;
				}
				if(in_array($this->type,$this->fileTypeLimit))
					return true;
				else{
					$this->error="文件类型不正确";
					return false;
				}
			}
		}
		function newName(){
			return $this->newName;
		}
		function originalName(){
			return $this->originalName;
		}
	}
?>