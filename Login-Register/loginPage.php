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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Forum&display=swap">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <title>Restauracja | Mortadello</title>
    <style>
        body {
            margin-top: 250px;
            display: flex;
            text-align: center;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container1">
        <?php
        if (isset($_POST["login"])) {

            $email = $_POST["email"];
            $haslo = $_POST["haslo"];

            $admin_email = "test@test.pl";
            $admin_haslo = "12345678";

                require_once "../connection.php";

                if ($email === $admin_email && $haslo === $admin_haslo) {
                    session_start();
                    $_SESSION["user"] = "admin";
                    header("Location: ../adminPanel.php");
                    exit();
                }

                $sql = "SELECT * FROM konta WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($user) {
                    if (password_verify($haslo, $user["haslo"])) {
                        session_start();
                        $_SESSION["user"] = "yes";
                        header("Location: ../adminPanel.php");
                        die();
                    } else {
                        echo "<div class='alert alert-danger'>Hasło jest nieprawidłowe</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Email jest nieprawidłowy</div>";
                }
        }
        ?>
        <form action="loginPage.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Podaj email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Podaj hasło" name="haslo" class="form-control">
            </div>
            <div class="form-button">
                <input type="submit" value="Zaloguj się" name="login" class="button button-zaloguj">
            </div>
        </form>
        <!-- <div><p>Nie masz konta?<a href="registrationPage.php" class="hoverText-bezowy">Zarejestruj się tutaj</a></p></div> -->
    </div>
</body>
</html>