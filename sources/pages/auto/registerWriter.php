<?php

    require "<path to the php folder>/php/data.php";
    require "<path to the php folder>/php/mailer/mailsender.php";

    session_start();

    function getRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        
        for ($i=0; $i<8;$i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }		
        
        return $randomString;
    }

    if(!isset($_SESSION['mail']) || $_SESSION['platform']!="fin-literacy" || $_SESSION['role']!='2')
        header("location: /sources/pages/logout.php");

    if($_SERVER['REQUEST_METHOD']=="POST") {

        $mail = $_POST['mail'];
        $surname = $_POST['surname'];
        $name = $_POST['name'];
        $nationality = $_POST['nationality'];

        $password = getRandomString();
        $verCode = getRandomString();

        $pwdEncr = MD5($password);

        if(!query("SELECT * FROM users WHERE mail='$mail'")->num_rows) {

            query("INSERT INTO `users`(`mail`, `surname`, `name`, `password`, `nationality`, `verCode`, `verified`, `telegram`, `role`) VALUES ('$mail','$surname','$name','$pwdEncr','$nationality','$verCode','0',NULL,'1')");

            if(query("SELECT * FROM users WHERE mail='$mail'")->num_rows) {
                $content = "<p>Hi $name,<br>welcome to the <i>Financial Literacy for the economic development of society</i> (Erasmus+ KA220) website.<br><br>To verify your writer account press the following link:<br><a href=\"https://fin-literacy.eu/sources/pages/verAccount.php?mail=$mail&code=$verCode\">https://fin-literacy.eu/sources/pages/verAccount.php?mail=$mail&code=$verCode</a><br><br>Once you'll have verified your account you'll be able to login using the following credentials:<br><b>mail</b> $mail<br><b>password</b> $password<br><br>It's highly reccomended to change this password by surfing the section <i>Your data</i> on the website personal area.</p><br><br>For any request you can reply to this email.<br><p style=\"color: grey\">---<br><br>Best Regards,<br>The Financial Literacy Website</p>";
                if(send_mail($mail, "Verify your account", $content, null))
                    header("location: /sources/pages/reserved/admin/index.php?state=2");
                else
                    header("location: /sources/pages/reserved/admin/index.php?state=3");
            } else
                header("location: /sources/pages/reserved/admin/index.php?state=4");
        } else
            header("location: /sources/pages/reserved/admin/index.php?state=1");

    } else
        header("location: /");

?>