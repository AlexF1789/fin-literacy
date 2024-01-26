<?php

    require "<path to the php folder>/php/data.php";
    require "<path to the php folder>/php/loading.php";
    require "<path to the php folder>/php/notif.php";
    require "<path to the php folder>/php/mailer/mailsender.php";

    loading();

    if(isset($_POST['mail'])) {

        $mail = $_POST['mail'];
        $query = query("SELECT name, verCode FROM users WHERE mail='$mail'");

        if($query->num_rows) {
            while($a=mysqli_fetch_row($query)) {
                $name = $a[0];
                $verCode = $a[1];
            }

            notify($mail,"you started the password recovery procedure. Check your email and follow the instructions to continue.");

            $content = "<p>Hi $name,<br>It seems you started the password recovery procedure in the Financial Literacy project website.<br><br>In order to continue you can click the following link:<br><a href=\"https://fin-literacy.eu/sources/pages/recoveryPwd.php?mail=$mail&code=$verCode\">https://fin-literacy.eu/sources/pages/recoveryPwd.php?mail=$mail&code=$verCode</a><br><br>For any request you can reply to this email.<br></p><p style=\"color: grey\">---<br><br>Best Regards,<br>The Financial Literacy Website</p>";
            send_mail($mail, "Password recovery", $content, null);
        }
    
    
        header("location: /sources/pages/login.php?state=3");

    } else {
        header("location: /sources/pages/login.php");
    }

?>