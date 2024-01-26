<?php

    require "<path to the php folder>/php/data.php";
    require "<path to the php folder>/php/notif.php";
    require "<path to the php folder>/php/mailer/mailsender.php";

    session_start();

    if(!isset($_SESSION['mail']) || $_SESSION['platform']!="fin-literacy")
        header("location: /sources/pages/logout.php");

    $mail = $_SESSION['mail'];
    $name = $_SESSION['name'];
    $query = query("SELECT verCode FROM users WHERE mail='$mail'");

    if($query->num_rows) {
        while($a=mysqli_fetch_row($query)) {
            $code = $a[0];
        }

        $content = "<p>Hi $name,<br>In order to definitely delete your account you have to press the following link. Mind this option isn't reversible at all.<br><br><a href='https://fin-literacy.eu/sources/pages/auto/removeAccount.php?mail=$mail&code=$code'>https://fin-literacy.eu/sources/pages/auto/removeAccount.php?mail=$mail&code=$code</a></p><p style='color: grey'>---<br><br>Best Regards,<br>The Financial Literacy Website</p>";
        if(send_mail($mail, "Delete your account", $content, null)) {
            notify($mail,"the remotion process for your account has started. Check your email to continue");

            header("location: /sources/pages/reserved/data.php?state=1");
        } else
        header("location: /sources/pages/reserved/data.php?state=2");
    } else
        header("location: /");
    

?>