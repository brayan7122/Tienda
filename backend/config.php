<?php
// config.php - Conexión a MySQL para XAMPP/phpMyAdmin
$host = 'localhost';
$db = 'tienda_gaming'; // Cambia esto por el nombre real
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}
?>
