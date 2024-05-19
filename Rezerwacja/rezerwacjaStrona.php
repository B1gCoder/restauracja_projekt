<?php
require_once '../connection.php';

// Start the session
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mortadello - Rezerwacja</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Forum&display=swap">
    <link rel="stylesheet" href="../CSS/styleRezerwacja.css">
</head>
<body>
    <div class="reserve-container">
            <a href="../home.php" style="color: hsl(70, 40%, 80%); margin-bottom: 30px;">
                <h2 class="text-center">Wróć do strony głównej</h2>
                <span class="sr-only"></span>
            </a>
        <div class="row">
            <div class="column">
                <div id="szukanie-stolika">
                    <h2 style=" color:white;">Sprawdź dostępność</h2>
                 
                    <form id="reservation-form" method="GET" action="dostepnosc.php"><br>
                        <div class="form-group">
                        <label for="data_rezerwacji">Wybierz datę</label><br>
                        <input class="form-control" type="date" id="data_rezerwacji" name="data_rezerwacji" style="color: hsla(0, 0%, 100%, 0.5" required>
                        </div>
                        <div class="form-group">
                        <label for="godzina_rezerwacji">Dostępne godziny</label>
                        <div id="dostepnosc-stoliki">
                            <?php
                            $dostepneGodziny = array();
                            for ($hour = 10; $hour <= 21; $hour++) {
                                for ($minute = 0; $minute < 60; $minute += 60) {
                                    $godzina = sprintf('%02d:%02d:00', $hour, $minute);
                                    $dostepneGodziny[] = $godzina;
                                }
                            }
                            echo '<select name="godzina_rezerwacji" id="godzina_rezerwacji" style="width:180px; border-radius: 0px;" class="form-control" >';
                            echo '<option value="" selected disabled>Wybierz godzinę</option>';
                            foreach ($dostepneGodziny as $godzina) {
                                echo "<option  value='$godzina'>$godzina</option>";
                            }
                            echo '</select>';
                            ?>
                        </div>
                        </div>
              
                        <input type="number" id="liczba_miejsc" name="liczba_miejsc" value=1 hidden required>
                        <button type="submit" class="btn" name="submit" style="font-size: 15px;">Sprawdź</button>
                    </form>
                </div>
            </div>

            <div class="column right-column">
                <div id="insert-rezerwacja">
                    <h2 style=" color:white;">Zrób rezerwację</h2>
                    <form id="rezerwacja-form" method="POST" action="rezerwacjaInsert.php">
                        <br>
                        <div class="form-group">
                            <label for="imie_klienta" style="">Imię klienta</label><br>
                            <input class="form-control" type="text" id="imie_klienta" name="imie_klienta" required>
                        </div>
                        <?php
                        $wzorDatyRezerwacji = $_GET['data_rezerwacji'] ?? date("Y-m-d");
                        $wzorGodzinyRezerwacji = $_GET['godzina_rezerwacji'] ?? "13:00:00";
                        ?>
                   
                        <div class="form-group " >
                            <label for="data_rezerwacji">Data rezerwacji</label><br>
                            <input type="date" id="data_rezerwacji" name="data_rezerwacji"
                                   value="<?= $wzorDatyRezerwacji ?>" style="color: hsla(0, 0%, 100%, 0.5" readonly required>
                            <input type="time" id="godzina_rezerwacji" name="godzina_rezerwacji"
                                   value="<?= $wzorGodzinyRezerwacji ?>" style="color: hsla(0, 0%, 100%, 0.5" readonly required>
                        </div>
                 
                        <div class="form-group">
                            <label for="id_stolika_rezerwacja">Dostępne stoliki</label>
                            <select class="form-control" name="id_stolika" id="id_stolika_rezerwacja" style="width:10em; border-radius: 0px;" required>
                                <option value="" selected disabled>Wybierz stolik</option>
                                <?php
                                $id_stolika_lista = $_GET['reserved_id_stolika'];
                                $liczba_miejsc = $_GET['liczba_miejsc'] ?? 1;
                                $reserved_id_stoliki = explode(',', $id_stolika_lista);
                                $select_query_stoliki = "SELECT * FROM stoliki WHERE pojemnosc >= '$liczba_miejsc'";
                                if (!empty($reserved_id_stoliki)) {
                                    $reserved_id_stoliki_string = implode(',', $reserved_id_stoliki);
                                    $select_query_stoliki .= " AND id_stolika NOT IN ($reserved_id_stoliki_string)";
                                }
                                $result_stoliki = mysqli_query($conn, $select_query_stoliki);
                                $esultSprwadzStoliki = mysqli_num_rows($result_stoliki);
                                if ($esultSprwadzStoliki > 0) {
                                    while ($row = mysqli_fetch_assoc($result_stoliki)) {
                                        echo '<option value="' . $row['id_stolika'] . '">Stolik dla ' . $row['pojemnosc'] . ' osób. (ID Stolika: ' . $row['id_stolika'] . ')</option>';
                                    }
                                }  else {
                                    echo '<option disabled>Brak wolnych stolików, proszę wybrać inny termin.</option>';
                                    echo '<script>alert("Nie znaleziono stolików na wybrany termin. Proszę wybrać inny termin.");</script>';
                                }
                                ?>
                            </select>
                            <input type="number" id="liczba_miejsc" name="liczba_miejsc" value="<?= $liczba_miejsc ?>" required hidden>
                        </div>
                 
                        <div class="form-group">
                            <label for="dodatkowe_informacje">Dodatkowe informacje dla restauracji</label><br>
                            <textarea class="form-control"  id="dodatkowe_informacje" name="dodatkowe_informacje"></textarea><br>
                            <button type="submit" class="btn" type="submit" name="submit" style="border-radius: 0px; font-weight: 700; font-size: 15px;">Zarezerwuj</button>
                        </div>
                        <div id="informacja">Po zarezerwowaniu stolika <br> (jeśli jest dostępny) - powrócisz na stronę główną</div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const viewDateInput = document.getElementById("data_rezerwacji");
        const makeDateInput = document.getElementById("data_rezerwacji");

        viewDateInput.addEventListener("change", function () {
            makeDateInput.value = this.value;
        });
    </script>
</body>

</html>
