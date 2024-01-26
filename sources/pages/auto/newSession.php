<?php

    require "<path to the php folder>/php/data.php";
    require "<path to the php folder>/php/loading.php";
    require "<path to the php folder>/php/notif.php";

    session_start();

    if(isset($_SESSION['mail']) && $_SESSION['platform']=="fin-literacy")
        header("location: /sources/pages/reserved/");

    if(isset($_SESSION['platform']) && $_SESSION['platform']!="fin-literacy")
        header("location: /sources/pages/logout.php");

    if($_SERVER['REQUEST_METHOD']=="POST") {

        // display the loading screen

        loading();

        // checking and correcting the credentials

        $mail = $_POST['mail'];
        $password = $_POST['password'];

        if($mail=='' || $password=='' || str_contains($mail,' '))
            header("location: /sources/pages/login.php?state=1");
        else {
            $mail = trim($mail);
            $password = MD5($password);

            // database query

            $query = query("SELECT * FROM users WHERE mail='$mail' AND password='$password'");
            if($query->num_rows) {
                while($a=mysqli_fetch_row($query)) {

                    if($a[6]=='0') {
                        header("location: /sources/pages/login.php?state=12");
                        die;
                    }

                    // saving the obtained values to session variables

                    $_SESSION['mail'] = $a[0];
                    $_SESSION['surname'] = $a[1];
                    $_SESSION['name'] = $a[2];
                    $_SESSION['nationality'] = $a[4];
                    $_SESSION['role'] = $a[8];

                }

                $ip = $_SERVER['REMOTE_ADDR'];

                $_SESSION['platform']="fin-literacy";

                notify($_SESSION['mail'],"you have just logged in from the IP address $ip.");

                header("location: /sources/pages/reserved/");
            } else
                header("location: /sources/pages/login.php?state=1");
        }
    }

?>