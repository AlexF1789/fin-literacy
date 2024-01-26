<?php

    require "<path to the php folder>/php/data.php";
    require "<path to the php folder>/php/notif.php";

    session_start();

    if(isset($_SESSION['mail']) && $_SESSION['platform']=="fin-literacy" && isset($_GET['idComm']) && isset($_GET['idArt'])) {
        $idComm = $_GET['idComm'];
        $idArt = $_GET['idArt'];
        $mail = $_SESSION['mail'];

        $authorQuery = query("SELECT articles.author FROM articles, comments WHERE articles.id=comments.idArt AND comments.idArt='$idArt'");
        if($authorQuery->num_rows) {
            while($a=mysqli_fetch_row($authorQuery))
                $author = $a[0];

            if($author==$mail) {
                deleteComment($idComm, $mail, $idArt);

            } else {
                
                if(query("SELECT * FROM comments WHERE id='$idComm' AND mail='$mail'")->num_rows) {
                    deleteComment($idComm, $mail, $idArt);
                } else
                    header("location: /sources/pages/articles/");

            }
        } else
            header("location: /sources/pages/articles/");
        
    } else
        header("location: /sources/pages/articles/");

    function deleteComment($idComm, $mail, $idArt) {
        query("DELETE FROM comments WHERE id='$idComm'");

        if(query("SELECT * FROM comments WHERE id='$idComm'")->num_rows)
            header("location: /sources/pages/articles/article.php?id=$idArt&state=4");
        else {
            notify($mail,"you've correctly commented a comment under one of your articles.");
            header("location: /sources/pages/articles/article.php?id=$idArt&state=5");
        }
    }
?>