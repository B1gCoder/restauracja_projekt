<?php

require '../connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imie_klienta = $_POST["imie_klienta"];
    $godzina_rezerwacji = $_POST["godzina_rezerwacji"];
    $data_rezerwacji = $_POST["data_rezerwacji"];
    $id_stolika = ($_POST["id_stolika"]);
    $dodatkowe_informacje = ($_POST["dodatkowe_informacje"]);

    $select_query_pojemnosc = "SELECT pojemnosc FROM stoliki WHERE id_stolika='$id_stolika';";
    $rezultat_pojemnosc = mysqli_query($conn, $select_query_pojemnosc);

    if ($rezultat_pojemnosc) {
        $row = mysqli_fetch_assoc($rezultat_pojemnosc);
        $liczba_miejsc = $row['pojemnosc'];

        $id_rezerwacji = intval($godzina_rezerwacji) . intval($data_rezerwacji) . intval($id_stolika);

        $query_insert1 = "INSERT INTO rezerwacje (dodatkowe_informacje, id_stolika, id_rezerwacji, imie, godzina_rezerwacji, data_rezerwacji, liczba_miejsc)
            VALUES ('$dodatkowe_informacje', '$id_stolika', '$id_rezerwacji', '$imie_klienta', '$godzina_rezerwacji', '$data_rezerwacji', '$liczba_miejsc');";

        $query_insert2 = "INSERT INTO dostepnosc_stolikow (id_dostepnosc, id_stolika, data_rezerwacji, godzina_rezerwacji, status)
            VALUES ('$id_rezerwacji', '$id_stolika', '$data_rezerwacji', '$godzina_rezerwacji', 'Nie');";

        mysqli_query($conn, $query_insert1);
        mysqli_query($conn, $query_insert2);
        header("Location: ../home.php");
    }
}

?>