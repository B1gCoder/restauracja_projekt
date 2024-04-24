<?php
require("connection.php");
session_set_cookie_params(3600);
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: Login-Register/loginPage.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mortadello - Panel admina</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Forum&display=swap">
</head>
<body>
    <div class="container">
        <h1>Witaj w panelu admina</h1>
        <div class="form-button">
            <a href="Login-Register/logout.php">
                <input type="submit" value="Wyloguj się" name="logout" class="button button-zaloguj">
            </a>
        </div>
    </div>
</body>
</html>