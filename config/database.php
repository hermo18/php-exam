<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'library';

$conn = new mysqli($host, $username, $password, $database);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>