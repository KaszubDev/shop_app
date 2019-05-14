​<?php
    session_start();
    if (isset($_POST['password'])) {

        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $city = $_POST['city'];
        $zip_code = $_POST['zip-code'];
        $street = $_POST['street'];
        $password = $_POST['password'];
        $password2 = $_POST['password_check'];

        $_SESSION['name'] = $name;

        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        $connection->query("SET NAMES 'utf8'");

        if ($connection->query("INSERT INTO klienci VALUES (NULL, '$name', '$surname', '$tel', '$email', '$city', '$zip_code', '$street', '$password')"))
        {
            header('Location: login.php');
            $_SESSION['registered_successfully'] = true;
        }
        else {
            header('Location: error.html');
        }
        $connection->close(); 
    }
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Shop App - Rejestracja</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style/register.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>

<body>
	<form method="post">

            <a href="index.php" class="arrow"><i class="fas fa-long-arrow-alt-left fa-3x"></i></a>    
            <h2>Dane osobowe</h2>
            <label for="name">Imię</label> <br/>
            <input minlength="3" maxlength="20" required id="name" type="text" name="name" placeholder="Podaj swoje imię"/> <br/>
            
            <label for="surname">Nazwisko</label> <br/>
            <input minlength="3" maxlength="30" required id="surname" type="text" name="surname" placeholder="Podaj swoje nazwisko"/> <br/>

            <label for="email">E-mail</label> <br/>
            <input minlength="4" maxlength="30" required type="email" id="email" name="email" placeholder="Podaj adres e-mail"/> <br/>

            <label for="tel">Telefon kontaktowy <br/> <span style="font-size: .95rem;">(opcjonalnie)</span></label> <br/>
            <input minlength="9" maxlength="20" type="tel" id="tel" name="tel" placeholder="Podaj nr telefonu"/>
        
        
            <h2>Adres</h2>
            <label for="city">Miasto</label> <br/>
            <input minlength="3" maxlength="20" required type="text" id="city" name="city" placeholder="Podaj miasto"/> <br/>

            <label for="zip-code">Kod pocztowy</label> <br/>
            <input minlength="3" maxlength="20" required type="text" id="zip-code" name="zip-code" placeholder="Podaj kod pocztowy"/> <br/>

            <label for="street">Ulica oraz numer domu</label> <br/>
            <input minlength="3" maxlength="20" required type="text" id="street" name="street" placeholder="Podaj ulicę"/> <br/>
        
            <h2>Utwórz hasło</h2>
            <p>Hasło powinno zawierać minimum 6 znaków</p>

            <label for="password">Hasło</label> <br/>
            <input required minlength="6" maxlength="30" type="password" id="password" name="password" placeholder="Utwórz hasło" style="margin-left: 2%;"/>
            <span class="eye" onclick="toggle()"> <i class="fas fa-eye-slash fa-1x"></i> </span><br/>

            <label for="password_check">Powtórz hasło</label> <br/>
            <input required minlength="6" maxlength="30" type="password" id="password_check" name="password_check" placeholder="Powtórz hasło" style="margin-left: 2%;"/>
            <span class="eye" onclick="toggle2()"> <i class="fas fa-eye-slash fa-1x"></i> </span><br/>
            
            <br/>
            <input class="button" type="submit" value="Zarejestruj się" />
        
    </form>
                        <!-- ZROBIĆ INNE IKONKI ZMIANA KLAS :) -->
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
        function toggle2() {
            let x = document.getElementById("password_check");
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