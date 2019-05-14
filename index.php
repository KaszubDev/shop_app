<?php

    session_start();

    if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
    {
        header('Location: menu.php');
        exit();
    }

?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Shop App</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style/index.css">
        <!-- <link rel="shortcut icon" type="image/png" href="favicon.ico"/> -->
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    </head>
    <body>
        <h1>Shop-App</h1>
        <div class="container">
            <button class="login" onclick="location.href='login.php'">Zaloguj się</button><br/>
            <button class="register" onclick="location.href='register.php'">Zarejestruj się</button>
        </div>
    </body>
</html>