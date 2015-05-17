<?php

$title = 'Сохранение';
include_once 'protected/sys.php';

if ($user['save'] == 1 OR !$user)
{
	header("Location:/");
	exit;
}


if (isset($_GET['submit']))
{
	$login = htmlspecialchars($_POST['nick']);
	$password =  htmlspecialchars($_POST['password']);
	$mail = htmlspecialchars($_POST['mail']);
	$sex = htmlspecialchars($_POST['sex']);

	if (!preg_match("/^[a-z]+$/i",$login) && mb_strlen($login)<3  OR mb_strlen($login)>15)
	{
		$error = 'Длина ника 3-15 символов, разрешены латинские буквы';
	}

	if (!preg_match("/^[A-Z0-9]+$/i",$password) && mb_strlen($password)<6  OR mb_strlen($password)>25)
	{
		$error = 'В пароле разрешены латинские символы и цыфры, длина 6-25 символов';
	}

		if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
	{
		$error = 'E-mail  указан не верно!';
	}

	if ($sex>1 OR $sex<0)
	{
		$error = 'Лол.';
	}

	$rowsNick = $db->rows("SELECT * FROM `users` WHERE `login`=?",
							array ($login));

	if ($rowsNick >=1)
	{
		$error = 'Такой ник уже используеться.';
	}

	if ($error)
	{
		$_SESSION['error'] =  $error;
		header("Location:/save_user");
		exit;
	}
	else
	{
		$updData = $db->query("UPDATE `users` SET `login`=?,`password`=?,
							  `sex`=?,`mail`=?, `gold`=?, `save`='1' WHERE `id`=?",
							  array($login,$password,$sex,$mail,
							  		($user['gold']+5),
							  		$user['id']));
		$_SESSION['info'] = 'Данные успешно сохранены!';
		$_SESSION['password'] =&$password;
		header("Location:/");
		exit;
	}

}


?>


<div class="bntf">
	<div class="nl">
		<div class="nr cntr lyell lh1 p5 nd sh">
			За сохранение вы получите 
			<span class="nowrap">
				<img class="icon" src="http://144.76.127.94/view/image/icons/gold.png">
				5
			</span> 
			золота!
		</div>
	</div>
</div>

<div class ='content'/>
	<center>
		<form action = '?submit' method = 'POST'/>
			Имя <br/>
			<input class = 'input' type ='text' name = 'nick' required/>
			<br/>
			Пароль: <br/>
			<input class = 'input' type ='password' name ='password' required/>
			<br/>
			E-mail:<br/>
			<input class = 'input' type ='text' name ='mail' required/>
			<br/>
			Пол: <br/>
			<select name ='sex' class = 'input'/>
				<option value ='0'> Мужской</option>
				<option value ='1'> Женский</option>
			</select><br/>
			<span class="ubtn inbl green">
				<span class="ul">
					<input class="ur" type="submit" value="Сохраниться" />
				</span>
			</span>
		</form>
	</center>
</div>

<?php

include_once $config['root'].'/protected/footermain.php';