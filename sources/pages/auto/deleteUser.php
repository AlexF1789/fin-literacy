<?php

    require "<path to the php folder>/php/data.php";
    require "<path to the php folder>/php/mailer/mailsender.php";

    session_start();

    if(!isset($_SESSION['mail']) || $_SESSION['platform']!="fin-literacy" || $_SESSION['role']!='2')
        header("location: /sources/pages/logout.php");

    if($_SERVER['REQUEST_METHOD']=="POST") {

        $mail = $_POST['mail'];
        if(query("SELECT * FROM users WHERE mail='$mail'")->num_rows) {
            query("DELETE FROM users WHERE mail='$mail'");
            query("DELETE FROM articlesLike WHERE mail='$mail'");
            query("DELETE FROM comments WHERE mail='$mail'");
            //query("DELETE FROM articles WHERE mail='$mail'");
            header("location: /sources/pages/reserved/admin/index.php?state=6");
        } else
            header("location: /sources/pages/reserved/admin/index.php?state=5");

    }

?>