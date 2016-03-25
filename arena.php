<?php

$title = 'Арена';
include_once 'protected/sys.php';

if (!$user)
{
	header("Location:/");
	exit;
}

$has_users = $db->rows("SELECT `id` FROM `users` WHERE `id` != ?",[
   $user['id'] 
]);

if ($has_users == 0) {
    $_SESSION['error'] = 'Нет доступных противников!';
    header("Location:/");
    exit;
}


if ($user['fights'] == 0 && $user['fights_reset'] > $config['time'])
{
	$tt = $user['fights_reset'] - time();
	$h = $tt/3600%60;
	$m = $tt/60%60;
	$s = $tt%60;

	?>
	<div class ='content'/>
		<span class ='grey2'/> Ваши 15 боев на арене закончились, приходите через
								<?=$h;?>ч <?=$m;?>м <?=$s;?>с
		</span>
	</div>
	<?
	include_once $config['root'].'/protected/footermain.php';
	exit;
}


if (isset($_POST['attack']))
{
	$attack = (int) abs($_POST['attack']);

	$checkUser = $db->rows("SELECT `id` FROM `users` WHERE `id`=?",
							array($attack));

	if ($checkUser == '0')
	{
		$_SESSION['error'] = 'Такой противник не найден!';
		header("Location:/arena");
		exit;
	}

	$enemy = $db->fetch("SELECT * FROM `users` WHERE `id`=?",
						array($attack));

	$userDMG = round(rand($user['str']/6,$user['str']/4));
	$enemyDMG = round(rand($enemy['str']/6,$enemy['str']/4));

	$userDEF = round(rand($user['def']/4,$user['def']/6));
		$enemyDEF = round(rand($enemy['def']/4,$enemy['def']/6));

	$damageUSER = $userDMG - $enemyDEF;
	$damageENEMY = $enemyDMG - $userDEF;

	if ($damageUSER < 0)
	{
			$damageUSER = rand(1,$user['level']);
	}

	if ($damageENEMY < 0)
	{
		$damageENEMY = rand(1,$enemy['level']);
	}



	if ($damageUSER > $damageENEMY)
	{
		$exp = rand($enemy['level']*2,$user['level']*3);
		$silver = $damageUSER - $damageENEMY *3;
	}
	else
	{
		$exp = 2;
		$silver = 3;
	}



	if ($user['fights'] - 1 == 0)
	{
		$updateFights = $db->query("UPDATE `users` SET `fights_reset`=? 
									WHERE `id`=?",
									array(($config['time']+(3600*2)),
										  ($user['id'])));

	}

	$updateUser = $db->query("UPDATE `users` SET `exp`=?,`silver`=?,`fights`=`fights`-'1',`rating`=? WHERE `id`=?",
								array(($user['exp']+$exp),
									  ($user['silver']+$silver),
									  ($user['rating'] + ($damageUSER>$damageENEMY ? 2:1)),
									  ($user['id'])));


	$log= '<center>
			'.($damageUSER>$damageENEMY ? '<b>ПОБЕДА</b>':'<span class =\'lose\'/>ПОРАЖЕНИЕ</span>').'
			<br/>
			<span class =\'win\'/>Вы нанесли: '.$damageUSER.'
			<img src =\'/imgData/static/str.png\'/> урона </span>
			<br/>
			<span class =\'lose\'/>Вы получили: '.$damageENEMY.'
			<img src =\'/imgData/static/str.png\'/> урона </span>
			<br/>
			За бой вы получили : '.$silver.' <img src = \'/imgData/static/silver.png\'/>
			'.$exp.'<img src = \'/imgData/static/exp.png\'/>
			<br/>
			</center>'; 

	$_SESSION['info'] = $log;
	header("Location:/arena");
	exit;


}

$opponent = $db->fetch("SELECT * FROM `users` WHERE  `id`!=? ORDER BY RAND()",
						array($user['id']));

if ($opponent['wear'] > 0)
{
	$opponentWear = $db->fetch("SELECT * FROM `backpack` WHERE `id`=?",
								array($opponent['wear']));
} else {
	$opponentWear = 0;
}

?>

<div class ='content'/>
	<center>
		<?=$opponent['login'];?>
	</center>
	<left>
		<img width ='120' height='160' 
		src ='/imgData/static/co/<?=($opponent['sex'] == 0 ? 0:1);?>/<?=$opponent['wear'];?>.jpg'/>
	</left>
</div>
<div class ='content'/>
	<img src='/imgData/static/str.png'/>Сила: <?=$opponent['str'];?><br/>
	<img src='/imgData/static/hp.png'/>Здоровье: <?=$opponent['hp'];?><br/>
	<img src='/imgData/static/def.png'/>Защита: <?=$opponent['def'];?><br/>
</div>
<center>
<form action  = '' method='post'/>
	<input type ='hidden' value ='<?=$opponent['id'];?>' name ='attack'/>
	<span class="ubtn inbl green">
		<span class="ul">
			<input class="ur" type="submit" value="Атаковать" />
		</span>
	</span>	
</form>
</center>


<?php

include_once $config['root'].'/protected/footermain.php';