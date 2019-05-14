<?php
    session_start();
    //echo '<h1>Cześć '.$_SESSION['name'].' </h1>';
    if ((isset($_POST['email'])) && (isset($_POST['password'])))
    {
        require_once "connect.php";
        $connection = @new mysqli($host, $db_user, $db_password, $db_name);

        $email = $_POST['email'];
        $password = $_POST['password'];

        $email = htmlentities($email, ENT_QUOTES, "UTF-8");

        if ($result = @$connection->query(
            sprintf("SELECT * FROM klienci WHERE email='%s'",
            mysqli_real_escape_string($connection,$email))))
            {
                $users_number = $result->num_rows;
                if($users_number>0)
                {
                    $row = $result->fetch_assoc();
                    
                    if ($password == $row['haslo'])
                    {
                        $_SESSION['zalogowany'] = true;
                        $result->free_result();
                        header('Location: menu.php');
                    }
                    else 
                    {
                        echo $password;
                        echo $email;
                    }
                } 
            }
            $connection->close();
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="style/login.css">
    <title>Shop App - Logowanie</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>
    <a href="index.php" class="arrow"><i class="fas fa-long-arrow-alt-left fa-3x"></i></a>
    <?php 
        if (isset($_SESSION['registered_successfully']))
        {
            echo '<p style="margin-top: 2%;">Rejestracja przebiegła pomyślnie. Możesz teraz zalogować się na swoje konto.</p>';
            unset($_SESSION['registered_successfully']);
        }
    ?>  
    <h1>Logowanie</h1>
    
    <form class="container" method="post">
        <input minlength="4" maxlength="30" required type="email" id="email" name="email" placeholder="Podaj adres e-mail"/> <br/>
    
        <input required style="margin-left: 7.5%;" minlength="6" maxlength="30" type="password" id="password" name="password" placeholder="Podaj hasło"/> 
        <span class="eye" onclick="toggle()"> <i class="fas fa-eye-slash fa-1x"></i> </span>
        <br/>

        <input class="btn" type="submit" value="Zaloguj się" />
    </form>
    <script>
        function toggle() {
            let x = document.getElementById("password");
            if (x.type === "password") {
            x.type = "text";
            } 
            else {
            x.type = "password";
            }
        }
    </script>
</body>
</html>