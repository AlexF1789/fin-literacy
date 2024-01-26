<?php

    require "<path to the php folder>/php/data.php";
    session_start();

    if(!isset($_SESSION['mail']) || $_SESSION['platform']!="fin-literacy")
        header("location: /sources/pages/logout.php");

    if($_SESSION['role']!='2')
        header("location: /sources/pages/reserved/");

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
        <title>Financial Literacy - users</title>
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
    <script type="text/javascript" src="/sources/script/admin.js"></script>
    <script type="text/javascript" src="/sources/script/swal2.js"></script>

    <body>
        <header>
            <a href="/"><img class="logo" src="/sources/images/logo.png" type="image/png" alt="Financial Literacy"></a>
            <a href="https://erasmus-plus.ec.europa.eu/" target="_blank"><img class="cofunder" src="/sources/images/cofunder.png" type="image/png" alt="Cofounded by the European Union"></a>
        </header>

        <hr class="divider">

        <section>
            <article>
                <h1>Users</h1>

                <table>
                    <thead>
                        <tr>
                            <th>Surname</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Nationality</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $query = query("SELECT surname, name, mail, nationality, role FROM users");
                            if($query->num_rows) {
                                while($a=mysqli_fetch_row($query)) {
                                    if($a[4]=='0')
                                        $role='reader';
                                    else if($a[4]=='1')
                                        $role="<a style='color: green'>writer</a>";
                                    else if($a[4]=='2')
                                        $role="<a style='color: red'>admin</a>";
                                    else
                                        $role="error!";
                                    echo "<tr><td>$a[0]</td><td>$a[1]</td><td>$a[2]</td><td>$role</td><td><img src='/sources/images/flags/$a[3].png' type='image/png' alt='$a[3]' class='flag'>&emsp;".strtoupper($a[3])."</td></tr>";
                                }
                            }

                        ?>
                    </tbody>
                </table>
            </article>
        </section>

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
        message = new Array("","The inserted email matches with an already registered user on the website.","The writer has been registered.","There was an error sending the verification mail to the writer.","There was an error registering the writer.","The inserted user does not exist.","The users was succesfully deleted.");
        type = new Array("","warning","success","error","error","warning","success");
    </script>

    <style type="text/css">
        section {
            width: 90%;
            margin-left: 5%;
            margin-right: 5%;
        }

        table {
            text-align: left;
        }

        table, tr, td, th {
            border: 1px solid gray;
            border-collapse: collapse;
            padding: 15px;
        }
    </style>
</html>