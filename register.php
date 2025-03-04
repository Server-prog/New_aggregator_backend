<?php
require 'config.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->name) && !empty($data->email) && !empty($data->password)) {
    $name = htmlspecialchars(strip_tags($data->name));
    $email = htmlspecialchars(strip_tags($data->email));
    $password = password_hash($data->password, PASSWORD_DEFAULT); // Criptografar a senha

    $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
    $stmt = $conn->prepare($query);

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);

    if ($stmt->execute()) {
        echo json_encode(["message" => "Usuário registrado com sucesso!"]);
    } else {
        echo json_encode(["error" => "Erro ao registrar usuário."]);
    }
} else {
    echo json_encode(["error" => "Preencha todos os campos."]);
}

//EXPLICAÇÃO

/* 
Recebe os dados enviados no corpo da requisição (JSON).
Sinitiza os inputs para evitar ataques.
Criptografa a senha com "password_hash()".
Insere os dados no banco de dados.
Retorna uma resposta JSON.
*/
?>

