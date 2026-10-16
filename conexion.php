<?php
// Modificar los parámetros para que coincidan con nuestra red de contenedores
$host = "db-mysql"; // <- ¡IMPORTANTE! Este será el nombre del servicio en Docker
$dbname = "db_proyecto_mvc";
$usuario = "root";
$contrasena = "clave_secreta_nube";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $contrasena);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
