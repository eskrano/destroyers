<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="author" content="фаны">
    <meta name="keywords"
          content="разрушители, онлайн игра, пвп, сражения, pvp, приключения, прокачка героя, арена, битва, турнир, подземелья, бесплатная, mmorpg">
    <meta name="viewport" content="width=device-width; minimum-scale=1; maximum-scale=1">
    <link rel="icon" href="http://144.76.127.94/view/image/icons/favicon.png?1" type="image/png">
    <link rel="stylesheet" type="text/css" media="all" href="http://144.76.127.94/view/style/index.css?1.7.6">
    <title><?= isset($title) ? $title : 'Destroyers'; ?></title>
    <style>


        .content {
            background-color: #122027;
            background-image: url("/imgData/protected/viev/art/bg-brd-shd_blue.png");
            background-position: 0px 100%;
            background-repeat: repeat-x;
            border: 1px solid #70593F;
            padding: 2px;
            padding-left: 3px;
            margin: auto;
            box-shadow: inherit;
        }

        .input {
            padding: 3px;
            border: 1px solid black;
            background-color: #EFEFEF;
        }

        .line {
            height: 2px;
            background-color: #70593F;
        }

        .center {
            text-align: center;
        }

    </style>
</head>
<body>

<?php


if (isset($user)) {
    $expProgress = round(100 / ($expLevel[$user['level']] / ($user['exp'] + 1))) + 1;

    if ($expProgress > 100) {
        $expProgress = 100;
    }

    ?>
    <div class="cntr small lorange mt5 mb5">
        <img class="icon" src="/imgData/static/str.png"><?= $user['str']; ?>
        <img class="icon" src="/imgData/static/hp.png"> <?= $user['hp']; ?>
        <img class="icon" src="/imgData/static/def.png"> <?= $user['def']; ?>
    </div>
    <div class='line'/></div>
    <table class="small yell h25 bgc_prg">
        <tbody>
        <tr>
            <td class="va_m plr10 nwr"><img src="/imgData/static/level.png" class="va_t" alt="" height="16" width="16">
                <?= $user['level']; ?>
            </td>
            <td class="va_m w100">
                <div class="prg-bar">
                    <div class="prg-blue" style="width:<?= $expProgress; ?>%;"></div>
                </div>
            </td>
            <td class="va_m plr10"><?= $expProgress; ?>%</td>
        </tr>
        </tbody>
    </table>


    <?
} else {


    //guest main header


}
if ($_SERVER['PHP_SELF'] != '/index.php') {
    ?>
    <div class="ribbon mb2">
        <div class="rl">
            <div class="rr">
                <?= $title; ?>
            </div>
        </div>
    </div>
    <?
}

if (isset($_SESSION['info'])) {
    ?>
    <div class="bntf">
        <div class="nl">
            <div class="nr cntr lyell lh1 p5 sh">
				<span class="win">
					<?= $_SESSION['info']; ?>
				</span>
            </div>
        </div>
    </div>
    <?
    $_SESSION['info'] = null;
}

if (isset($_SESSION['error']))
{
?>
<div class="bntf">
    <div class="nl">
        <div class="nr cntr lyell lh1 p5 sh">
				<span class="lose">
					<?= $_SESSION['error']; ?>
				</span>
        </div>
    </div>
</div>
<?
$_SESSION['error'] = null;
}
