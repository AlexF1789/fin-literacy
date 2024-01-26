<?php

    require "<path to the php folder>/php/data.php";

    session_start();

    if(isset($_SESSION['mail']) && $_SESSION['platform']=="fin-literacy" && isset($_GET['idArt']) && isset($_GET['state'])) {
        $idArt = $_GET['idArt'];
        $state = $_GET['state'];
        $mail = $_SESSION['mail'];

        if($state==1)
            query("INSERT INTO `articlesLike`(`idArt`, `mail`) VALUES ('$idArt','$mail')");
        else
            query("DELETE FROM articlesLike WHERE mail='$mail' AND idArt='$idArt'");

            header("location: /sources/pages/articles/article.php?id=$idArt&state=$state");
    } else
        header("location: /sources/pages/articles/");

?>