<?php
require 'connectDB.php';

$conn = connectDB();

$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$precio = $_POST['precio'];
$cantidad = $_POST['cantidad'];

$sql = "INSERT INTO LIBROS (titulo, autor, precio, cantidad) VALUES ('$titulo', '$autor', '$precio', '$cantidad')";

if ($conn->query($sql) === TRUE) {
    echo "Libro registrado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
