<?php


$title = 'Онлайн';
$paginate = 1;
include_once 'protected/sys.php';

if (!$user)
{
	header("Location:/");
	exit;
}

$c = 10;
$k_post = $db->rows("SELECT `id`,`online` FROM `users` WHERE `online`>?",
					array(($config['time']-(3600*12))));
$k_page = k_page($k_post,$c);
$page = page($k_page);
$start = $c*$page-$c;

$db->offEmulate();

$OnlineArray =  $db->fetchAll("SELECT * FROM `users` WHERE `online`>? 
								ORDER BY `online` LIMIT ?,?",
								array(($config['time']-(3600*12)),$start,$c));



?>


<?

foreach ($OnlineArray as $data) {
	?>

	<a class ='mbtn mb2' href ='/user?id=<?=$data['id'];?>'/>
		<img src = '/imgData/static/<?=$data['sex'];?>.png'/>
		 <?=$data['login'];?> 
		<?=($data['online']>($config['time']-600) ? '<img src="/imgData/static/online.png"/>':
													null);?>
		<span style ='float:right; margin-left:2px;'/>
		Рейтинг : <?=($data['str']+$data['vit']+$dat['def']);?>
		</span>
	</a>

	<?
}

?>

<?
if ($k_page>1){
?>
<div class ='content'/>

<div class="hr_arr mt2 mb2 mlr10">
	<div class="alf">
		<div class="art">
			<div class="acn">
			</div>
		</div>
	</div>
</div>
<center>
<?


str('?',$k_page,$page); // Вывод страниц


?>
</center>
<div class="hr_arr mt2 mb2 mlr10">
	<div class="alf">
		<div class="art">
			<div class="acn">
			</div>
		</div>
	</div>
</div>
</div>
<?
}
?>
<div class="bntf">
	<div class="small">
		<div class="nl">
			<div class="nr cntr lyell lh1 p5 sh">
				<img src="/imgData/static/online.png" alt="online" class="icon">
				 - игрок проявлял активность за последние 10 минут
				</div>
			</div>
		</div>
	</div>

<a class ='mbtn mb2' href ='/search_user'/> Поиск игроков </a>
<?




include_once $config['root'].'/protected/footermain.php';