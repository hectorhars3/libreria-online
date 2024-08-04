<?php
function connectDB() {
    $servername = "localhost";
    $username = "root";
    $password = "Lomejor1";
    $dbname = "LIBRERIA";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    return $conn;
}
?>
