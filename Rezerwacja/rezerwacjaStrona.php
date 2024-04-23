<?php require("../connection.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezerwacja</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Forum&display=swap">
    <link rel="stylesheet" href="../CSS/style.css">
    <style>
        body {
            font-family: 'DM Sans';
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .rezerwacja-container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: hsla(210, 4%, 9%, 1);
            border-radius: 10px;
            color: hsl(70, 40%, 80%);
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }
        .form-control {
            color: hsla(0, 0%, 100%, 0.5);
            background-color: var(--bialy-alpha-10);
            width: 100%;
            height: 35px;
        }
        .form-control:focus {
            color: black;
        }
        .form-control[type="text"],
        .form-control[type="textarea"] {
            color: white;
        }
    </style>
</head>
<body>
    <div class="rezerwacja-container">
    <h1 class="text-center">MORTADELLO</h1>
        <form method="post" action="rezerwacjaInsert.php">

            <label for="stoliki">Dostępne stoliki</label><br>
            <select class="form-control" name="id_stolika" required>
                <?php
                $stoliki = mysqli_query($conn, "SELECT * FROM stoliki");
                while($x = mysqli_fetch_array($stoliki)) {
                ?>

                <option value="<?php echo $x['id_stolika']; ?>"><?php echo "Stolik dla " . $x['pojemnosc'] . " osób" . " (ID Stolika: " . $x['id_stolika'] . ")"?></option>
                <?php } ?>
            </select><br>

            <label for="godzina_rezerwacji">Godzina rezerwacji</label><br>
            <?php
                $dostepneGodziny = array();
                for ($godzina = 10; $godzina <= 21; $godzina++) {
                    for($minuta = 0; $minuta < 60; $minuta += 60) { 
                        $czas = sprintf('%02d:%02d', $godzina, $minuta);
                        $dostepneGodziny[] = $czas;
                    }
                }
                echo '<select class="form-control" name="godzina_rezerwacji" id="godzina_rezerwacji">';
                echo '<option value="" selected disabled>Wybierz godzinę</option>';
                foreach ($dostepneGodziny as $czas) {
                    echo "<option value='$czas'>$czas</option>";
                }
                echo '</select>';
            ?><br>

            <label for="data_rezerwacji">Wybierz datę</label><br>
            <input class="form-control" type="date" name="data_rezerwacji" id="data_rezerwacji" required><br>

            <label for="imie_klienta">Imię klienta</label><br>
            <input class="form-control" type="text" name="imie_klienta" id="imie_klienta" required><br>

            <label for="dodatkowe_informacje">Dodatkowe informacje</label><br>
            <textarea class="form-control" name="dodatkowe_informacje" id="dodatkowe_informacje" style="color: white"></textarea><br>
            <div class="form-button">
            <input type="submit" value="Zarezerwuj" name="zarezerwuj" class="button button-zaloguj">
            </div>
        </form>
    </div>
</body>
</html>