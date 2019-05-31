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
        <title>Shop App - Main</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style/add_employee.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    </head>
    <body>
    <a href="index.php" class="arrow"><i class="fas fa-long-arrow-alt-left fa-3x"></i></a>
    <h1>Dodaj lub usuń pracownika</h1>
    <form class="container" method="post">
            <label for="product_name">
                <span>Imię</span>
                <input required id="product_name" type="text" name="name"/>
            </label>
            
            <label for="model">
                <span>Nazwisko</span>
                <input required id="model" type="text" name="model"/>
            </label>

            <label for="producer">
                <span>Data urodzenia</span>
                <input required id="producer" type="date" name="producer"/>
            </label>

            <label for="category">
                <span>Dział</span>
                <input required id="category" type="text" name="category"/>
            </label>

            <label for="category">
                <span>Stanowisko</span>
                <input required id="category" type="text" name="category"/>
            </label>
            <input class="btn" type="submit" value="Dodaj" />
            <input style="float:right;" class="btn" type="submit" value="Usuń" />
        </form>
    </body>
</html>