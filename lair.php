<?php



$title ='Приключения';
include_once 'protected/sys.php';

////datas lair


$lairStages = array ("Лесной волк","Степной волк","Степной волк","Горный волк",
					"Оборотень");

echo $lairStages[$user['lair_stage']];