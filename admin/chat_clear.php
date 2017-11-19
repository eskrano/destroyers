<?php
$title = 'Очистка чата';
require_once __DIR__ . '/../protected/sys.php';

/** @var modelChat $chat */
$chat = loadModel('Chat', $db);

if (isset($_GET['clear'])) {
    $chat->clear();
    $_SESSION['info'] = 'Чат очищен';
    header("Location:?");
    exit;
}

?>

<div class="content">
    <p>
        Всего сообщений: <?php echo $chat->countMessages();?><br>
        <a class = "mbtn mb2" href = "?clear">Очистить</a>
    </p>
</div>
<?php

require_once __DIR__ . '/../protected/footermain.php';
