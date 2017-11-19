<?php

$title = 'Админ панель';

include_once '../protected/sys.php';

if (!$user OR $user['access'] != '3') {
    header("Location:/");
    exit;
}

?>
    <a class="mbtn mb2" href='/admin/dev_news'/><font color="green">Новости разработки</font> </a>
    <a class="mbtn mb2" href='/admin/ban'/>Баны </a>
    <a class="mbtn mb2" href='/admin/chat_clear'/> Очистка чата </a>
    <a class="mbtn mb2" href='/admin/exp_modifier'/> Модификатор опыта </a>
<?


include_once $config['root'] . '/protected/footermain.php';