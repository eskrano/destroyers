<?php
$title = 'Уничтожители';
include_once __DIR__ . '/protected/sys.php';

if (! isset($user)) {

    if (isset($_POST['name']) && isset($_POST['password'])) {
        $nameAuth = trim(htmlspecialchars($_POST['name']));
        $passwordAuth = trim(htmlspecialchars($_POST['password']));

        if ($nameAuth == 'Боец') {
            header("Location:/");
            exit;
        }


        $sqlAuth = "SELECT * FROM `users` WHERE `login`=? and `password`=?";
        $plAuth = array($nameAuth, $passwordAuth);

        $rowsAuth = $db->rows($sqlAuth, $plAuth);

        if ($rowsAuth == 1) {
            $AuthClient = $db->fetch($sqlAuth, $plAuth);

            $_SESSION['id'] = $AuthClient['id'];
            $_SESSION['password'] = $passwordAuth;

            header("Location:/");
        } else {
            ?>
            <center>
                <font color='red'/>
                Не верный логин или пароль
                </font>
            </center>
            <?
        }
    }


    ?>


    <div class="content center">
        <img src="/imgData/static/pages/logo.jpg"/><br/> Новая эпическая игра Уничтожители!<br/>Уничтожь их всех!

    </div>
    <br/>
    <div class="сenter">
        <center>
            <a href="/start" class="ubtn mt-15 inbl green mb5">
				<span class="ul">
					<span class="ur">
						Начать путь уничтожителя
					</span>
				</span>
            </a>
        </center>
    </div>


    <div class="content center">

        <form action="" method="POST">
            Логин<br/>
            <input class='input' type="text" name="name" value=""/><br/>
            Пароль<br/>
            <input class='input' type="password" name="password" value=""/><br/>

            <span class="ubtn inbl green"><span class="ul"><input class="ur" type="submit" value="Войти"/></span></span>
        </form>

        <a href="/recover_pw" class="darkgreen_link">Забыли пароль?</a></div>
    </div>
    <?
} elseif (isset($user)) {
    $tt = $user['fights_reset'] - $config['time'];
    $h = $tt / 3600 % 60;
    $m = $tt / 60 % 60;
    $s = $tt % 60;

    ?>
    <div class='content'/>
    <div class="fl ml10 mt10 mr10">
        <a href="/arena"><img src="/imgData/static/arena.png"></a></div>
    <div class="ml10 mt10 mb10 mr10 sh small">
        <a class="medium lwhite tdn bold mt5" href="/arena">На Арену <?php echo  $user['fights'] > 0 ? '<font color = "green">+</font>': null;?></a><br>
        <?php echo  ($user['fights'] == 0 && $user['fights_reset'] > $config['time'] ? "<span class ='grey2'/> Ваши 15 боев на арене закончились, приходите через
								" . $h . "ч " . $m . "м " . $s . "с
		</span>
		" : "Осталось боев: " . $user['fights'] . "<br>"); ?>
    </div>
    <div class="clb"></div>
    </div>
    <?
}


include_once __DIR__ .'/protected/footermain.php';