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
        <title>Shop App - Employees</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style/employees.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    </head>
    <body>
    <a href="index.php" class="arrow"><i class="fas fa-long-arrow-alt-left fa-3x"></i></a>
        <h1>Pracownicy</h1>
    <?php
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
            $result = $connection->query("SELECT * from pracownicy");
            if (!$result) throw new Exception($connection->error);
            if (($result->num_rows) > 0)
            {
                while($row = $result->fetch_assoc())
                { 
                echo "<h2>" . $row['imie'] . "</h2>" . $row['nazwisko'] ;
                }
                echo "</table>";
            }
            else 
            {
                throw new Exception($connection->error);
            }
        }    
            $connection->close();
        }
    catch(Exception $e)
	{
       echo $e;
       //header('Location: error.html');
	}
    ?>
    <?php
        if ((isset($_SESSION['clientID'])) && ($_SESSION['clientID']=='999'))
        {
            echo <<<END
            <a class="btn" href="add_employee.php">
                <img src="assets/man.png"/>
            </a>
            END;
        }
    ?>
    </body>
</html>