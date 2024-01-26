<?php

    require "<path to the php folder>/php/data.php";
    require "<path to the php folder>/php/notif.php";

    session_start();

    if(isset($_SESSION['mail']) && $_SESSION['platform']=="fin-literacy" && $_SESSION['role']=='1' && $_SERVER['REQUEST_METHOD']=="POST") {
        $mail = $_SESSION['mail'];
        $title = addslashes($_POST['title']);
        $text = addslashes($_POST['text']);
        $date = date("Y-m-d");
        
        query("INSERT INTO `articles`(`title`, `text`, `author`, `date`) VALUES ('$title','$text','$mail','$date')");

        if(query("SELECT id FROM articles WHERE author='$mail' AND title=\"$title\"")->num_rows) {
            notify($mail,"you've correctly published the article $title.");
            
            $notifyUsers = query("SELECT mail FROM users WHERE mail!='$mail'");
            if($notifyUsers->num_rows) {
                while($a=mysqli_fetch_row($notifyUsers)) {
                    notify($a[0],"a new article ($title) has been published on the website.");
                }
            }

            header("location: /sources/pages/reserved/writer/manageArticles.php?state=3");
        } else
            header("location: /sources/pages/reserved/writer/manageArticles.php?state=4");

    } else
        header("location: /");


?>