<?php

    // SERVICE PAGE USED TO SEND USERS TO OWN RESERVED PAGES FILTERING BETWEEN READERS AND WRITERS

    session_start();

    if(!isset($_SESSION['mail']) || $_SESSION['platform']!='fin-literacy')
        header("location: /sources/pages/logout.php");

    else {

        switch($_SESSION['role']) {
            case 0:
                $link = "/sources/pages/reserved/reader/";
                break;
            case 1:
                $link = "/sources/pages/reserved/writer/";
                break;
            case 2:
                $link = "/sources/pages/reserved/admin/";
                break;
            default:
                $link = "/sources/pages/logout.php";
                break;
        }

        header("location: $link");
    
    }

?>