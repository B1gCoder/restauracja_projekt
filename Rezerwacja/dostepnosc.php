<?php
require_once '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $wybranaData = $_GET["data_rezerwacji"];
    $liczba_miejsc = $_GET["liczba_miejsc"];
    $wybranaGodzina = date("H:i:s", strtotime($_GET["godzina_rezerwacji"]));

    // Sprawdzenie istniejących rezerwacji
    $reservedQuery = "SELECT id_stolika, godzina_rezerwacji, id_rezerwacji, data_rezerwacji, liczba_miejsc FROM rezerwacje WHERE data_rezerwacji = '$wybranaData' AND godzina_rezerwacji = '$wybranaGodzina'";
    $reservedResult = mysqli_query($conn, $reservedQuery);

    $idStolikow = [];
    if ($reservedResult) {
        while ($row = mysqli_fetch_assoc($reservedResult)) {
            $idStolikow[] = $row["id_stolika"];
            echo "Godzina rezerwacji: " . htmlspecialchars($row["godzina_rezerwacji"]) . "<br>";
            echo "ID Rezerwacji: " . htmlspecialchars($row["id_rezerwacji"]) . "<br>";
            echo "ID Stolika: " . htmlspecialchars($row["id_stolika"]) . "<br>";
            echo "Data rezerwacji: " . htmlspecialchars($row["data_rezerwacji"]) . "<br>";
            echo "Liczba miejsc: " . htmlspecialchars($row["liczba_miejsc"]) . "<br><br>";
        }
    } else {
        echo "Niepowodzenie (QUERY): " . mysqli_error($conn);
    }

    // Szukanie dostępnych stolików
    $idStolikowString = empty($idStolikow) ? "0" : implode(",", $idStolikow);
    $dostepneStolikiQuery = "SELECT id_stolika, pojemnosc FROM stoliki WHERE pojemnosc >= '$liczba_miejsc' AND id_stolika NOT IN ($idStolikowString)";
    $dostepneResult = mysqli_query($conn, $dostepneStolikiQuery);

    $rezerwacjaLink = "rezerwacjaStrona.php?data_rezerwacji=$wybranaData&liczba_miejsc=$liczba_miejsc&godzina_rezerwacji=$wybranaGodzina&zarezerwowane_id_stolika=$idStolikowString";
    header("Location: $rezerwacjaLink");
    exit();
}
?>
