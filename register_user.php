<?php
require 'connectDB.php';

$conn = connectDB();

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];

$sql = "INSERT INTO USUARIOS (nombre, email, contraseña, direccion, telefono) VALUES ('$nombre', '$email', '$pass', '$direccion', '$telefono')";

if ($conn->query($sql) === TRUE) {
    echo "Usuario registrado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
