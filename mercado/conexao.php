<?php
$servername = "localhost";
$username = "root";  // Usualmente "root" no XAMPP ou WAMP
$password = "";      // Se não houver senha, deixe em branco
$dbname = "mercado"; // Nome do seu banco de dados

// Criar conexão
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar conexão
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
