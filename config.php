<?php 

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=UTF-8');

$host = "localhost";
$db_name = "auth_db";
$username = "root"; //Usuario padrão do MySQL no XAMPP
$password = ""; // Senha vazia por padrão

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(["error" => "Erro de conexão: " . $e->getMessage()]);
    exit;
}

?>