<?php

    require "<path to the php folder>/php/data.php";
    require "<path to the php folder>/php/loading.php";
    require "<path to the php folder>/php/notif.php";
    require "<path to the php folder>/php/mailer/mailsender.php";

    if(isset($_POST['password']) && isset($_POST['passwordCheck']) && isset($_POST['mail'])) {
        if($_POST['password'] == $_POST['passwordCheck']) {
            $mail = $_POST['mail'];
            $encrPwd = MD5($_POST['password']);
            query("UPDATE users SET password='$encrPwd' WHERE mail='$mail'");

            $check = query("SELECT name FROM users WHERE mail='$mail' AND password='$encrPwd'");
            if($check->num_rows) {
                while($a=mysqli_fetch_row($check))
                    $name = $a[0];

                notify($mail,"you have correctly recovered the password of your account. More info in the success mail.");
                $content = "<p>Hi, $name<br>the password of your account has correctly been recovered. If you don't recognize this action as yours reply to this email.<br></p><p style=\"color: grey\">---<br><br>Best Regards,<br>The Financial Literacy Website</p>";
                send_mail($mail, "Password recovered", $content, null);
                header("location: /sources/pages/login.php?state=4");
            }
        } else
            header("location: /sources/pages/login.php");
    } else
        header("location: /sources/pages/login.php");

?>