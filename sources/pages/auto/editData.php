<?php

    require "<path to the php folder>/php/data.php";
    require "<path to the php folder>/php/loading.php";
    require "<path to the php folder>/php/notif.php";

    session_start();

    if(isset($_SESSION['mail']) && $_SESSION['platform']=='fin-literacy' && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['nationality'])) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $nationality = $_POST['nationality'];
        $mail = $_SESSION['mail'];

        query("UPDATE `users` SET `name`='$name', `surname`='$surname', `nationality`='$nationality' WHERE `mail`='$mail'");
        notify($mail,"you've updated your account information. You'll see the new one from the following login.");

        header("location: /sources/pages/reserved/data.php?state=5");
    } else {
        header("location: /");
    }

?>