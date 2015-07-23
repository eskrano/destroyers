<?php

/**
 * Destroyers
 * @version  0.05beta 
 * @author  Alex Priadko <ilovephp@spaces.ru>
 * @package  destroyers
 */


$title = 'Кланы';

require_once 'protected/sys.php';

$action = (isset($_GET['action']) ? htmlspecialchars(trim($_GET['action'])) : null);




switch ($action) 
{

	default:

	if ($user['clan'] == 0  )
	{
		if (isset($_POST['clanName']))
		{
			if (!preg_match('/[a-zа-я\ \-]{3,20}/i', $_POST['clanName']))
			{
				$error = 'Не верно введено название клана!';
			}

			if ($db->rows("SELECT * FROM `clans` WHERE `name`=?",$_POST['clanName']) == 1)
			{
				$error = 'Клан с таким названием уже есть!';
			}

			if ($user['gold'] < 2000)
			{
				$error = 'Не достаточно золота для создания клана!';
			}

			if ($error)
			{
				?>
				<font color ="red"><?php echo $error;?> </font>
				<?php
			} else {

				$db->query("INSERT INTO `clans` SET `name`=?,
													`create_at`=?,
													`lieder`=?",[$_POST['clanName'],time(),$user['id']
													]);

				header(
						sprintf(
							"Location:%s",
							'/clan.php'
							)
					);
				exit;

			}			


		}

		?>
		<div class ="content">
			<center>
				<form action  ="#" method="POST">
					<label for  ="clanName"> Введите название клана: </label>
					<br>
					<input type ="text" id "clanName" name ="clanName">
					<br>
					<input type ="submit" value = "Создать (2000золота)">
				</form>
			</center>
		</div>
		<?php
	}



	break;


}