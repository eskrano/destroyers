<?php

$title ='Магазин комплектов!';
include_once '../protected/sys.php';

$_GET['sort'] =  isset($_GET['sort']) ?
				 trim(htmlspecialchars($_GET['sort']))
				 :
				 null;


switch($_GET['sort'])
{
	default:

	$allsets = $db->fetchAll("SELECT `id`,`name`,`level` FROM `complects` ORDER BY `level` DESC",null);

	foreach ($allsets as $data) {
		?>
			<a class ='mbtn mb2' href ='?sort=complect&amp;id=<?=$data['id'];?>'/>
				<?=$data['name'];?> (<?=($data['level'] > $user['level'] ? '<span class =\'lose\'/>':'<span class=\'win\'/>');?>С <?=$data['level'];?> уровня</span>)
			</a>
		<?
	}




	break;

	case 'complect':
	$id = (int) abs($_GET['id']);

	$checkID = $db->rows("SELECT `id` FROM `complects` WHERE `id`=?",
						array($id));


	if ($checkID == 0)
	{
		header("Location:/shop/items");
		exit;
	}
	$complect = $db->fetch("SELECT * FROM `complects` WHERE `id`=?",
							array($id));

	if ($user['level'] < $complect['level']) {
		header("Location:/shop/items");
		exit;
	}

	if (isset($_GET['buy']))
	{
		if ($user['gold']>=$complect['cost'])
		{
			$stmt = $db->query("INSERT INTO `backpack` SET `user`=?,`item`=?,
															`str`=?,`def`=?,
															`vit`=?,`up`=?,
															`rune`=?,`aura`=?,
															`status`=?",
															array($user['id'],
																$complect['id'],
																$complect['str'],
																$complect['def'],
																$complect['vit'],
																0,
																0,
																0,
																'unwear'));

			$_SESSION['info'] = 'Комплект успешно куплен и помещен в рюкзак!';
			header("Location:/shop/items");
			exit;
		}
		else
		{
			$_SESSION['error']  = 'Не хватает золота! Купите золото чтоб купить комплект!';
			header("Location:/shop/items");
			exit;
		}
	}




	?>

	<div class ='content'/>
	<center>
		<img src ='/imgData/static/co/<?=($user['sex'] == 0 ?  0:1);?>/<?=$id;?>.jpg' width='120' height='160'/>
	</center>
	</div>
	<div class ='content'/>
	<center>
		<i> Параметры</i>
	</center>
	Сумма статов:	<?=($complect['str']+$complect['def']+$complect['vit']);?> 
	</div>
	<a class ='mbtn mb2' href ='/shop/items?sort=complect&amp;id=<?=$id;?>&amp;buy'/>
	Купить за  <?=$complect['cost'];?> золота 
	</a>

	<?
	break;
}

include_once $config['root'].'/protected/footermain.php';