<?php

    require "<path to the php folder>/php/data.php";
    require "<path to the php folder>/php/notif.php";

    session_start();

    if(!isset($_SESSION['mail']) || $_SESSION['platform']!="fin-literacy" || $_SESSION['role']!='1' || $_SERVER['REQUEST_METHOD']!='POST')
        header("location: /");

    function getRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        
        for ($i=0; $i<6;$i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }		
        
        return $randomString;
    }

    
    $idArt = $_POST['idArt'];
    $mail = $_SESSION['mail'];

    if(!query("SELECT * FROM articles WHERE author='$mail' AND id='$idArt'")->num_rows)
        header("location: /");



    $percorso = "<path to the php folder>/images/articles/";


    $newName = getRandomString();
    while(file_exists($percorso.$newName)) {
        $newName = getRandomString();
    }
    
    $uploadfile = $percorso . basename($_FILES['file']['name']);

    $temp = explode(".", $_FILES["file"]["name"]);
    $newfilename = $newName . '.' . end($temp);
    $result = move_uploaded_file($_FILES["file"]["tmp_name"], $percorso . $newfilename);


    if($result) {
        query("INSERT INTO `images`(`idArt`, `link`) VALUES ('$idArt','$newfilename')");
        
        if(query("SELECT * FROM images WHERE idArt='$idArt' AND link='$newfilename'")->num_rows) {
            echo "uploaded"; //debug
            notify($mail,"you've correctly uploaded an image to one of your articles.");
            header("location: /sources/pages/reserved/writer/manageArticles.php?state=5");
        } else
            header("location: /sources/pages/reserved/writer/manageArticles.php?state=6");
             
    } else {
        header("location: /sources/pages/reserved/writer/manageArticles.php?state=6");
        echo "not uploaded"; //debug
    }



?>