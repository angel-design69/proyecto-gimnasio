<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "gym"; // ❌ antes era "gym.bd", el punto no se usa en nombres de BD

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar si hay error de conexión
if ($conn->connect_error) { // ❌ era $conn->connect.error
    die("Error en la conexión: " . $conn->connect_error);
}
?>
