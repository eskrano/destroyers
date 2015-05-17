<?php

$title ='Bans';
$paginate =1;
include_once '../protected/sys.php';

$act = isset($_GET['act']) ? trim(htmlspecialchars($_GET['act'])) : null;

switch($act)
{
	default;
	?>	
	<a class="mbtn mb2" href ="/admin/ban?act=allbans"/> Все блокировки </a>
	<a class="mbtn mb2" href ="/admin/ban?act=ban"/>Выдача блокировки</a>
	<a class="mbtn mb2" href ="/admin/ban?act=edit"/> Редактор блокирово</a>

	<?

	break;


	case 'allbans';


	$allBans = $db->rows("SELECT `id` FROM `ban`",
							array());

	if ($allBans == 0)
	{
		?>
		<div class ='content'/>
			<center>
				Блокироовок еще не было.
			</center>
		</div>
		<?
	}
	else
	{
		$c = 10;
		$k_post =&$allbans;
		$k_page = k_page($k_post,$c);
		$page = page($k_page);
		$start = $c*$page-$c;

		$db->offEmulate();
		$BanData = $db->fetchAll ("SELECT * FROM `ban` ORDER BY `time` DESC LIMIT ?,?",
									array($start,$c));

		foreach ($BanData as $data) {
			$whoUser = $db->fetch("SELECT `login`,`id`,`sex` FROM `users` WHERE `id`=?",
									array($data['user']));
			$whoAdmin = $db->fetch("SELECT `login`,`id`,`sex` FROM `users` WHERE `id`=?",
									array($data['admin']));


			?>
			<div class ='content'/>
				ID блокировки: <?=$data['id'];?><br/>
				Бан выдал: <img src ='/imgData/static/<?=$whoAdmin['sex'];?>.png'/>
							<a href ='/user?id=<?=$data['admin'];?>'/>
								<?=$whoAdmin['login'];?>
							</a>
							<br/>
				Нарушитель: <img src ='/imgData/static/<?=$whoUser['sex'];?>.png'/>
							<a href ='/user?id=<?=$data['user'];?>'/>
								<?=$whoUser['login'];?>
							</a>
							<br/>
				<?=($data['time'] >$config['time'] ? '<span class=\'win\'/>Бан активен</span>':'<span class=\'lose\'/> Бан Не активен</span>');?>
				<br/>
				Причина: <?=$data['text'];?><br/>
				<br/>
				<a href ='?act=edit&amp;id=<?=$data['id'];?>'/> Редактировать </a>
				<a href ='?act=delete&amp;id=<?=$data['id'];?>'/> Удалить </a>
			</div>

			<?
		}

		if ($k_page > 1)
		{
			str('?act=allbans&',$k_page,$page); // Вывод страниц
		}


	}



	break;

	case 'ban';
	$_GET['id'] =  isset($_GET['id']) ? (int) abs($_GET['id']) : null;
	if (isset($_GET['id']))
	{
		$id =&$_GET['id'];

		$checkVar = $db->rows("SELECT `id` FROM `users` WHERE `id`=?",
								array($id));

		if ($checkVar == 1)
		{
			if (isset($_GET['form'])) {
				$banNew = $db->query("INSERT INTO `ban` SET `text`=?,`time`=?,`type`=?,`admin`=?,`user`=?",
									array($reason,$config['time'],$type,$user['id'],$id));

				$_SESSION['info'] ='Блокировка выполнена!';
				header("Location:/");
				exit;			
			}
			?>
			<div class ='content'/>
				<form action ='?act=ban&amp;id=<?=$id;?>&amp;form' method='post'/>
					Причина: <br/>
					<input type='text' name ='reason'/><br/>
					Сроки в минутах: 
					<br/>
					<input type ='text' name ='time'/><br/>
					Тип блокировки:
					<br/>
					<select name='type'>
						<option value ='mute'>Молчанка </option>
						<option value ='block'>Блокировка </option>
						<option value ='permament'>Навсегда </option>
					</select>
					<input type ='submit' value ='Бан'/>
				</form>
			</div>

			<?
		}
	}
	else
	{
		?>

		<div class ='content'/>
			Не передан параметр ID (int)! Ошибка выполнения приложения!
		</div>

		<?
	}

	break;


	case 'edit';

	if (isset($_GET['id']) ) {

		$id = isset($_GET['id']) ? (int) abs($_GET['id']) : null;
		$dataBanEditCheck = $db->rows("SELECT * FROM `ban` WHERE `id`=? AND `time`>?",
										array($id,$config['time']));

		if ($dataBanEditCheck > 0) {
			$dataBan = $db->fetch("SELECT * FROM `ban` WHERE `id`=?",
									array($id));

			
		} 
	}



	break;
}

include_once $config['root'].'/protected/footermain.php';
