<?php
$title = 'Тренировка';
include_once 'protected/sys.php';

$types = array ('t_str','t_hp','t_def');
$imagesT = array('strength','health','defense');
$descriptions = array ('Увеличивает наносимый врагам урон',
						'Увеличивает запас здоровья',
						'Поглощает урон врага');
$namesS = array ("Сила","Здоровье","Защита");

function _value ($var)
{
	if ($var == 5 OR $var ==10 OR $var ==15 OR $var ==20 
		OR $var ==25 OR $var ==30 OR $var ==35 OR $var == 40
		OR $var == 45 OR $var == 50 OR $var ==55 OR $var ==60
		OR $var ==65 OR $var ==70)
	{
		return 'gold';
	}

	return 'silver';
}
function _cost ($var)
{
	if ($var == 5 OR $var ==10 OR $var ==15 OR $var ==20 
	OR $var ==25 OR $var ==30 OR $var ==35 OR $var == 40
	OR $var == 45 OR $var == 50 OR $var ==55 OR $var ==60
	OR $var ==65 OR $var ==70)
	{
		$data = array (5=>5,10=>20,15=>50,20=>100,
						25=>200,30=>400,35=>800,
						40=>1500,45=>2500,50=>2500,
						55=>2500,60=>2500,65=>2500,70=>2500);
	}
	else
	{
		$data = array (0=>50,1=>50,2=>100,3=>150,4=>200,
						6=>400,7=>600,8=>800,9=>1000,
						11=>1500,12=>2500,13=>3500,14=>5000,
						16=>7000,17=>9600,18=>12000,19=>15000,
						21=>18000,22=>21000,23=>24000,24=>27000,
						26=>30000,27=>34000,28=>38000,29=>42000,
						31=>46000,32=>50000,33=>54000,34=>60000,
						36=>75000,37=>80000,38=>85000,39=>90000,
						41=>90000,42=>105000,43=>120000,44=>135000,
						46=>150000,47=>200000,48=>250000,49=>300000,
						51=>450000,52=>500000,53=>550000,54=>600000,
						56=>700000,57=>800000,58=>900000,59=>1000000,
						61=>1250000,62=>1500000,63=>1750000,64=>2000000,
						66=>2500000,67=>3000000,68=>3500000,69=>4000000);		
	}

	return $data[$var];
}


if (isset($_GET['train']))
{
	$train  = htmlspecialchars(trim($_GET['train']));

	if ($user[$train] >69 )
	{
		$_SESSION['error'] = 'Максимальный уровень!';
		header("Location:/train");
		exit;	
	}

	if ($train == 't_str')
	{
		if ($user[_value($user['t_str'])] >= _cost($user['t_str'])) 
		{
			//если хватает на левел ап

			//$valueUp =$values[$user['t_str']];

			$valueUp = _value($user['t_str']);

			$upLevelTrainSql = "UPDATE `users` SET `t_str`=?,`$valueUp`=?,`str`=?
								WHERE `id`=?";
			$upLevelTrainPl =  array(($user['t_str']+1),($user[$valueUp]-_cost($user['t_str'])),
									($user['str']+3),$user['id']);

			$upLevelTrain = $db->query($upLevelTrainSql,$upLevelTrainPl);


			$_SESSION['info'] = 'Сила +3';
			header("Location:/train");
			exit;
		}
		else
		{
			$_SESSION['error'] = 'Вам не хватает средств!';
			header("Location:/train");
			exit;			
		}
	}
	elseif ($train  == 't_def')
	{
		if ($user[_value($user['t_def'])] >= _cost($user['t_def'])) 
		{
			//если хватает на левел ап

			//$valueUp =$values[$user['t_str']];

			$valueUp = _value($user['t_def']);

			$upLevelTrainSql = "UPDATE `users` SET `t_def`=?,`$valueUp`=?,`def`=?
								WHERE `id`=?";
			$upLevelTrainPl =  array(($user['t_def']+1),($user[$valueUp]-_cost($user['t_def'])),
									($user['def']+3),$user['id']);

			$upLevelTrain = $db->query($upLevelTrainSql,$upLevelTrainPl);


			$_SESSION['info'] = 'Броня +3';
			header("Location:/train");
			exit;
		}
		else
		{
			$_SESSION['error'] = 'Вам не хватает средств!';
			header("Location:/train");
			exit;			
		}		
	}
	elseif ($train == 't_hp')
	{
		if ($user[_value($user['t_hp'])] >= _cost($user['t_hp'])) 
		{
			//если хватает на левел ап

			//$valueUp =$values[$user['t_str']];

			$valueUp = _value($user['t_hp']);

			$upLevelTrainSql = "UPDATE `users` SET `t_hp`=?,`$valueUp`=?,`hp`=?
								WHERE `id`=?";
			$upLevelTrainPl =  array(($user['t_hp']+1),($user[$valueUp]-_cost($user['t_hp'])),
									($user['hp']+3),$user['id']);

			$upLevelTrain = $db->query($upLevelTrainSql,$upLevelTrainPl);


			$_SESSION['info'] = 'Здоровье +3';
			header("Location:/train");
			exit;
		}
		else
		{
			$_SESSION['error'] = 'Вам не хватает средств!';
			header("Location:/train");
			exit;			
		}		
	}
	else
	{
		$_SESSION['error'] = 'Вы ввели ошибочный запрос! Если ошибка повторяеться - сообщите Администрации!';
		header("Location:/train");
		exit;		
	}
}



for ($i = 0; $i <3; $i++)
{


	?>
	<div class ='content'/>
	<div class="fl ml10 mt10">
	<img class="item_icon" src="http://144.76.127.94/view/image/train/<?=$imagesT[$i];?>.png">
	</div>
	<div class="ml68 mt10 mb10 mr10 sh small lorange">
	<span class="medium lwhite tdn"><span class="darkgreen_link"><?=$namesS[$i];?> </span><span class="darkgreen_link font_15"><span class ='win'/>+<?=$user[$types[$i]]*3;?></span>
	</span></span><br>
	<span><span class="text_small"><?=$descriptions[$i];?></span><br>Уровень: <?=$user[$types[$i]];?> из 70</span>
	</div>
	</div>

<?php
if ($user[$types[$i]] < 70)
{
		?>
		<br/>
		<center>
		<a href="?train=<?=$types[$i];?>" class="ubtn inbl green mb5 mt-15 ml5 mr5">
			<span class="ul">
				<span class="ur">
					Тренировать  за 
					<img src="http://144.76.127.94/view/image/icons/<?=_value($user[$types[$i]]);?>.png" class="icon">
					<?=_cost($user[$types[$i]]);?>
				</span>
			</span>
		</a>
	</center>
		<?
}

}


include_once $config['root'].'/protected/footermain.php';