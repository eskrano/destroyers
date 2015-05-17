<?php


$title  = 'Магазин';
include_once '../protected/sys.php';

?>
<div class ='content'/>
	<div class="mt8 ml5 shop_lgt">
		<div class="fl ml5 sz0">
			<a href="/shop/items">
				<img src="/imgData/static/cloth.png" height="48" width="48">
			</a>
		</div>
		<div class="ml68">
			<a class="bold tdn" href="/shop/items">
				<span class="button_cont_cat">
					Снаряжение
				</span>
			</a>
		</div>
		<div class="ml68 mt5 small">
			лучшее оружие и доспехи
		</div>
		<div class="clb">
		</div>
	</div>
</div>




<?
include_once $config['root'].'/protected/footermain.php';
