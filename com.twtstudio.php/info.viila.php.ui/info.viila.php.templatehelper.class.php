<?php
	class TemplateHelper
	{
		static $tpl,$cache;
		static $name="default";
		static $tplfix=".t";
		private $tplpath,$cachepath,$iscached;

		function theme($tname)
		{
			TemplateHelper::$name=$tname;
		}

		function __construct($tplpath,$cachepath,$iscached=true)
		{
			TemplateHelper::$tpl=$this->tplpath=$tplpath;
			TemplateHelper::$cache=$this->cachepath=$cachepath;
			$this->iscached=$iscached;
		}
		function prepare($name) 
		{
			if(strpos($name,'/')!==false){
				$tpl = $name;
			} else {
				$tpl = TemplateHelper::$name."/$name";
			}
			$objfile = $this->cachepath."/".str_replace('/','_',$tpl).TemplateHelper::$tplfix.'.php';
			
			if(TemplateHelper::nocache()||!file_exists($objfile)) {
				include_once(dirname(__FILE__).'/info.viila.php.template.func.php');
				parse_template($tpl,$this->tplpath,$this->cachepath);
			}
			return $objfile;
		}
		
		function clearcache()
		{
			$path=$this->cachepath.'/';
			$dir=opendir($path);
			$ignore=array('.','..');
			while($file=readdir($dir))
			{
				if(ArrayEx::getElementByValue($file,$ignore)!=-1)
					continue;
				if(is_dir($path.$file))
					continue;
				if(strpos($file,TemplateHelper::$tplfix.'.php')>=0)
				{
					unlink($path.$file);
				}
			}
		}
		
		static $nocacheflag=false;
		static function nocache($flag=false)
		{
			TemplateHelper::$nocacheflag=$flag||TemplateHelper::$nocacheflag;
			return TemplateHelper::$nocacheflag;
		}

	}
?>