<?php
header("Content-Type: application/json");

require_once "../db.php";
require_once "../index.php";

$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input['name'], $input['email'], $input['password'])) {
    http_response_code(400);
    echo json_encode(["erro" => "Incomplete data"]);
    exit();
}

try {
    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
    $checkStmt->execute([":email" => $input['email']]);
    $emailExists = $checkStmt->fetchColumn();

    if ($emailExists > 0) {
        http_response_code(409); 
        echo json_encode(["erro" => "Email is already registered"]);
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
    echo json_encode(["message" => "User created successfully!"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["erro" => "Error creating user: " . $e->getMessage()]);
}
