<?php
header("Content-Type: application/json");

require_once "../db.php";
require_once "../index.php";

$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input['id'], $input['name'], $input['email'])) {
    http_response_code(400);
    echo json_encode(["erro" => "Incomplete data"]);
    exit();
}

try {
    
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email AND id != :id");
    $stmt->execute([":email" => $input['email'], ":id" => $input['id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        http_response_code(400);
        echo json_encode(["erro" => "The email provided is already in use by another user."]);
        exit();
    }

    $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
    $stmt->execute([
        ":name" => $input['name'],
        ":email" => $input['email'],
        ":id" => $input['id']
    ]);

    echo json_encode(["message" => "User updated successfully!"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["erro" => "Error updating user: " . $e-> getMessage()]);
}
