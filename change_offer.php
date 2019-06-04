<?php

    session_start();

    if ((!isset($_SESSION['zalogowany'])) || ($_SESSION['zalogowany']==false) || ($_SESSION['clientID']!='999'))
    {
        header('Location: login.php');
        exit();
    }
    if(isset($_POST['product_name'])) {

        $product_name = $_POST['product_name'];
        $model = $_POST['model'];
        $producer = $_POST['producer'];
        $category = $_POST['category'];
    
        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);
        try
        {
            $connection = new mysqli($host, $db_user, $db_password, $db_name);
            if ($connection->connect_errno!=0)
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
            $connection->query("SET NAMES 'utf8'");
            //if(true) {
            if ($connection->query("INSERT INTO oferta VALUES (NULL, '$product_name', '$producer', '$model', '$category')"))
            {
                $message = 'Wysłano poprawnie.';
            }
            else {
                throw new Exception($connection->error);
            }
            //}
        }
            $connection->close();
    }
    catch(Exception $e)
    {
       header('Location: error.html');
    }
}

?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Shop App - Change Offer</title>
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
                <input required id="product_name" type="text" name="product_name"/>
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
        <?php
            if (isset($message))
            {
                echo '<h2 style="text-align: center;">'.$message.'</h2>';
                unset($message);
            }
        ?>
    </body>
</html>