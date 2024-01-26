<?php

    require "<path to the php folder>/php/data.php";
    require "<path to the php folder>/php/loading.php";
    require "<path to the php folder>/php/notif.php";

    session_start();
    
    loading();

    if(isset($_SESSION['mail']) && $_SESSION['platform']=="fin-literacy" && isset($_POST['chatID'])) {
        $chatID = $_POST['chatID'];
        $mail = $_SESSION['mail'];
        query("UPDATE users SET telegram='$chatID' WHERE mail='$mail'");
        notify($mail,"you have correctly configured the Telegram notifications for your account.");
        header("location: /sources/pages/reserved/data.php?state=3");
    } else
        header("location: /");

?>