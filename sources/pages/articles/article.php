<?php

    require "/home/uerd317k/domains/fin-literacy.eu/public_html/sources/php/data.php";

    session_start();

    if(!isset($_GET['id']))
        header("location: /sources/pages/articles/");
    else {

        $idArt = $_GET['id'];
        $query = query("SELECT articles.title, articles.text, articles.date, users.surname, users.name, users.nationality, users.mail FROM articles, users WHERE articles.id='$idArt' AND articles.author=users.mail");

        if($query->num_rows) {

            while($a=mysqli_fetch_row($query)) {
                $title = $a[0];
                $text = $a[1];
                $date = $a[2];
                $author = $a[4]." ".$a[3];
                $authorMail = $a[6];
                $nationality = $a[5];
            }

            $howManyLikes = query("SELECT COUNT(id) FROM articlesLike WHERE idArt='$idArt'");
                if($howManyLikes->num_rows) {
                    while($c=mysqli_fetch_row($howManyLikes))
                        $numLike = $c[0];
                } else
                    $numLike = 0;

            
            if(!isset($_SESSION['mail']) || $_SESSION['platform']!="fin-literacy")
                $logged = false;
            else {
                $logged = true;
                $mail = $_SESSION['mail'];
                
                if(query("SELECT id FROM articlesLike WHERE idArt='$idArt' AND mail='$mail'")->num_rows)
                    $liked = true;
                else
                    $liked = false;
            }
        }
    }

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
                <h1><?php echo $title ?></h1>

                <div style="text-align: justify;">
                    <?php echo $text ?>
                </div>

                <br><br>
                <?php echo "<i>".$date."<br>".$author."&emsp;</i><img class='smallFlag' src='/sources/images/flags/$nationality.png' type='image/png' alt='$nationality'>" ?>

                <br><br><br>

                <table style="width: 25%; text-align: left; padding-bottom: 15px;">
                    <tr>
                        <td><img src="/sources/images/likes.png" type="image/png" class="likes"></td>
                        <td><?php echo $numLike ?></td>
                        <?php
                            if($logged) {
                                if($liked)
                                    echo "<td><a href='/sources/pages/auto/setLike.php?idArt=$idArt&state=0' class='redLink'>unlike</a></td><br><br>";
                                else
                                    echo "<td><a href='/sources/pages/auto/setLike.php?idArt=$idArt&state=1' class='link'>like</a></td>";
                                echo "</tr></table><a onclick='comment($idArt)' class='link'>Write a comment</a>";
                            } else
                                echo "</tr></table><p>You have to <a href='/sources/pages/login.php/' class='link'>login</a> to comment or like this article</p>";
                            
                            $comments = query("SELECT users.name, users.nationality, comments.text, users.mail, comments.id, comments.date FROM comments, users WHERE comments.idArt='$idArt' AND comments.mail=users.mail ORDER BY comments.id DESC");
                            if($comments->num_rows) {
                                echo "<br><h3 style='display: inline-block'>Comments</h3>&emsp;<a id='commentsLink' class='link' onclick='collapseComments()'>collapse</a><div id='comments'><hr>";
                                while($d=mysqli_fetch_row($comments)) {
                                    if($d[3]==$authorMail)
                                        $more = "&emsp;<b style='font-variant: small-caps;'>author</b>";
                                    else
                                        $more = '';

                                    if(($logged && $d[3]==$mail) || ($logged && $mail==$authorMail))
                                        $more .= "&emsp;<a href='/sources/pages/auto/deleteComment.php?idComm=$d[4]&idArt=$idArt' class='redLink'>delete</a>";
                                    $more .= "&emsp;&emsp;".$d[5];
                                    echo "<p>$d[0]&ensp;<img src='/sources/images/flags/$d[1].png' type='image/png' class='smallFlag' alt='$d[1]'>$more</p><p>$d[2]</p><hr>";
                                }
                                echo "</div>";
                            } else
                                echo "<hr><p>There are no comments for this article!</p>"
                        ?>
                    </tr>
                </table>
            
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
                    <li><a href="/sources/pages/articles/" class="menuLink">Articles</a></li>
                    <li><a href="/sources/pages/articles/documents.php" class="menuLink">Documents</a></li></ul>
            </div>

            <div class="images">
                <?php
                    
                    $imagesQuery = query("SELECT link FROM images WHERE idArt='$idArt'");
                    if($imagesQuery->num_rows) {
                        echo "<br><h3>Article images</h3>";
                        while($b=mysqli_fetch_row($imagesQuery)) {
                            echo "<img src='/sources/images/articles/$b[0]' class='articleImage'><br>";
                        }
                    }

                ?>
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
            message = new Array("Unliked","Liked","Your comment has been pubblished","There was an error pubblishing your comment","There was an error processing the request; try again later.","The comment was correctly deleted.");
            type = new Array("success","success","success","error","error","success");

            function collapseComments() {
                if(document.getElementById("comments").style.display=='') {
                    document.getElementById("comments").style.display = "none";
                    document.getElementById("commentsLink").innerHTML = 'show';
                } else {
                    document.getElementById("comments").style.display="";
                    document.getElementById("commentsLink").innerHTML = 'collapse';
                }
            }
    </script>
</html>