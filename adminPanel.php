<?php
require("connection.php");
session_set_cookie_params(3600);
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: Login-Register/loginPage.php");
}
?>

<?php 
if(isset($_POST["submit"])) {
    $idPotrawy = ($_POST["id_potrawy"]);
    $nazwaPotrawy = $_POST["menu_nazwa"];
    $kategoriaPotrawy = $_POST["menu_kategoria"];
    $cenaPotrawy = $_POST["menu_cena"];
    $opisPotrawy = $_POST["menu_opis"];

    $query = "INSERT INTO menu (id_potrawy, menu_nazwa, menu_kategoria, menu_cena, menu_opis) VALUES ('$idPotrawy', '$nazwaPotrawy','$kategoriaPotrawy','$cenaPotrawy','$opisPotrawy')";
    mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mortadello - Panel admina</title>
    <link rel="stylesheet" href="CSS/styleAdminPanel.css">
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
    <div class="form-group">
        <form method="post">
            <label>ID Potrawy</label><br>
            <input type="text" name="idPotrawy" required value=""><br>
            <label>Nazwa potrawy</label><br>
            <input type="text" name="nazwaPotrawy" required value=""><br>
            <p>Kategoria potrawy</p>
            <input type="radio" name="kategoriaPotrawy" required value="Burgery">
            <label>Burgery</label>
            <input type="radio" name="kategoriaPotrawy" required value="Sałatki">
            <label>Sałatki</label>
            <input type="radio" name="kategoriaPotrawy" required value="Pizza">
            <label>Pizza</label><br>
            <label>Cena potrawy</label><br>
            <input type="text" name="cenaPotrawy" required value=""><br>
            <label>Opis potrawy</label><br>
            <textarea name="opisPotrawy" required value=""></textarea><br>
            <div class="form-button">
            <button type="submit" class="button button-zaloguj" name="submit">Dodaj potrawę</button>
            </div>
        </form>
    </div>
</body>
</html>