<?php require("connection.php"); ?>

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
    <style>
        body {
            font-family: 'DM Sans';
            background-color: hsla(210, 4%, 9%, 1);   
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
            background-color: rgb(255, 255, 255, 0.1);
            border-radius: 10px;
            text-align: center;
            color: hsl(70, 40%, 80%);
        }
    </style>
</head>
<body>
    <div class="rezerwacja-container">
    <h1 class="text-center">MORTADELLO</h1>
        <form method="post" action="rezerwacjaInsert.php">

            <label for="stoliki">Dostępne stoliki</label><br>
            <select class="form_control" name="id_stolika" required>
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
            echo '<select name="godzina_rezerwacji" id="godzina_rezerwacji">';
            echo '<option value="" selected disabled>Wybierz godzinę</option>';
            foreach ($dostepneGodziny as $czas) {
                echo "<option value='$czas'>$czas</option>";
            }
            echo '</select>';
        ?><br>

            <label for="data_rezerwacji">Wybierz datę</label><br>
            <input class="form_control" type="date" name="data_rezerwacji" id="data_rezerwacji" required><br>

            <label for="imie_klienta" style="">Imię klienta</label><br>
            <input class="form-control" type="text" name="imie_klienta" id="imie_klienta" required><br>

            <label for="dodatkowe_informacje">Dodatkowe informacje</label><br>
            <textarea class="form-control" name="dodatkowe_informacje" id="dodatkowe_informacje"></textarea><br>

            <button type="submit">Zarezerwuj</button>
        </form>
    </div>
</body>
</html>