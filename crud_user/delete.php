<?php
header("Content-Type: application/json");

require_once "../db.php";
require_once "../index.php";

$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input['id'])) {
    http_response_code(400);
    echo json_encode(["erro" => "User ID is required"]);
    exit();
}

try {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute([":id" => $input['id']]);

    echo json_encode(["message" => "User deleted successfully!"]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["erro" => "Error deleting user: " . $e->getMessage()]);
}
