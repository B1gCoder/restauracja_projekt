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
    $idPotrawy = $_POST["idPotrawy"];
    $nazwaPotrawy = $_POST["nazwaPotrawy"];
    $kategoriaPotrawy = $_POST["kategoriaPotrawy"];
    $cenaPotrawy = $_POST["cenaPotrawy"];
    $opisPotrawy = $_POST["opisPotrawy"];

    $query = "INSERT INTO menu (id_potrawy, menu_nazwa, menu_kategoria, menu_cena, menu_opis) VALUES ('$idPotrawy', '$nazwaPotrawy','$kategoriaPotrawy','$cenaPotrawy','$opisPotrawy')";
    
    if(mysqli_query($conn, $query)) {
        echo "Potrawa została dodana pomyślnie.";
    } else {
        echo "Błąd przy dodawaniu potrawy: " . mysqli_error($conn);
    }
}

$queryMenu = "SELECT id_potrawy, menu_nazwa, menu_kategoria, menu_cena, menu_opis FROM menu";
$resultMenu = mysqli_query($conn, $queryMenu);
$menuItems = mysqli_fetch_all($resultMenu, MYSQLI_ASSOC);
mysqli_free_result($resultMenu);

$queryStoliki = "SELECT id_dostepnosc, id_stolika, data_rezerwacji, godzina_rezerwacji, status FROM dostepnosc_stolikow";
$resultStoliki = mysqli_query($conn, $queryStoliki);
$stolikiItems = mysqli_fetch_all($resultStoliki, MYSQLI_ASSOC);
mysqli_free_result($resultStoliki);

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
        <h2 class="text-Witaj">Witaj w panelu admina</h2>
        <div class="form-button">
            <a href="Login-Register/logout.php" class="button-wyloguj">
                <input type="submit" value="Wyloguj się" name="logout" class="button button-zaloguj">
            </a>
        </div>
    </div>
    <div class="menu-section">
        <h2>Menu</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Potrawy</th>
                    <th>Nazwa</th>
                    <th>Kategoria</th>
                    <th>Cena</th>
                    <th>Opis</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menuItems as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['id_potrawy']); ?></td>
                        <td><?php echo htmlspecialchars($item['menu_nazwa']); ?></td>
                        <td><?php echo htmlspecialchars($item['menu_kategoria']); ?></td>
                        <td><?php echo htmlspecialchars($item['menu_cena']); ?></td>
                        <td><?php echo htmlspecialchars($item['menu_opis']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="form-button">
        <button id="toggle-showForm" class="button button-zaloguj">Dodawanie potraw</button>
    </div>
    <div class="form-group">
        <form id="dodawaniePotrawyForm" method="post" style="display:none;">
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
    <div class="stoliki-section">
        <h2>Dostępność stolików</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Dostępności</th>
                    <th>ID Stolika</th>
                    <th>Data rezerwacji</th>
                    <th>Godzina rezerwacji</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stolikiItems as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['id_dostepnosc']); ?></td>
                        <td><?php echo htmlspecialchars($item['id_stolika']); ?></td>
                        <td><?php echo htmlspecialchars($item['data_rezerwacji']); ?></td>
                        <td><?php echo htmlspecialchars($item['godzina_rezerwacji']); ?></td>
                        <td><?php echo htmlspecialchars($item['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="JS/DodawaniePotraw.js"></script>
</body>
</html>