<?php
header("Content-Type: application/json");

require_once "../db.php";
require_once "../index.php";

$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input['id'], $input['name'], $input['email'])) {
    http_response_code(400);
    echo json_encode(["erro" => "Dados incompletos"]);
    exit();
}

try {
    
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email AND id != :id");
    $stmt->execute([":email" => $input['email'], ":id" => $input['id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        http_response_code(400);
        echo json_encode(["erro" => "O e-mail informado já está em uso por outro usuário."]);
        exit();
    }

    // Atualizar o usuário se o e-mail não for duplicado
    $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
    $stmt->execute([
        ":name" => $input['name'],
        ":email" => $input['email'],
        ":id" => $input['id']
    ]);

    echo json_encode(["mensagem" => "Usuário atualizado com sucesso!"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["erro" => "Erro ao atualizar usuário: " . $e->getMessage()]);
}
