<?php

    session_start();

    if ((!isset($_SESSION['zalogowany'])) || ($_SESSION['zalogowany']==false))
    {
        header('Location: login.php');
        exit();
    }
    
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Shop App - Offer</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style/offer.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    </head>
    <body>
    <a href="index.php" class="arrow"><i class="fas fa-long-arrow-alt-left fa-3x"></i></a>
        <h1>Oferta</h1>
    </body>
</html>