<?php

$title  ='Настройки';

include_once '../protected/sys.php';

if (!$user)
{
	header("Location:/");
	exit;
}


?>
<div class ='content'/><center>
	<a href="/settings/change_name" class="ubtn inbl green mb10 w200px">
		<span class="ul">
			<span class="ur lft">
				<img class="icon" src="/imgData/static/edit_name.png">Изменить имя
			</span>
		</span>
	</a>

	<a href="/settings/gender" class="ubtn inbl green mb10 w200px">
		<span class="ul">
			<span class="ur lft">
				<img class="icon" src="/imgData/static/gender.png">Сменить свой пол
			</span>
		</span>
	</a>

	<a href="/settings/password" class="ubtn inbl green mb10 w200px">
		<span class="ul">
			<span class="ur lft">
				<img class="icon" src="/imgData/static/password.png">Сменить пароль
			</span>
		</span>
	</a>	
	<a href="/?logout" class="ubtn inbl green mb10 w200px">
		<span class="ul">
			<span class="ur lft">
				<img class="icon" src="/imgData/static/logout.png">Выйти
			</span>
		</span>
	</a>
	<br/>
	ID  персонажа: <?=$user['id'];?>	
</center></div>
<?

include_once $config['root'].'/protected/footermain.php';