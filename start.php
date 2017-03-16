<?php

$title = 'Возвращение домой';
include_once 'protected/sys.php';

if (isset($_GET['attack'])) {
    if (isset($_GET['register'])) {
        $usersCounter = $db->rows("SELECT COUNT (`id`) FROM `users`");
        $idNew = $usersCounter + 1;

        $regUserSql = "INSERT INTO `users` SET `login`=?,`password`=?";
        $passwordNewUs = rand(100000, 200000);
        $regUserPh = array("Боец", $passwordNewUs);

        $regUser = $db->query($regUserSql, $regUserPh);

        $_SESSION['id'] = $db->last();
        $_SESSION['password'] =& $passwordNewUs;

        header("Location:/");
        exit;
    }


    ?>

    <div class="bntf">
        <div class="nl">
            <div class="nr cntr lyell lh1 p5 sh">
                Волк отступил, но он охранял что-то ценное
                <div class="mb10"></div>
                <span class="win"><b>Награда:</b></span>
                <div class="mb5"></div>
                Серебро <img class="icon" src="http://144.76.127.94/view/image/icons/silver.png">12, Опыт <img
                        class="icon" src="http://144.76.127.94/view/image/icons/expirience.png">9
                <div class="mb5"></div>
                <div class="inbl lft mt5 w200px">
                    <div class="fl mr5">
                        <img class="item_icon" src="http://144.76.127.94/view/image/item/chest1.png">
                    </div>
                    <div class="ml58 nwr">
                        Серебряный сундук
                    </div>
                </div>
                <div class="cntr"><a href="?attack&amp;register" class="ubtn inbl mt10 green mb5"><span class="ul"><span
                                    class="ur">Продолжить путь</span></span></a></div>
            </div>
        </div>
    </div>


    <?
} else {


    ?>
    <div class="bntf">
        <div class="nl">
            <div class="nr cntr lyell lh1 p5 sh">
                Возвращаясь из похода вы встретили Волка <br><span class="small">— Придется с ним сразиться, чтобы пройти дальше</span>
            </div>
        </div>
    </div>
    <?php
}
?>
    <div class='line'/></div>
    <div class='content'/>
    <center>
        <a href='?attack'/>
        <img src='http://144.76.127.94/view/image/lair/lair1_nowin.jpg'/>
    </center>
    </div>
    <br/>
    <center>
<span class="ubtn mt-15 inbl red mb5">
<span class="ul">
<span class="ur">
Атаковать
</span>
</span>
</span>
    </center>
    <div class='line'/></div>
<?
include_once 'protected/footermain.php';