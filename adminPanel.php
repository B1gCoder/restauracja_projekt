<?php
require("connection.php");
session_set_cookie_params(3600);
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: Login-Register/loginPage.php");
}

$isAdmin = false;
if (isset($_SESSION["user"]) && $_SESSION["user"] === "admin") {
    $isAdmin = true;
}

// REJESTRACJA UZYTKOWNIKOW

if (isset($_POST["submitRejestracja"]) && $isAdmin) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phoneNumber = $_POST["phone_number"];
    $passwordRepeat = $_POST["repeat_password"];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
    $errors = array();

    if (empty($email) OR empty($password) OR empty($passwordRepeat) OR empty($phoneNumber)) {
        array_push($errors,"⚠️ Wszystkie dane są wymagane");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "⚠️ Adres email jest niepoprawny");
    }
    if (strlen($password) < 8) {
        array_push($errors, "⚠️ Hasło jest za krótkie (min. 8 znaków)");
    }
    if ($password !== $passwordRepeat) {
        array_push($errors, "⚠️ Hasła nie są takie same");
    }

    $sql = "SELECT * FROM konta WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        array_push($errors,"⚠️ Email jest już powiązany z innym kontem");
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        $sql = "INSERT INTO konta (nr_telefonu, email, haslo) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $phoneNumber, $email, $passwordHash);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>✅ Zarejestrowano pomyślnie.</div>";
        } else {
            die("Ups.. coś poszło nie tak");
        }
    }
}

?>

<?php 

// DODAWANIE POTRAW DO MENU

if(isset($_POST["submit"]) && $isAdmin) {
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

// USUWANIE POTRAW Z MENU

if (isset($_POST["delete"]) && $isAdmin) {
    $deleteId = $_POST["delete_id"];
    $query = "DELETE FROM menu WHERE id_potrawy = '$deleteId'";

    if (mysqli_query($conn, $query)) {
        echo "Potrawa została usunięta pomyślnie.";
    } else {
        echo "Błąd przy usuwaniu potrawy: " . mysqli_error($conn);
    }
}

// USUWANIE REZERWACJI

if (isset($_POST["delete1"]) && $isAdmin) {
    $deleteId1 = $_POST["delete_id1"];
    $query1 = "DELETE FROM rezerwacje WHERE id_rezerwacji = '$deleteId1'";

    if (mysqli_query($conn, $query1)) {
        echo "Rezerwacja została usunięta pomyślnie.";
    } else {
        echo "Błąd przy usuwaniu rezerwacji: " . mysqli_error($conn);
    }
}

// QUERY DO TABELI MENU

$queryMenu = "SELECT id_potrawy, menu_nazwa, menu_kategoria, menu_cena, menu_opis FROM menu";
$resultMenu = mysqli_query($conn, $queryMenu);
$menuItems = mysqli_fetch_all($resultMenu, MYSQLI_ASSOC);

// QUERY DO TABELI REZERWACJE

$queryStoliki = "SELECT id_rezerwacji, imie, id_stolika, godzina_rezerwacji, data_rezerwacji, liczba_miejsc, dodatkowe_informacje FROM rezerwacje";
$resultStoliki = mysqli_query($conn, $queryStoliki);
$stolikiItems = mysqli_fetch_all($resultStoliki, MYSQLI_ASSOC);

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
        </div><br>
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
                    <th>Akcje</th>
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
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($item['id_potrawy']); ?>">
                                <button type="submit" name="delete" class="button button-usun">Usuń</button>
                            </form>
                        </td>
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
        <h2>Rezerwacje</h2>
        <table>
            <thead>
                <tr>
                    <th>ID rezerwacji</th>
                    <th>Imię</th>
                    <th>ID stolika</th>
                    <th>Godzina rezerwacji</th>
                    <th>Data rezerwacji</th>
                    <th>Liczba miejsc</th>
                    <th>Dodatkowe informacje</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stolikiItems as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['id_rezerwacji']); ?></td>
                        <td><?php echo htmlspecialchars($item['imie']); ?></td>
                        <td><?php echo htmlspecialchars($item['id_stolika']); ?></td>
                        <td><?php echo htmlspecialchars($item['godzina_rezerwacji']); ?></td>
                        <td><?php echo htmlspecialchars($item['data_rezerwacji']); ?></td>
                        <td><?php echo htmlspecialchars($item['liczba_miejsc']); ?></td>
                        <td><?php echo htmlspecialchars($item['dodatkowe_informacje']); ?></td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="delete_id1" value="<?php echo htmlspecialchars($item['id_rezerwacji']); ?>">
                                <button type="submit" name="delete1" class="button button-usun">Usuń</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="container2">
        <h2>Rejestracja użytkowników</h2>
        <form action="adminPanel.php" method="post">
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
                <input type="text" name="phone_number" class="form-control" placeholder="Numer telefonu:">
            </div>
            <div class="form-button">
                <input type="submit" value="Zarejestruj się" name="submitRejestracja" class="button button-zaloguj">
            </div>
        </form>
    </div>
    <script src="JS/DodawaniePotraw.js"></script>
</body>
</html>