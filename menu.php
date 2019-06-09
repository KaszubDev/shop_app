<?php

    session_start();

    if ((!isset($_SESSION['zalogowany'])) || ($_SESSION['zalogowany']==false))
    {
        header('Location: login.php');
        exit();
    }
    echo '<h2 class="welcome">Cześć '.$_SESSION['name'].'! </h2>';

?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Shop App - Main</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style/menu.css">
    </head>
    <body>
        <button class="logout" onclick="location.href='logout.php'">Wyloguj się</button>
        <div class="container">
            <h1>menu</h1>
            <ul>
                <li><a id="One" class="link" href="offer.php">Oferta</a></li>
                <div class="boundOne"></div>
                <li><a id="Two" class="link" href="complaint.php">Złóż reklamacje</a></li>
                <div class="boundTwo"></div>
                <li><a id="Three" class="link" href="employees.php">Pracownicy</a></li>
                <div class="boundThree"></div>
                <?php
                    if ((isset($_SESSION['clientID'])) && ($_SESSION['clientID']=='999'))
                    {
                        echo '<li id="lastLink"><a id="Four" class="link" href="check_complaints.php">Zobacz reklamacje</a></li>';
                    }
                ?>
            </ul>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script>
            $(".link").hover(function () {
                $(".bound"+$(this).attr('id')).toggleClass("active");
            });
        </script>
    </body>
</html>