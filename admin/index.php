<?php

$title = 'Админ панель';

include_once '../protected/sys.php';

if (!$user OR $user['access']!='3')
{
	header("Location:/");
	exit;
}

?>

<a class="mbtn mb2" href ='/admin/ban'/>Баны </a>
<?



include_once $config['root'].'/protected/footermain.php';