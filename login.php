<?php
require 'config.php';

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->email) && !empty($data->password)) {
    $email = htmlspecialchars(strip_tags($data->email));
    $password = $data->password;

    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        echo json_encode(["message" => "Login bem-sucedido!", "user" => $user["name"]]);
    } else {
        echo json_encode(["error" => "E-mail ou senha inválidos."]);
    }
} else {
    echo json_encode(["error" => "Preencha todos os campos."]);
}

//Explicação de endpoint de login

/* 
Busca o usuário no banco pelo email.
Verifica a senha com password_verify().
Retorna um JSON com sucesso ou erro.
 */

?>