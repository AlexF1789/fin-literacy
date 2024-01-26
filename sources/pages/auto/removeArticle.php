<?php

    require "<path to the php folder>/php/data.php";
    require "<path to the php folder>/php/notif.php";

    session_start();

    if(isset($_SESSION['mail']) && $_SESSION['platform']=="fin-literacy" && isset($_GET['id'])) {
        $idArt = $_GET['id'];
        $mail = $_SESSION['mail'];

        $authorQuery = query("SELECT author FROM articles WHERE id='$idArt'");
        if($authorQuery->num_rows) {
            while($a=mysqli_fetch_row($authorQuery))
                $author = $a[0];

            if($author==$mail) {
                query("DELETE FROM articles WHERE id='$idArt'");
                query("DELETE FROM comments WHERE idArt='$idArt'");
                query("DELETE FROM articlesLike WHERE idArt='$idArt'");
                $images = query("SELECT link FROM images WHERE idArt='$idArt'");
                if($images->num_rows) {
                    while($a=mysqli_fetch_row($images)) {
                        unlink("<path to the php images folder>/images/articles/".$a[0]);
                    }
                    query("DELETE FROM images WHERE idArt='$idArt'");
                }

                if(query("SELECT * FROM articles WHERE id='$idArt'")->num_rows) {
                    header("location: /sources/pages/reserved/writer/manageArticles.php?state=2");
                } else {
                    notify($mail,"you've correctly deleted an article you're the author of.");
                    header("location: /sources/pages/reserved/writer/manageArticles.php?state=1");
                }

            } else
                header("location: /");
        } else
            header("location: /");
        
    } else
        header("location: /");


?>