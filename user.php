<?php

$title = 'Профиль';
include_once 'protected/sys.php';

$id = (int) abs($_GET['id']);

if (isset($id))
{
	$dataRows = $db->rows("SELECT `id` FROM `users` WHERE `id`=?",
				      array($id));
	if ($dataRows == 0)
	{
		$data =&$user;
	}
	else
	{
		$data = $db->fetch("SELECT * FROM `users` WHERE `id`=?",
							array($id));
	}
}




$access =  array("Игрок","Модератор","Ст. Модератор","Администратор",
				"Тех.Под","Создатель");

$wear = $db->fetch("SELECT * FROM `backpack` WHERE `id`=?",
					array($data['wear']));

if (!$wear)
{
	$wear['item'] = 0;
}

?>
	<div class ='content'/>
	<?=$access[$data['access']];?> <?=$data['login'];?>	

	<?=($data['online']>($config['time'] - 3600*12) ?
	'<span class="win"/>Онлайн</span>' : 
	'<span class ="lose"/>Оффлайн</span>');?>
<center>
	<div style="text-align: center;
width: 150px;
height: 160px;
background-image: url('/imgData/static/pages/bg-dummy-shd.png');
background-position: 50% 0px;
background-repeat: repeat-y;">
	<img src= '/imgData/static/co/<?=$data['sex'];?>/<?=$wear['item'];?>.jpg' width ='120' height='160'/>
</div>
</center>
	</div> 
	<a class ='mbtn mb2' href ='/equip<?=($data['id'] ==  $user['id'] ? null : '?id='.$data['id']);?>'/>
		<img class ='icon' src = '/imgData/static/equip.png'/>Экипировка 
	</a>





<?


if ($data['id'] ==  $user['id'])
{

	$bagCount  = $db->rows("SELECT `id`,`user`,`status` FROM `backpack`
							WHERE `user`=? and `status`!='wear'",
							array($data['id']));
	?>
	<a class ='mbtn mb2' href ='/backpack'/>
		<img class ='icon' src = '/imgData/static/bag.png'/> Сумка (<?=$bagCount;?> из <?=$data['backpack'];?>) 
	</a>
	<a class ='mbtn mb2' href ='/train'/>
		<img class ='icon' src = '/imgData/static/train.png'/> Тренировка 
	</a>

	<?
}

include_once $config['root'].'/protected/footermain.php';