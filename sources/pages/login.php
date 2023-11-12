<?php

    session_start();

    if(isset($_SESSION['mail']) && $_SESSION['platform']=="fin-literacy")
        header("location: /sources/pages/reserved/");

    if(isset($_SESSION['platform']) && $_SESSION['platform']!="fin-literacy")
        header("location: /sources/pages/logout.php");


?>


<!-- 
    
                FINANCIAL LITERACY WEBSITE 
created by Alessandro Flora (student at Politecnico di Torino)


It's adviced to surf this website using Mozilla Firefox or Google Chrome


-->

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <!-- TITLE AND METAS -->
        <title>Financial Literacy - Login</title>
        <meta charset="UTF-8"/>
        <meta name="author" content="Alessandro Flora"/>
        <meta name="description" content="Erasmus+ Project: Financial Literacy for the economic development of Society"/>
        <meta name="keywords" content="erasmus, financial, financial literacy, europa, eu, erasmus+ project"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#323232">
        
        <!-- LINKS -->
		<link rel="icon" href="/sources/images/favicon.png" type="image/png"/>
        <link rel="stylesheet" href="/sources/style/style.css" type="text/css"/>
        <link rel="stylesheet" href="/sources/style/mobile.css" type="text/css"/>

        <!-- GOOGLE FONTS IMPLEMENTATION: used fonts: Open Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">

        <!-- OPENDYSLEXIC implementation: used for increase dyslexic people possibility to access to the website -->
		<link rel="stylesheet" href="https://fin-literacy.eu/sources/fonts/opendyslexic.css" type="text/css"/>
        
    </head>

    <!-- SCRIPTS -->
    <script type="text/javascript" src="/sources/script/main.js"></script>
    <script type="text/javascript" src="/sources/script/swal2.js"></script>
    <script type="text/javascript" src="/sources/script/registerRecover.js"></script>

    <body>
        <header>
            <a href="/"><img class="logo" src="/sources/images/logo.png" type="image/png" alt="Financial Literacy"></a>
            <a href="https://erasmus-plus.ec.europa.eu/" target="_blank"><img class="cofunder" src="/sources/images/cofunder.png" type="image/png" alt="Cofounded by the European Union"></a>
        </header>

        <hr class="divider">

        <section>
            <article>
                <h1>Login page</h1>
                <p>Here you can login using the credentials provided you by the administrator or obtained in the registration procedure.</p>

                <form method="POST" action="/sources/pages/auto/newSession.php" class="login">
                    <input name="mail" type="text" placeholder="E-mail address" required class="textField"><br>
                    <input name="password" type="password" placeholder="Password" required class="textField"><br>
                    <input type="submit" class="button" value="Login" title="Login to the personal area of the website">
                </form>
                <br>
                <p>Haven't you registered yet? <a onclick="register()" class="link">sign in</a></p>
                <p>Did you forget your password? <a onclick="recover()" class="link">recover it</a></p>
            </article>
        </section>

        <aside>
            <img class="toggle" src="/sources/images/toggle/font.png" style="float: left;" alt="Aa" type="image/png" title="Change the font from Open Sans to OpenDyslexic or vice versa" onclick="changeFont()">
            <img class="toggle" src="/sources/images/toggle/translate.png" style="float: right;" title="Translate the page to your language using Google Translate or come back to the English version" alt="Translate" type="image/png" onclick="changeLanguage()">
                
            <div style="clear: both">
                <h3>Navigation menu</h3>
                <ul>
                    <li><a href="/" class="menuLink">Homepage</a></li>
                    <li><a href="/sources/pages/login.php" class="menuLink">Login</a></li>
                    <li><a href="/sources/pages/articles/index.php" class="menuLink">Articles</a></li>
                    <li><a href="/sources/pages/articles/documents.php" class="menuLink">Documents</a></li>
                </ul>
                <a href="https://erasmus-plus.ec.europa.eu/it" target="_blank"><img class="cofunder" src="/sources/images/cofunder.png" type="image/png" alt="Cofounded by the European Union"></a>
            </div>           
        </aside>

        <footer>
            <p onclick="help()" class="footerLink">&copy; 2023&emsp;-&emsp;Alessandro Flora @ Politecnico di Torino</p>
            <label>Last edit on 2023 November 3<sup>rd</sup></label>
            <hr>
            <a href="https://www.facebook.com/profile.php?id=100094561775718" title="Follow the project on Facebook" target="_blank"><img style="margin-right: 0" src="/sources/images/facebookWhite.png" type="image/png" alt="Facebook"></a>
            <hr>
            
            <!-- PROJECT CODE AND SCHOOL LOGOS -->

            <p>Project no. <b>2022-1-BG01-KA220_SCH-000087865</b></p><br><br>

            <a href="https://www.vfu.bg/en" title="Bulgaria: Varna Free University" target="_blank"><img src="/sources/images/partnersWhite/vfu.png" alt="Varna Free University" type="image/png"></a>

            <a href="https://seyhanyavuzselimoo.meb.k12.tr" title="Turkey: Yavuz Selim Ortaokulu" target="_blank"><img src="/sources/images/partnersWhite/yso.png" alt="Yavuz Selim Ortaokulu" type="image/png"></a>

            <a href="https://www.platon.edu.gr" title="Greece: Platon M.E.P.E." target="_blank"><img src="/sources/images/partnersWhite/platon.png" alt="Platon" type="image/png"></a>

            <a href="https://www.ulsystems.com/ " title="Ireland: Universal Learning System" target="_blank"><img src="/sources/images/partnersWhite/uls.png" alt="ULS" type="image/png"></a>


            <a href="https://www.context.fi/" title="Finland: Context" target="_blank"><img src="/sources/images/partnersWhite/context.png" alt="Context" type="image/png"></a>


            <a href="https://www.swu.bg/en/" title="Bulgaria: South West University Neofit Rilski" target="_blank"><img src="/sources/images/partnersWhite/swu.png" alt="SWU" type="image/png"></a>


            <a href="https://yenilikciegitim.org/" title="Turkey: Yenilikçi Eğitim Derneği" target="_blank"><img src="/sources/images/partnersWhite/yed.png" alt="YED" type="image/png"></a>

            <a href="https://liceoeinsteintorino.it/" title="Italy: Liceo Einstein Torino" target="_blank"><img style="margin-right: 0" src="/sources/images/partnersWhite/einstein.png" alt="Liceo Einstein Torino" type="image/png"></a>
        </footer>
    </body>

    <script type="text/javascript">
        message = new Array("","Check the informations you have inserted","You have successfully logged out","If the inserted mail refers to a registered account it will receive a mail with the instructions to follow to recover the password","The password of your account has correctly been changed; you can now login using the new one.","Your account has correctly been deleted.","An account registered with the same email address you inserted is already registered. If you forgot your password recover it by pressing the link included in this page.","Check the data you inserted.","The registration procedure encourred in an error; try again later. If the error persists send an email to info@fin-literacy.eu","You\'re now registered. Check your email to verify the account and then you'll be able to login.","There was an error sending the mail used to verify your account. Send an email to info@fin-literacy.eu to obtain assistance.","You can now login.","Your account isn't verified. Press the link you received in the verification mail to activate your account.");
        type = new Array("","error","success","info","success","success","warning","warning","error","info","error","success","warning");
    </script>
</html>