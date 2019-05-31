<?php

    session_start();

    if ((!isset($_SESSION['zalogowany'])) || ($_SESSION['zalogowany']==false) || ($_SESSION['clientID']!='999'))
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
        <title>Shop App - Main</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style/change_offer.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    </head>
    <body>
    <a href="index.php" class="arrow"><i class="fas fa-long-arrow-alt-left fa-3x"></i></a>
    <h1>Zmień ofertę</h1>
    <form class="container" method="post">
            <label for="product_name">
                <span>Nazwa</span>
                <input required id="product_name" type="text" name="name"/>
            </label>
            
            <label for="model">
                <span>Model</span>
                <input required id="model" type="text" name="model"/>
            </label>

            <label for="producer">
                <span>Producent</span>
                <input required id="producer" type="text" name="producer"/>
            </label>

            <label for="category">
                <span>Kategoria</span>
                <input required id="category" type="text" name="category"/>
            </label>
            <input class="btn" type="submit" value="Dodaj produkt" />
            <input style="float:right;" class="btn" type="submit" value="Usuń produkt" />
        </form>
    </body>
</html>