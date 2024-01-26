<?php

    require "<path to the php folder>/php/data.php"; // complete with the path to the php folder in your web server
    require "<path to the php folder>/php/mailer/mailsender.php"; // same as previous

    if(isset($_GET['mail']) && isset($_GET['code'])) {

        $mail = $_GET['mail'];
        $verCode = $_GET['code'];

        if(query("SELECT * FROM users WHERE mail='$mail' AND verCode='$verCode'")->num_rows) {
            query("UPDATE users SET verified='1' WHERE mail='$mail' AND verCode='$verCode'");

            if(query("SELECT * FROM users WHERE mail='$mail' AND verCode='$verCode' AND verified='1'")->num_rows) {
                $content = "<p>Hi,<br>you've received this email because you correctly verified your account on the Financial Literacy website. From now on you can login using the login page.<br><b>Important advice</b> by activating the Telegram notifications for your account you'll receive a notification every time a new article is pubblished. To enable them just go on <i>Your data</i> section and follow the steps.</p><br><p style='color: grey'>---<br><br>Best Regards,<br>The Financial Literacy Website</p>";
                send_mail($mail, "Welcome to Financial Literacy", $content, null);
                header("location: /sources/pages/login.php?state=11");
            }
        } else
            header("location: /");

    } else
        header("location: /");

?>