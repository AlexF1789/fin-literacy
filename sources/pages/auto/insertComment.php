<?php

    require "<path to the php folder>/php/data.php";
    require "<path to the php folder>/php/notif.php";

    session_start();

    if(isset($_SESSION['mail']) && $_SESSION['platform']=="fin-literacy" && $_SERVER['REQUEST_METHOD']=="POST") {
        $idArt = $_POST['idArt'];
        $comment = $_POST['comment'];
        $date = date("Y-m-d");
        $mail = $_SESSION['mail'];

        query("INSERT INTO `comments`(`idArt`, `mail`, `text`, `date`) VALUES ('$idArt','$mail',\"$comment\",'$date')");

        if(query("SELECT id FROM comments WHERE idArt='$idArt' AND mail='$mail' AND text=\"$comment\"")->num_rows) {
            notify($mail,"you've correctly commented an article on the website");
            header("location: /sources/pages/articles/article.php?id=$idArt&state=2");
        } else
            header("location: /sources/pages/articles/article.php?id=$idArt&state=3");
    } else
        header("location: /sources/pages/articles/");

?>