<?php

$title =  'Поиск игрока';
include_once 'protected/sys.php';

if (isset($_POST['nickName']))
{
	$nick = htmlspecialchars(trim($_POST['nickName']));

	$rowsNick = $db->rows("SELECT `id`,`login` FROM `users` WHERE `login`=?",
						  array($nick));

	if ($rowsNick == 1)
	{
		$parseD = $db->fetch("SELECT `id`,`login` FROM `users` WHERE `login`=?",
							array($nick));

		$_SESSION['info'] = 'Игрок найден!';
		header("Location:/user?id=".$parseD['id']);
		exit;
	}
	else
	{
		$_SESSION['error'] = 'Игрок не найден!';
		header("Location:/search_user");
		exit;
	}
}

?>
<div class ='content'/>
	<center>
		Введите ник того игрока которого хотите найти:<br/>
		<form action = '' method='post'/>
		<input class ='input' type ='text' name ='nickName' placeholder ='Введите ник'/><br/>
		<span class="ubtn inbl green">
			<span class="ul">
				<input class="ur" type="submit" value="Поиск" />
			</span>
		</span>
	</center>
</div>

<?

include_once $config['root'].'/protected/footermain.php';
