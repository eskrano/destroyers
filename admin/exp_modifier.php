<?php

$title = "Модификатор опыта";

require_once __DIR__ . '/../protected/sys.php';

define("FDBNAME", 'exp_modifier');

/** @var $fDb filedb */

if (count($fDb->open(FDBNAME)) === 0) {

    $data = [
        'value' => 10,
        'active' => true,
        'time' => [
            'start' => '16:00',
            'end' => '4:00',
        ],
    ];


    $fDb->save(FDBNAME, $data);

    $_SESSION['info'] = "Начальные настройки установлены!";
    header("location:?");
    exit;
}

$row = $fDb->open(FDBNAME);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $value = post('value');
    $active = post('active');
    $time_start = post('time_start');
    $time_end = post('time_end');

    $data = [
        'value' => $value,
        'active' => $active,
        'time' => [
            'start' => $time_start,
            'end' => $time_end,
        ],
    ];

    $fDb->save(FDBNAME, $data);

    $_SESSION['info'] = "Настройки изменены!";
    header("location:?");
    exit;
}

?>


    <div class="content">
        <form action="#" method="POST">
            <div>
                + Опыта за бой : <br>
                <input type="number" name="value" value="<?= $row['value']; ?>" required/>
            </div>
            <div>
                Активация: <br>
                <input type="checkbox" name="active" value="1" <?= ($row['active']) ? 'checked' : null; ?>>
            </div>
            <div>
                Время старта: <br>
                <input type="text" name="time_start" value="<?= $row['time']['start']; ?>">
            </div>
            <div>
                Время окончания: <br>
                <input type="text" name="time_end" value="<?= $row['time']['end']; ?>">
            </div>
            <div>
                <input type="submit" value="Сохранить"/>
            </div>
        </form>

        <br>

        <?=date("H:i")?>
    </div>

<?php

require_once __DIR__ . '/../protected/footermain.php';