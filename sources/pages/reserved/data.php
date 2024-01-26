<?php

    require "<path to the php folder>/php/data.php";

    session_start();

    if(!isset($_SESSION['mail']) || $_SESSION['platform']!="fin-literacy")
        header("location: /sources/pages/logout.php");

    $surname = $_SESSION['surname'];
    $name = $_SESSION['name'];
    $mail = $_SESSION['mail'];

    $hasTelegramQuery = query("SELECT telegram FROM users WHERE mail='$mail'");
    if($hasTelegramQuery->num_rows) {
        while($a=mysqli_fetch_row($hasTelegramQuery)) {
            if(is_null($a[0]))
                $hasTelegram = false;
            else
                $hasTelegram = true;
        }
    } else
        $hasTelegram = false;

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
        <title>Financial Literacy - personal data</title>
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
                <h1 style="display: inline-block">Your data</h1><br><br>
                
                <div style="overflow-x: scroll">
                    <table>
                        <tr>
                            <th>Surname</th>
                            <td><?php echo $surname ?></td>
                        </tr>

                        <tr>
                            <th>Name</th>
                            <td><?php echo $name ?></td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td><?php echo $_SESSION['mail'] ?></td>
                        </tr>

                        <tr>
                            <th>Nationality</th>
                            <td><?php echo strtoupper($_SESSION['nationality']) ?>&emsp;<img class="flag" src="/sources/images/flags/<?php echo $_SESSION['nationality'] ?>.png" alt="<?php echo $_SESSION['nationality'] ?>" type="image/png"></td>
                        </tr>
                    </table>
                </div>

                <?php
                    if($hasTelegram)
                        echo '<a href="/sources/pages/auto/removeTG.php"><button>Remove Telegram</button></a>';
                    else
                        echo '<button onclick="configTelegram()">Configure Telegram</button>';
                ?>

                <br><br><button onclick='editData("<?php echo $surname ?>","<?php echo $name ?>")'>Edit data</button><br><br>
                <button onclick="editPwd()">Edit your password</button><br><br>
                <button class="redButton" onclick="deleteAccount()">Delete account</button><br><br>
                
            </article>
        </section>

        <aside>
            <img class="toggle" src="/sources/images/toggle/font.png" style="float: left;" alt="Aa" type="image/png" title="Change the font from Open Sans to OpenDyslexic or vice versa" onclick="changeFont()">
            <img class="toggle" src="/sources/images/toggle/translate.png" style="float: right;" title="Translate the page to your language using Google Translate or come back to the English version" alt="Translate" type="image/png" onclick="changeLanguage()">
                
            <div style="clear: both">
                <h3>Navigation menu</h3>
                <ul>
                    <li><a href="/" class="menuLink">Homepage</a></li>
                    <li><a href="/sources/pages/articles/index.php" class="menuLink">All the articles</a></li>
                    <li><a href="/sources/pages/reserved/articlesIndex.php" class="menuLink">Your articles</a></li>
                    <li><a href="/sources/pages/articles/documents.php" class="menuLink">Documents</a></li>
                </ul>
            </div>
            <a href="https://erasmus-plus.ec.europa.eu/it" target="_blank"><img class="cofunder" src="/sources/images/cofunder.png" type="image/png" alt="Cofounded by the European Union"></a>        
        </aside>

        <footer>
            <p onclick="help()" class="footerLink">&copy; 2023&emsp;-&emsp;Alessandro Flora @ Politecnico di Torino</p>
            <label>Last edit on 2023 November 10<sup>th</sup></label>
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
            message = new Array("","The email containing the instructions to delete your account has been sent. Check it to continue.","An error occured while processing the request; try again later or write an email to info@fin-literacy.eu explaining the problem.","The Telegram notifications have been enabled for your accont. You'll receive a message as a confirm.","The Telegram notifications for your account have been disabled. You'll receive a message as a confirm.","You updated your personal data correctly. You'll see the new information from the next login.");
            type = new Array("","success","error","success","success","success");
    </script>
</html>