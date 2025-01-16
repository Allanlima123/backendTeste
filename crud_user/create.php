<?php
header("Content-Type: application/json");

require_once "../db.php";
require_once "../index.php";

$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input['name'], $input['email'], $input['password'])) {
    http_response_code(400);
    echo json_encode(["erro" => "Dados incompletos"]);
    exit();
}

try {
    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
    $checkStmt->execute([":email" => $input['email']]);
    $emailExists = $checkStmt->fetchColumn();

    if ($emailExists > 0) {
        http_response_code(409); 
        echo json_encode(["erro" => "O email já está cadastrado"]);
        exit();
    }

    $senhaHash = password_hash($input['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
    $stmt->execute([
        ":name" => $input['name'],
        ":email" => $input['email'],
        ":password" => $senhaHash
    ]);

    http_response_code(201);
    echo json_encode(["mensagem" => "Usuário criado com sucesso!"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["erro" => "Erro ao criar usuário: " . $e->getMessage()]);
}
