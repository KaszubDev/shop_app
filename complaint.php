<?php

    session_start();

    if ((!isset($_SESSION['zalogowany'])) || ($_SESSION['zalogowany']==false))
    {
        header('Location: login.php');
        exit();
    }
    
    if(isset($_POST['model'])) {
        $validation = true;

        $model = $_POST['model'];
        $date = $_POST['date'];
        $description = $_POST['description'];
        $id = $_POST['id'];

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
            //check if purchase ID is valid
            $result = $connection->query("SELECT ID_zamowienia from reklamacje WHERE ID_zamowienia='$id'");
            if (!$result) throw new Exception($connection->error);
            if (($result->num_rows) > 0)
            {
                $validation = false;
                echo '<h2 style="text-align: center;color: #ed2d2d; margin-top:2%;">Wpisz poprawny numer zamówienia</h2>';
            }
            
            if ($validation == true)
            {
            if ($connection->query("INSERT INTO reklamacje (data_zakupu, model, opis, ID_zamowienia) VALUES ('$date', '$model', '$description', '$id')"))
            {
                $message = 'Wysłano poprawnie.';
            }
            else {
                throw new Exception($connection->error);
            }
        }    
            $connection->close();
        }
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
        <title>Shop App - Complaint</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style/complaint.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    </head>
    <body>
    <a href="index.php" class="arrow"><i class="fas fa-long-arrow-alt-left fa-3x"></i></a>
        <h1>Reklamacje</h1>
        <form class="container" method="post">
            <label for="purchase_date">
                <span>Data zakupu</span>
                <input required id="purchase_date" type="date" name="date"/>
            </label>
            
            <label for="model">
                <span>Model</span>
                <input required id="model" type="text" name="model"/>
            </label>

            <label for="purchase_id">
                <span>ID Zamówienia</span>
                <input required id="purchase_id" type="number" name="id"/>
            </label>

            <label for="description">
                <span>Opis</span>
                <textarea required id="description" name="description"></textarea>
            </label>
            <input class="btn" type="submit" value="Wyślij" />
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