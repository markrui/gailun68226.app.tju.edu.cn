<?php //当调用DatabaseViewer的getNaviData函数生成$navidata变量后
	//模板引用 pagination 即可在页面内插入分页元素
	//template need $pagenavi gen by DatabaseViewer::getNaviData
	//isset($navidata)&&isset($navidata['href'])
	$navidata['prevpage']=$navidata['page']-1;
	$navidata['nextpage']=$navidata['page']+1; ?>
<div class="pagination">
<ul class="pull-left">
<li class="<?php if(!$navidata['hasprev']) { ?>disabled<?php } ?>">
<a href="<?=$navidata['href']?>&p=<?=$navidata['prevpage']?>">Prev</a>
</li>
<?php $side=2;
			$continued=false;
			for($i=0;$i<$navidata[totalpage];$i++)
			{
				if(
					($i!=0&&$i<$navidata['page']-$side)
					||(
					$i!=$navidata['totalpage']-1
						&&$i>$navidata['page']+$side)
					)
				{
					if(!$continued)
					{ ?>
<li class="disabled">
<a>...</a>
</li>
<?php $continued=true;
					}
					continue;
				}
				$continued=false;
				$p=$i+1; ?>
<li class="<?php if($navidata['page']==$i) { ?>active<?php } ?>">
<a href="<?=$navidata['href']?>&p=<?=$i?>"><?=$p?></a>
</li>
<?php } ?>
<li class="<?php if(!$navidata['hasnext']) { ?>disabled<?php } ?>">
<a href="<?=$navidata['href']?>&p=<?=$navidata['nextpage']?>">Next</a>
</li>
</ul>
</div>