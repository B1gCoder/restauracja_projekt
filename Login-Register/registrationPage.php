<?php
require("../connection.php");

session_set_cookie_params(3600);
session_start();
if (isset($_SESSION["user"])) {
    header("Location: ../adminPanel.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Forum&display=swap">
    <style>
        body {
            margin-top: 230px;
            padding: 50px;
        }

        .container {
            max-width: 300px;
            margin: 0 auto;
            padding: 50px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        .form-group {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            $phoneNumber = $_POST["phone-number"];
            $passwordRepeat = $_POST["repeat_password"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            
            $errors = array();

            if (empty($email) OR empty($password) OR empty($passwordRepeat) OR empty($phoneNumber)) {
                array_push($errors,"⚠️ Wszystkie dane są wymagane");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "⚠️ Adres email jest niepoprawny");
            }
            if (strlen($password)<8) {
                array_push($errors, "⚠️ Hasło jest za krótkie (min. 8 znaków)");
            }
            if ($password!==$passwordRepeat) {
                array_push($errors, "⚠️ Hasła nie są takie same");
            }

            require_once "../connection.php";
            $sql = "SELECT * FROM konta WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount>0) {
                array_push($errors,"⚠️ Email jest już powiązany do innego konta");
            }
            if (count($errors)>0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                $sql = "INSERT INTO konta (nr_telefonu, email, haslo) VALUES ( ?, ?, ? )";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt,"sss",$phoneNumber, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>✅ Zarejestrowano pomyślnie.</div>";
                } else {
                    die("Ups.. coś poszło nie tak");
                }
            }
        }
        ?>
        <form action="registrationPage.php" method="post">
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Hasło:">
            </div>
            <div class="form-group">
                <input type="password" name="repeat_password" class="form-control" placeholder="Powtórz hasło:">
            </div>
            <div class="form-group">
                <input type="text" name="phone-number" class="form-control" placeholder="Numer telefonu:">
            </div>
            <div class="form-button">
                <input type="submit" value="Zarejestruj się" name="submit" class="button button-zaloguj">
            </div>
        </form>
    </div>
</body>
</html>