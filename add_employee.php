<?php

    session_start();

    if ((!isset($_SESSION['zalogowany'])) || ($_SESSION['zalogowany']==false) || (($_SESSION['clientID']!='999')))
    {
        header('Location: login.php');
        exit();
    }
    if(isset($_POST['position'])) {

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $bornDate = $_POST['bornDate'];
        $sector = $_POST['sector'];
        $position = $_POST['position'];
        $image_validation = true;
        //upload avatar
        if(!empty($_FILES['avatar']['name']))
        {
            
            $avatar = addslashes(file_get_contents($_FILES['avatar']['tmp_name']));
            $allowed_image_extension = array(
                "png",
                "jpg",
                "jpeg",
                "bmp"
            );
            $file_extension = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
            $fileinfo = @getimagesize($_FILES["file-input"]["tmp_name"]);
            $width = $fileinfo[0];
            $height = $fileinfo[1];
            if (!in_array($file_extension, $allowed_image_extension))
            {
                $image_validation = false;
                $error_message = 'Wybierz odpowiedni plik. Akceptowane rozszerzenia: .png .jpg .jpeg .bmp';
            }
        }
        else 
        {
            $avatar = NULL;
        }
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
            if($image_validation == true) {
            if ($connection->query("INSERT INTO pracownicy VALUES (NULL,'$name', '$surname', '$bornDate', '$sector', '$position', '$avatar')"))
            {
                $message = 'Wysłano poprawnie.';
            }
            else {
                throw new Exception($connection->error);
            }
            }
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
        <title>Shop App - Add Employee</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style/add_employee.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    </head>
    <body>
    <a href="employees.php" class="arrow"><i class="fas fa-long-arrow-alt-left fa-3x"></i></a>
    <h1>Dodaj pracownika</h1>
    <form class="container" method="post" enctype="multipart/form-data">
            <label for="employee_name">
                <span>Imię</span>
                <input required id="employee_name" type="text" name="name"/>
            </label>
            
            <label for="employee_surname">
                <span>Nazwisko</span>
                <input required id="employee_surname" type="text" name="surname"/>
            </label>

            <label for="bornDate">
                <span>Data urodzenia</span>
                <input required id="bornDate" type="date" name="bornDate"/>
            </label>

            <label for="sector">
                <span>Dział</span>
                <input required id="sector" type="text" name="sector"/>
            </label>

            <label for="position">
                <span>Stanowisko</span>
                <input required id="position" type="text" name="position"/>
            </label>
            <label for="avatar">
                <span>Avatar (opcjonalny)</span>
                <input id="avatar" type="file" name="avatar"/>
            </label>
            <input style="margin-left: 33%;" class="btn" type="submit" value="Dodaj" />
        </form>
        <?php
        if(isset($error_message))
        {
            echo '<h2 style="text-align: center; color: #ed2d2d;">'.$error_message.'</h2>';
            unset($error_message);
        }
        if(isset($message))
        {
            echo '<h2 style="text-align: center;">'.$message.'</h2>';
            unset($message);
        }
        ?>


        <!--KOD PONIŻEJ WYŚWIETLA AVATAR PO DODANIU PRACOWNIKA -->
        <!-- 
        <?php
            try
            {
                require_once "connect.php";
                mysqli_report(MYSQLI_REPORT_STRICT);
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
                        echo '<img src="data:image/jpeg;base64,'.base64_encode($row['avatar'] ).'" /><br/>';
                    }
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
           header('Location: error.html');
        }
        ?>
    -->
    </body>
</html>