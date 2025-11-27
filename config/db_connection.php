<?php

$server   = "localhost";
$user     = "root";
$password = "";
$db       = "bonanza_cotizaciones";

// Crear variable de conexión a la BD
$connection = new mysqli($server, $user, $password, $db);

// Evaluar la conexión de la base
if ($connection->connect_errno) {
    die("Conexion fallida: " . $connection->connect_errno);
}

// --- Consultas de clientes nuevos ---
$queryCount = "
    SELECT COUNT(*) AS total
    FROM registro_cliente
    WHERE DATE(fecha_registro) >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
";

$resultCount    = $connection->query($queryCount);
$clientesNuevos_7d = 0;

if ($resultCount && ($row = $resultCount->fetch_assoc())) {
    $clientesNuevos_7d = $row['total'];
}

$queryList = "
    SELECT nombre, fecha_registro
    FROM clientes
    ORDER BY fecha_registro DESC
    LIMIT 5
";

$resultList       = $connection->query($queryList);
$clientesRecientes = [];

if ($resultList && $resultList->num_rows > 0) {
    while ($row = $resultList->fetch_assoc()) {
        $clientesRecientes[] = $row;
    }
}
