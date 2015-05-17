<?php

$title = 'Экипировка';
include_once 'protected/sys.php';

$idData  =  isset($_GET['id']) ? (int) abs($_GET['id']) : $user['id'];


$data = $db->fetch("SELECT `id`,`wear`,`sex` FROM `users` WHERE `id`=?",
							array($idData));

$equip = $db->fetch("SELECT * FROM `backpack` WHERE `id`=?",
					array($data['wear']));

$complect = $db->fetch("SELECT * FROM `complects` WHERE `id`=?",
						array($equip['item']));


$auras = array("нет ауры","Аура шока","Аура Доблести","Аура Ярости","Аура Полубога");
$runas = array("нет руны","Руна Шаманов","Руна Полнолуния","Руна Отваги","Руна Хвастовства",
				"Руна Воскрешения","Руна Устойчивости","Руна Богов");

?>
<div class="bntf">
	<div class="nl">
		<div class="nr cntr lyell lh1 p5 sh">
			<span class="win">
				<?=$complect['name'];?>
			</span>

				<center>
		<img src ='/imgData/static/co/<?=$data['sex'];?>/<?=(isset($equip['item']) ? $equip['item'] : 0);?>.jpg'/>
	</center>
		</div>
	</div>
</div>
<div class ='content'/>
	<center>
		Параметры :<?=($equip['str']+$equip['vit']+$equip['def']);?>
		<img class="icon" src="/imgData/static/str.png">
		<img class="icon" src="/imgData/static/hp.png">
		<img class="icon" src="/imgData/static/def.png">
	</center>
</div>

<?

if ($idData == $user['id'])
{
	if ($user['wear'] >0)
	{

			?>
			<div class ='line'/></div>
			<div class ='content'/>
				<img src ='/imgData/static/level.png'/>Заточка: <?=$equip['up'];?>/75<br/>
				<img src ='/imgData/static/shop.png'/>Руна: <?=$runas[$equip['rune']];?><br/>
				<img src ='/imgData/static/online.png'/>Аура: <?=$auras[$equip['aura']];?><br/>
			</div>
			<a class ='mbtn mb2' href ='/master/runas'/> 
				<img src ='/imgData/static/shop.png'/> Установить руну 	
			</a>
			<a class ='mbtn mb2' href ='/master/up'/> 
				<img src ='/imgData/static/level.png'/>  Заточить вещь 	
			</a>
			<a class ='mbtn mb2' href ='/master/auras'/> 
				<img src ='/imgData/static/online.png'/>  Наложить Ауру 	
			</a>
			<?
		if (isset($_GET['unwear']))
		{
			$unwearQuery = $db->query("UPDATE `users` SET `str`=?,`hp`=?,`def`=?,`wear`=?
									WHERE `id`=?", array(($user['str']-$equip['str']),
														 ($user['hp']-$equip['vit']),
														 ($user['def']-$equip['def']),
														 (0),
														 ($user['id'])));


			$backpackQuery = $db->query("UPDATE `backpack` SET `status`=? WHERE `id`=?",
										array('unwear',$equip['id']));


			$_SESSION['info'] =  'Набор снят.';
			header("Location:/equip");
			exit;

		}
		?>
		<a class ='mbtn mb2' href ='/equip?unwear'/> 
			<img src ='/imgData/static/q1.png'/> Снять вещь	
		</a>
		<?
	}
	else
	{
		?>
		<a class ='mbtn mb2' href ='/shop/'/> 
			<img src ='/imgData/static/shop.png'/> Посетить магазин	
		</a>
		<?
	}
}

?>
<a class ='mbtn mb2' href ='/user?id=<?=$idData;?>'/> К игроку </a>
<?

include_once $config['root'].'/protected/footermain.php';
