<?php
    session_start();
    if (isset($_POST['password'])) {

        $register_valid = true;
        //name
        $name = $_POST['name'];
        if ((strlen($name)<3) || (strlen($name)>20)) 
        {
            $register_valid = false;
        }
        //surname
        $surname = $_POST['surname'];
        if ((strlen($surname)<3) || (strlen($surname)>30)) 
        {
            $register_valid = false;
        }
        //email
        $email = $_POST['email'];
        $email_sanitize = filter_var($email, FILTER_SANITIZE_EMAIL);

        if ((strlen($email)<4) || (strlen($email)>30) || (filter_var($email, FILTER_VALIDATE_EMAIL)==false) || ($email != $email_sanitize)) 
        {
            $register_valid = false;
        }
        //telephone
        if ((strlen($_POST['tel'])) > 0) {
            $tel = $_POST['tel'];
            $tel_sanitize = filter_var($tel, FILTER_SANITIZE_NUMBER_INT);
            if ((strlen($tel)<9) || (strlen($tel)>20) || ($tel != $tel_sanitize)) 
            {
                $register_valid = false;
            }
        }
        //city
        $city = $_POST['city'];
        if ((strlen($city)<3) || (strlen($city)>20)) 
        {
            $register_valid = false;
        }
        //zip-code
        $zip_code = $_POST['zip-code'];
        if ((strlen($zip_code)<3) || (strlen($zip_code)>20) || (!preg_match('/^[0-9]{2}-?[0-9]{3}$/Du', $zip_code))) 
        {
            $register_valid = false;
        }
        //street
        $street = $_POST['street'];
        if ((strlen($street)<3) || (strlen($street)>20))
        {
            $register_valid = false;
        }
        //password
        $password = $_POST['password'];
        $password2 = $_POST['password_check'];
        if ((strlen($password)<6) || (strlen($password)>30) || ($password != $password2))
        {
            $register_valid = false;
        }

        $_SESSION['name'] = $name;

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
            //does this email already exists?
            $result = $connection->query("SELECT ID_klienta from klienci WHERE email='$email'");
            if (!$result) throw new Exception($connection->error);
            if (($result->num_rows) > 0)
            {
                $register_valid = false;
                echo '<h2 style="text-align: center;color: #ed2d2d;">Taki e-mail jest już zarejestrowany w bazie danych</h2>';
            }
            if ($register_valid == true)
            {
                if ((strlen($_POST['tel'])) > 0) {
                if ($connection->query("INSERT INTO klienci VALUES (NULL, '$name', '$surname', '$tel', '$email', '$city', '$zip_code', '$street', '$password')"))
                {
                    $_SESSION['registered_successfully'] = true;
                    header('Location: login.php');
                }
                else {
                    throw new Exception($connection->error);
                }
                }
                if ((strlen($_POST['tel'])) == 0) {
                    if ($connection->query("INSERT INTO klienci VALUES (NULL, '$name', '$surname', NULL, '$email', '$city', '$zip_code', '$street', '$password')"))
                {
                    $_SESSION['registered_successfully'] = true;
                    header('Location: login.php');
                }
                else {
                    throw new Exception($connection->error);
                }
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

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Shop App - Register</title>
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
            <span class="eye" onclick="toggle()"> <i id="eye" class="fas fa-eye fa-1x"></i> </span><br/>

            <label for="password_check">Powtórz hasło</label> <br/>
            <input required minlength="6" maxlength="30" type="password" id="password_check" name="password_check" placeholder="Powtórz hasło" style="margin-left: 2%;"/>
            <span class="eye" onclick="toggle2()"> <i id="eye2" class="fas fa-eye fa-1x"></i> </span><br/>
            
            <br/>
            <input class="button" type="submit" value="Zarejestruj się" />
        
    </form>
    <script> 
        function toggle() {
            let eye = document.getElementById("eye");
            let x = document.getElementById("password");
            if (eye.classList.contains('fa-eye-slash')){
                eye.classList.remove('fa-eye-slash');
                eye.classList.add('fa-eye');
                x.type = "password";
            }
            else {
                x.type = "text";
                eye.classList.remove("fa-eye");
                eye.classList.add("fa-eye-slash");
            }
        }
        function toggle2() {
            let eye = document.getElementById("eye2");
            let x = document.getElementById("password_check");
            if (eye.classList.contains('fa-eye-slash')){
                eye.classList.remove('fa-eye-slash');
                eye.classList.add('fa-eye');
                x.type = "password";
            }
            else {
                x.type = "text";
                eye.classList.remove("fa-eye");
                eye.classList.add("fa-eye-slash");
            }
        }
    </script>
</body>
</html>