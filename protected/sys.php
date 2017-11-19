<?php
ob_start();
session_start();
/**
 * Mrush Fun copy
 * @author Alex Priadko
 */


$start_time = microtime(true);

$config = __DIR__ . '/data/config.php';

if (!file_exists($config)) {
    throw new Exception("Game not installed. Read install instructions from Readme.md");
}

$config = require_once $config;

// others

require_once __DIR__ . '/other/filedb.php';

$fDb = new filedb();
$fDb->setPath(__DIR__ . '/filedb');


function post($key, $default = false) {
    if (isset($_POST[$key])) {
        return $_POST[$key];
    }
    return $default;
}

function loadModel($name, $db)
{
    $pathModels = __DIR__ . '/models';
    $mPath = sprintf("%s/%s.php", $pathModels, $name);

    if (!file_exists($mPath)) {
        throw new Exception("Model not found");
    }

    require $mPath;

    if (!class_exists($cName = sprintf("model%s", ucfirst($name)))) {
        throw new Exception("Model class not found");
    }

    return new $cName($db);
}

function __autoload($file)
{
    global $config;
    $path = $config['root'] . '/protected/' . $file . '.php';

    if (file_exists($path)) {
        include_once $path;
    } else {
        die ('Class ' . $file . ' not found! ');
    }
}

try {
    $database1 = new PDO('mysql:host=' . $config['dbhost'] . ';dbname=' . $config['dbname'] . '',
        $config['dbuser'], $config['dbpass']);
} catch (PDOException $e) {
    throw $e;
}
$db = new db($database1);
$db->noPrepared("SET sql_mode = ''");

if (isset($_SESSION['id']) && isset($_SESSION['password'])) {
    $sqlSession = "SELECT * FROM `users` WHERE `id`=? and `password`=? LIMIT 1";
    $plaseholdersSession = array($_SESSION['id'], $_SESSION['password']);

    $rowsSession = $db->rows($sqlSession, $plaseholdersSession);

    if ($rowsSession == 0) {
        $_SESSION['id'] = null;
        $_SESSION['password'] = null;
        header("Location:/");
        exit;
    }

    $user = $db->fetch($sqlSession, $plaseholdersSession);

}


if (isset($user)) {
    if (isset($_GET['logout'])) {
        $_SESSION['id'] = null;
        $_SESSION['password'] = null;
        header("Location:/");
        exit;
    }

    $sqlOnline = "UPDATE `users` SET `online`=? WHERE `id`=?";
    $plaseholdersOnline = array($config['time'], $user['id']);

    $updateUsersOnline = $db->query($sqlOnline, $plaseholdersOnline);

    $expLevel = require __DIR__ . '/data/exp.php';

}


////including header main

include_once __DIR__ . '/headermain.php';

//////////////////


if (isset($user)) {


    if ($user['fights'] == 0 && $user['fights_reset'] < $config['time']) {
        $updFights = $db->query("UPDATE `users` SET `fights`='15',`fights_reset`='0'
							WHERE `id`=?",
            array($user['id']));
        $_SESSION['info'] = 'Ваши бои на арене восстановлены! Можете продолжить сражения!';
    }

    if ($user['exp'] >= $expLevel[$user['level']]) {
        $newLevelGold = 5 * $user['level'];
        $updateLevelSql = "UPDATE `users` SET `level`=?,`exp`='0',`gold`=?
						   WHERE `id`=?";

        $updateLevelPl = array($user['level'] + 1, $user['gold'] + $newLevelGold,
            $user['id']);

        $updateLevelQuery = $db->query($updateLevelSql, $updateLevelPl);
        ?>

        <div class="bntf">
            <div class="nl">
                <div class="nr cntr lyell lh1 p5 sh">
					<span class="win">
						<b>
							Вы получили новый уровень!
							<br>
							Награда: 
							<img class="icon" src="http://144.76.127.94/view/image/icons/gold.png">
							5
						</b>
					</span>
                    <br>
                </div>
            </div>
        </div>

        <?
    }


}


if (isset($paginate) && $paginate === 1) {
    include_once 'page.php';
}

