<?php
	class UIGenerator
	{
		//js替换规则 #index# 替换为当前index
		static function genMenu(&$array,$index,$fixjs)
		{
			for($i=0;$i<count($array);$i++)
			{
				echo "<span class=\"".($i==$index?"red":"black")." fwhite buttonlike\" onclick=\"".str_replace("#index#",$i,$fixjs)."\">".$array[$i]."</span>";
			}

		}
	}
?>
