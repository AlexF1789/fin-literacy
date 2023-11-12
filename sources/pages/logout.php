<?php

    session_start();

    unset($_SESSION['mail']);
    unset($_SESSION['surname']);
    unset($_SESSION['name']);
    unset($_SESSION['nationality']);
    unset($_SESSION['platform']);
    unset($_SESSION['role']);

    session_destroy();

    header("location: /sources/pages/login.php?state=2");

?>