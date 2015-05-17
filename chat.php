<?php


$paginate = 1;
$title = 'Чат';
include_once 'protected/sys.php';

if (!$user)
{
	header("Location:/");
	exit;
}

if (isset($_GET['post']))
{
	$message = htmlspecialchars($_POST['text']);

	if (isset($_POST['to']))
	{
		$to = (int) abs($_POST['to']);
	}

	if (mb_strlen($message)<5 OR mb_strlen($message)>250)
	{
		$error = 'Длина 5-250 символов!';
	}

	if (!$to)
	{
		$to = 0;
	}

	if ($error)
	{
		$_SESSION['error'] =  $error;
		header("Location:/chat");
		exit;
	}
	else
	{
		$insC = $db->query("INSERT INTO `chat` SET `text`=?,`user`=?,`time`=?,`to`=?",
							array($message,$user['id'],$config['time'],$to));
		header("Location:/chat");
		exit;
	}

}
$c = 10;
$k_post = $db->rows("SELECT `id` FROM `chat`",array());
$k_page = k_page($k_post,$c);
$page = page($k_page);
$start = $c*$page-$c;


$db->offEmulate();
$chatMessages = $db->fetchAll("SELECT * FROM `chat` ORDER BY `id` DESC LIMIT ?,?",
							array($start,$c));


?>
<div class ='content'/>
<center>
<form action ='?post' method = 'POST'/>
	<?php
	if (isset($_GET['to']) && is_numeric($_GET['to']))
	{

		$tolog = $db->fetch("SELECT * FROM `users` WHERE `id`=? ",array(abs(intval($_GET['to']))));

		if ($tolog)
		{
			?>
			<input type ='hidden' name ='to' value = '<?=$tolog['id'];?>'/>
			<input type ='text' name ='text' class ='input' style = 'width:90%;' value ='<?=$tolog['login'];?>,' required/>
			<?
		}
	}
	else
	{
		?>
		<input type ='text' name ='text' class ='input' style = 'width:90%;'  required/>
		<?
	}
	?>

<span class="ubtn inbl green"><span class="ul"><input class="ur" type="submit" value="Отрпавить" /></span></span>
</form>
</center>
<a href = '/chat?rand=<?=rand(100,999);?>'/>Обновить</a>
</div>
<?




if ($k_post == 0)
{
	?>
	<div class ='content'/>
		Нет сообщений...
	</div>
	<?
}
else
{
echo  '<div class = \'content\'/>';
$fonts = array ('','#ECEF3A','#EF543A','#4DE137','','#15DEFF');


foreach ($chatMessages as $data) {
	$userMessage = $db->fetch("SELECT * FROM `users` WHERE `id`=?",
							  array($data['user']));
	if ($data['user'] == 0)
	{
		$userMessage['login'] = 'Система';
		$userMessage['sex'] = 1;
		$userMessage['access'] = 1;
	}

	?>
	<img src = '/imgData/static/<?=$userMessage['sex'];?>.png'/>
	<?
	if ($userMessage['id']!= 0)
	{
		?>	
		<a href ='/user?id=<?=$userMessage['id'];?>'/><?=$userMessage['login'];?></a>
		<?	
	}
	else
	{
		?>
	<?=$userMessage['login'];?>
		<?
	}
	if ($user['id'] !=$data['user'] && $data['user']!=0)
	{

	?>
	<a href ='/chat?to=<?=$data['user'];?>'/>(>>)</a>
	<?
	}
	?>
	:
	<?php
	if ($data['to']== $user['id'])
	{
		?>
	 <i><font color = '<?=$fonts[5];?>'/><?=htmlspecialchars($data['text']);?></i>	
	</font>
	<?
	}
	else
	{
		?>
		<font color = '<?=$fonts[$userMessage['access']];?>'/><?=htmlspecialchars($data['text']);?>
	</font>
		<?
	}
	?>
	<br/>

	<?


}

if ($k_page>1){
?>


<div class="hr_arr mt2 mb2 mlr10">
	<div class="alf">
		<div class="art">
			<div class="acn">
			</div>
		</div>
	</div>
</div>
<center>
<?


str('?',$k_page,$page); // Вывод страниц


?>
</center>
<div class="hr_arr mt2 mb2 mlr10">
	<div class="alf">
		<div class="art">
			<div class="acn">
			</div>
		</div>
	</div>
</div>

<?
}

echo '</div>';
}



include_once $config['root'].'/protected/footermain.php';




