<?php 

$title = 'Новости разработки';

include_once '../protected/sys.php';

if (!$user OR $user['access']!='3')
{
	header("Location:/");
	exit;
}

?>
<a href = "https://github.com/eskrano/destroyers2015/commits" target = "_blank"> Следите тут за новостями! </a>
<?php 

include_once $config['root'].'/protected/footermain.php';