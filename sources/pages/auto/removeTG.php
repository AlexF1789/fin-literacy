<?php

    require "<path to the php folder>/php/data.php";
    require "<path to the php folder>/php/loading.php";
    require "<path to the php folder>/php/notif.php";

    session_start();

    loading();

    if(isset($_SESSION['mail']) && $_SESSION['platform']=="fin-literacy") {
        $mail = $_SESSION['mail'];
        notify($mail,"the Telegram notifications for this account have been disabled.");
        query("UPDATE users SET telegram=NULL WHERE mail='$mail'");
        header("location: /sources/pages/reserved/data.php?state=4");
    } else
        header("location: /");

?>