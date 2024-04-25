<?php
require_once '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $wybranaData = $_GET["data_rezerwacji"];
    $liczba_miejsc = $_GET["liczba_miejsc"]; 
    $wybranaGodzina = date("H:i:s", strtotime($_GET["godzina_rezerwacji"]));

    $reservedQuery = "SELECT * FROM rezerwacje WHERE data_rezerwacji = '$wybranaData' AND godzina_rezerwacji = '$wybranaGodzina'";
    $reservedResult = mysqli_query($conn, $reservedQuery);

    $idStolikow = array();

    if ($reservedResult) {
        while ($row = mysqli_fetch_assoc($reservedResult)) {
            $idStolikow[] = $row["id_stolika"];
            // Print each row of data
            echo "Godzina rezerwacji: " . $row["godzina_rezerwacji"] . "<br>";
            echo "ID Rezerwacji: " . $row["id_rezerwacji"] . "<br>";
            echo "ID Stolika: " . $row["id_stolika"] . "<br>";
            echo "Data rezerwacji: " . $row["data_rezerwacji"] . "<br>";
            echo "Liczba miejsc: " . $row["liczba_miejsc"] . "<br>";
            echo "<br>"; 
        }
    } else {
        echo "Niepowodzenie (QUERY): " . mysqli_error($conn);
    }

    // Check available tables
    if (!empty($idStolikow)) {
        $idStolikowString = implode(",", $idStolikow);
        $dostepneStoliki = "SELECT id_stolika, pojemnosc FROM stoliki WHERE pojemnosc >= '$liczba_miejsc' AND id_stolika NOT IN ($idStolikowString)";
        $dostepneResult = mysqli_query($conn, $dostepneStoliki);

        if ($dostepneResult) {
            while ($row = mysqli_fetch_assoc($dostepneResult)) {
                echo "ID Dostępnego stolika " . $row["id_stolika"] . "<br>";
                echo "pojemnosc: " . $row["pojemnosc"] . "<br>";
                
            }
            // Construct the reservation link with all table IDs
            $idStolikowString = implode(",", $idStolikow);
            $rezerwacjaLink = "rezerwacjaStrona.php?data_rezerwacji=$wybranaData&liczba_miejsc=$liczba_miejsc&godzina_rezerwacji=$wybranaGodzina&reserved_id_stolika=$idStolikowString";

            // Add header link to reservationPage.php with parameters
            header("Location: $rezerwacjaLink");
            exit();
        } else {
            echo "Niepowodzenie (QUERY): " . mysqli_error($conn);
        }
    } else {
        $rezerwacjaLink = "rezerwacjaStrona.php?data_rezerwacji=$wybranaData&liczba_miejsc=$liczba_miejsc&godzina_rezerwacji=$wybranaGodzina&reserved_id_stolika=0";
        header("Location: $rezerwacjaLink");
    }
    

}
?>
