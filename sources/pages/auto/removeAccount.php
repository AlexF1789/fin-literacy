<?php

    require "<path to the php folder>/php/data.php";
    require "<path to the php folder>/php/notif.php";
    require "<path to the php folder>/php/mailer/mailsender.php";
    require "<path to the php folder>/php/loading.php";

    session_start();

    loading();
    
    if(isset($_SESSION['mail'])) {
        

        unset($_SESSION['mail']);
        unset($_SESSION['surname']);
        unset($_SESSION['name']);
        unset($_SESSION['nationality']);
        unset($_SESSION['platform']);
        unset($_SESSION['role']);

        session_destroy();
    }
    
    
    
    if(isset($_GET['mail']) && isset($_GET['code'])) {
        $mail = $_GET['mail'];
        $code = $_GET['code'];
        $query = query("SELECT name FROM users WHERE mail='$mail' AND verCode='$code'");

        if($query->num_rows) {
            while($a=mysqli_fetch_row($query))
                $name = $a[0];

            notify($mail,"your account has been removed from the website. You'll have to register again if you'd like to.");

            query("DELETE FROM users WHERE mail='$mail'");
            query("DELETE FROM comments WHERE mail='$mail'");

            $content = "<p>Hi $name,<br>Your account has been deleted from the website.<br><br>For any request you can reply to this email.<br></p><p style='color: grey'>---<br><br>Best Regards,<br>The Financial Literacy Website</p>";
            send_mail($mail, "Account deleted", $content, null);

            header("location: /sources/pages/login.php?state=5");

        } else
         header("location: /");
    } else
        header("location: /");

?>