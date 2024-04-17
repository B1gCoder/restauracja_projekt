<?php
require("connection.php");

$result = mysqli_query($conn, "SELECT * FROM stoliki");

// while ($row = mysqli_fetch_array($result)) {
//     echo "Stolik dla " . $row['pojemnosc'] . " osób" . " (ID Stolika: " . $row['id_stolika'] . ")" . "<br> ";
// }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restauracja</title>
</head>
<body>
    <br>
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
</body>
</html>