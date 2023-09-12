<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "db_blog";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Opcional: Establecer el juego de caracteres a UTF-8 (esto puede variar según tus necesidades)
mysqli_set_charset($conn, "utf8");

// Función para ejecutar consultas SQL
function dbQuery($sql)
{
    global $conn;
    $result = $conn->query($sql);

    if ($result === false) {
        die("Error en la consulta: " . $conn->error);
    }

    return $result;
}
