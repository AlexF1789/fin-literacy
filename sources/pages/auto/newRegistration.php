<?php

    require "<path to the php folder>/php/data.php";
    require "<path to the php folder>/php/mailer/mailsender.php";

    function getRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        
        for ($i=0; $i<8;$i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }		
        
        return $randomString;
    }

    if($_SERVER['REQUEST_METHOD']=="POST") {

        $mail = trim(strtolower($_POST['mail']));

        if(str_contains($mail,' ') || !str_contains($mail,'@') || $_POST['password']!=$_POST['confirmPassword']) {
            header("location: /sources/pages/login.php?state=7");
        } else {
        
            if(query("SELECT * FROM users WHERE mail='$mail'")->num_rows) {
                header("location: /sources/pages/login.php?state=6");
            }

            $surname = trim(strtolower($_POST['surname']));
            $name = trim(strtolower($_POST['name']));

            $surname[0] = strtoupper($surname[0]);
            $name[0] = strtoupper($name[0]);

            for($i=1;$i<strlen($surname)-1;$i++) {
                if($surname[$i]==' ' || $surname[$i]=="'")
                    $surname[$i+1] = strtoupper($surname[$i+1]);
            }

            for($i=1;$i<strlen($name)-1;$i++) {
                if($name[$i]==' ' || $name[$i]=="'")
                    $name[$i+1] = strtoupper($name[$i+1]);
            }

            $pwdEncr = MD5($_POST['password']);
            $nationality = $_POST['nationality'];

            $verCode = getRandomString();

            query("INSERT INTO `users`(`mail`, `surname`, `name`, `password`, `nationality`, `verCode`, `verified`, `telegram`, `role`) VALUES ('$mail','$surname','$name','$pwdEncr','$nationality','$verCode','0',NULL,'0')");

            if(query("SELECT * FROM users WHERE mail='$mail'")->num_rows) {
                $content = "<p>Hi $name,<br>welcome to the <i>Financial Literacy for the economic development of society</i> (Erasmus+ KA220) website.<br><br>To verify your reader account press the following link:<br><a href=\"https://fin-literacy.eu/sources/pages/verAccount.php?mail=$mail&code=$verCode\">https://fin-literacy.eu/sources/pages/verAccount.php?mail=$mail&code=$verCode</a></p><br><br>For any request you can reply to this email.<br><p style=\"color: grey\">---<br><br>Best Regards,<br>The Financial Literacy Website</p>";
                if(send_mail($mail, "Verify your account", $content, null))
                    header("location: /sources/pages/login.php?state=9");
                else
                    header("location: /sources/pages/login.php?state=10");
            } else
                header("location: /sources/pages/login.php?state=8");
        }
    }

?>