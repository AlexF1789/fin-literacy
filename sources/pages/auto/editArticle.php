<?php

    require "<path to the php folder>/php/data.php";
    require "<path to the php folder>/php/notif.php";

    session_start();
    $idArt = $_POST['idArt'];
    $mail = $_SESSION['mail'];

    if(isset($_SESSION['mail']) && $_SESSION['platform']=="fin-literacy" && $_SESSION['role']=='1' && $_SERVER['REQUEST_METHOD']=="POST" || !query("SELECT title FROM articles WHERE id='$idArt' AND author='$mail'")->num_rows) {
        
        $title = $_POST['title'];
        $text = $_POST['text'];

        query("UPDATE articles SET title=\"$title\", text=\"$text\" WHERE id='$idArt' AND author='$mail'");

        if(query("SELECT id FROM articles WHERE author='$mail' AND title=\"$title\"")->num_rows) {
            notify($mail,"you've correctly edited the article $title.");
            header("location: /sources/pages/reserved/writer/manageArticles.php?state=7");
        } else
            header("location: /sources/pages/reserved/writer/manageArticles.php?state=8");

    } else
        header("location: /");


?>