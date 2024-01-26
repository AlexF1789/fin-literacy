<?php

    require "<path to the php folder>/php/data.php";
    require "<path to the php folder>/php/notif.php";

    session_start();

    if(isset($_SESSION['mail']) && $_SESSION['platform']=="fin-literacy" && isset($_GET['id'])) {
        $idDoc = $_GET['id'];
        $mail = $_SESSION['mail'];

        $authorQuery = query("SELECT author, link FROM documents WHERE id='$idDoc'");
        if($authorQuery->num_rows) {
            while($a=mysqli_fetch_row($authorQuery)) {
                $author = $a[0]; 
                $link = $a[1];
            }

            if($author==$mail) {
                query("DELETE FROM documents WHERE id='$idDoc'");
                unlink("<path to the docs folder>/docs/published/$link");

                if(query("SELECT * FROM documents WHERE id='$idDoc'")->num_rows) {
                    header("location: /sources/pages/reserved/writer/manageDocuments.php?state=2");
                } else {
                    notify($mail,"you've correctly deleted an article you're the author of.");
                    header("location: /sources/pages/reserved/writer/manageDocuments.php?state=1");
                }

            } else
                header("location: /");
        } else
            header("location: /");
        
    } else
        header("location: /");


?>