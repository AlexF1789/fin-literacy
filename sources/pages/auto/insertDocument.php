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

    
    $object = $_POST['object'];
    $mail = $_SESSION['mail'];


    $percorso = "<path to the php folder>/docs/published/";


    $newName = getRandomString();
    while(file_exists($percorso.$newName)) {
        $newName = getRandomString();
    }
    
    $uploadfile = $percorso . basename($_FILES['file']['name']);

    $temp = explode(".", $_FILES["file"]["name"]);
    $newfilename = $newName . '.' . end($temp);
    $result = move_uploaded_file($_FILES["file"]["tmp_name"], $percorso . $newfilename);


    if($result) {
        query("INSERT INTO `documents`(`object`, `link`, `author`) VALUES ('$object','$newfilename','$mail')");
        
        if(query("SELECT * FROM documents WHERE link='$newfilename' AND author='$mail'")->num_rows) {
            echo "uploaded"; //debug
            notify($mail,"you've correctly uploaded a document.");

            $users = query("SELECT mail FROM users WHERE role='0'");
            if($users->num_rows)
                while($a=mysqli_fetch_row($users))
                    notify($mail,"a new document has been published on the website.");

            header("location: /sources/pages/reserved/writer/index.php?state=2");
        } else
            header("location: /sources/pages/reserved/writer/index.php?state=1");
             
    } else {
        header("location: /sources/pages/reserved/writer/index.php?state=1");
        echo "not uploaded"; //debug
    }



?>