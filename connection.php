<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password,"glod_restauracja");
if (!$conn) {
    die("Ups.. coś poszło nie tak");
}

?>
