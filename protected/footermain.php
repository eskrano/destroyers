<?php

$onLine = $db->rows("SELECT `id`,`online` FROM `users` 
					WHERE `online`>?",array(($config['time']-3600*12)));




if (isset($user))
{


?>
<div class="hr_g mb2 mt10"><div><div></div></div></div>
<a class ='mbtn mb2' href ='/user'/><img src='/imgData/static/user.png'/> Мой персонаж</a>

<?php
if ($user['clan_id'] > 0 )
{
	?>
	<a class ='mbtn mb2' href ='/clan?id=<?=$user['clan_id'];?>'/> 
		<img src='/imgData/static/clan.png'/>
		Мой клан
	</a>
	<?
}

if ($_SERVER['PHP_SELF'] != '/index.php' )
{
	?>
	<a class ='mbtn mb2' href ='/'/><img src='/imgData/static/home.png'/>На главную</a>
	<?
}

?>
<div class="hr_g mb2"><div><div></div></div></div>

<div class ='content'/>
	<center>
		<img src ='/imgData/static/gold.png'/> <?=$user['gold'];?> |
		<img src ='/imgData/static/silver.png'/> <?=$user['silver'];?> |
		<img src ='/imgData/static/crystal.png'/> <?=$user['crystal'];?> 
	</center>
</div>
<div class="hr_g mb2"><div><div></div></div></div>
<div class="ftr small">
	<div class="ftr_l cntr">
		<div class="ftr_r cntr">
			<div class="grey1 mb5">
				<a class="grey1" href="/settings/index">Настройки</a> 
				<a class="grey1" href="/chat">Чат</a> 
				<?=($user['save'] == 0 ?'| <a class="grey1" href="/save_user"><b>Сохраниться</b></a>':null);?>
				<?=($user['access'] ==3 ? '<a class ="grey1" href ="/admin/index"/><span class ="win"/> Админка </span></a>':null);?> 
			</div><div class="grey2">
			<?=date("H:i:s");?> | <a class="grey1" href="/online">Онлайн <?=$onLine;?> </a>
			<br>
			Уничтожители © 2015, 16+<br>
			<a class="grey2" href="?logout">Выход</a>
			<br><br>
			<div class="f-block">
</div>
</div>
</div>
</div>
</div>

<?

}
else
{




	?>

<div class="ftr small">
	<div class="ftr_l cntr">
		<div class="ftr_r cntr">
			<div class="grey1 mb5">
				<a class="grey1" href="/online">Бета тест</a> 
				| <a class="grey1" href="/about">Об игре</a>
			</div><div class="grey2">
			<?=date("H:i:s");?> | Онлайн <?=$onLine;?>
			<br>
			Уничтожители © 2015, 16+<br>
			
			<br><br>
			<div class="f-block">
</div>
</div>
</div>
</div>
</div>


	<?
}

$end_time = microtime();

$end_array = explode(" ",$end_time);

$end_time = $end_array[1] + $end_array[0];

// вычитаем из конечного времени начальное

$time = $end_time - $start_time;

$time = substr($time, 0,4);

// выводим в выходной поток (броузер) время генерации страницы

printf("Страница сгенерирована за %f секунд",$time); 