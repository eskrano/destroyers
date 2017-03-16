<?php

$path = __DIR__ . '/protected/data/config.php';

if (file_exists($path)) {
    throw new Exception(
        sprintf("You already have config.php file . Remove the install file and setup your config in %s", $path));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_c_path = __DIR__ . '/protected/data';

    copy(sprintf("%s/config_example.php",$_c_path),
        sprintf("%s/config.php",$_c_path)
        );

    exit('App installed . Remove /install.php');
}

?>

<h1>Destroyers 2017 16 March installer</h1>
<br>
<form action="#" method = "POST">
    <input type="hidden" name = "_q" value = "<?=$q;?>">
    <button type = "submit">Install</button>
</form>

