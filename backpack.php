<?php

$title = 'Рюзкак';
include_once 'protected/sys.php';


$_GET['sort'] =  isset($_GET['sort']) ? htmlspecialchars($_GET['sort']) : null;




switch ($_GET['sort']) {
	

	default;
  	
	$rw = $db->rows("SELECT `id`,`user`,`status` FROM `backpack` WHERE `user`=? and `status`!='wear'",
					array($user['id']));

	if ($rw == 0)
	{
		?>	
		<div class ='content'/>
		Нет вещей...
		</div>
		<?	
	}
	else
	{

	   	$backpackList = $db->fetchAll("SELECT * FROM `backpack` WHERE `user`=? and `status`!='wear'",
	   									array($user['id']));


	   	if (is_array($backpackList))
	   	{
	   		foreach ($backpackList as $data) {
	   			$itemData = $db->fetch("SELECT * FROM `complects` WHERE `id`=?",
	   									array($data['item']));
	   			?>	

	   			<div class ='content'/>
	   			<img width= '60' height='90' src='/imgData/static/co/<?=($user['sex'] == 0 ? 0:1);?>/<?=$data['item'];?>.jpg'/><br/>
	   			<i><?=$itemData['name'];?></i> <?=($data['status'] == 'destroy' ? '(Сломана)': null);?>
	   			<br/>

	   				
	   			<?

	   			if ($data['status'] ==  'destroy')
	   			{
	   				?>
	   				<a href ='/backpack?sort=repair&amp;id=<?=$data['id'];?>'/>
	   					Чинить за  <?=(round($data['str']+$data['vit']+$data['def']/1000));?>
	   					золота
	   				</a>

	   				<?
	   			}
	   			elseif($data['status'] == 'unwear')
	   			{
	   				?>
	   				<a href ='/backpack?sort=wear&amp;id=<?=$data['id'];?>'/>
	   					Одеть 
	   				</a>
	   				<?
	   			} 


	   			?>

	   			</div>


	   			<?
	   		}
	   	}
	}


	break;

	case 'wear';
		$id = isset($_GET['id']) ? (int) abs($_GET['id']) : null;

		$checkID = $db->rows("SELECT `id`,`user` FROM `backpack` WHERE `id`=? and `user`=?",
							array($id,$user['id']));

		if ($checkID == 0)
		{
			$_SESSION['error'] = 'Ошибочный ID вещи!';
			header("Location:/backpack");
			exit;
		}

		if ($user['wear'] == 0)
		{

			$item = $db->fetch("SELECT * FROM `backpack` WHERE `id`=?",
				array($id));

			if ($item['status'] ==  'destroy' OR $item['status']=='wear')
			{
				header("Location:/backpack");
				exit;
			}

			$wearItem = $db->query("UPDATE `users` SET `str`=?,`hp`=?,`def`=?,`wear`=?
									WHERE `id`=?", array(($user['str']+$item['str']),
														 ($user['hp']+$item['vit']),
														 ($user['def']+$item['def']),
														 ($item['id']),
														 ($user['id'])));
			$updateItemData = $db->query("UPDATE `backpack` SET `status`=? WHERE `id`=?",
										array('wear',$item['id']));

			$_SESSION['info'] = 'Набор успешно одет!';
			header("Location:/backpack");
			exit;
		}
		else
		{
			$_SESSION['error'] = 'На Вас уже что-то  одето!';
			header("Location:/backpack");
			exit;
		}


	break;


	case 'unwear';


	break;


	case 'del';



	break;


	case 'upgrade';


if ($user['backpack'] == 50)
	{
		//error message
	}
	else
	{
		if ($user['gold']>= $user['backpack']*100)
		{
			$upgradeQuery = $db->query("UPDATE `users` SET `backpack`=? WHERE `id`=?",
										array(($user['backpack']+1),$user['id']));

			//message hander
			header("Location:/backpack");
			exit;
		}
	}

	break;

	case 'repair';

	$id = isset($_GET['id']) ? (int) abs($_GET['id']) : null;

	$rowsItemCheck = $db->rows("SELECT * FROM `backpack` WHERE `id`=? and 
															   `user`=? and
															   `status`='destroy'",
																array($id,$user['id']));

	if ($rows == 1)
	{
		$item = $db->fetch("SELECT * FROM `backpack` WHERE `id`=?",
													array($id));

		$cost = round(($item['str']+$item['def']+$item['vit'])/1000);


		if($user['gold'] >=$cost)
		{
			$repairQuery = $db->query("UPDATE `backpack` SET `status`='unwear' WHERE `id`=?",
																			array($id));
			$_SESSION['message'] = 'Вещь успешно отремонтирована!';
		}
		else
		{
			$_SESSION['error'] = 'Не хватает золота!';
		}
		
		header("Location:/backpack");
		exit;
	}


	break;
}





include_once $config['root'].'/protected/footermain.php';


?>