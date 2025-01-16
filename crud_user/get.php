<?php
header("Content-Type: application/json");

require_once "../db.php";
require_once "../index.php";

try {
    $stmt = $pdo->query("SELECT id, name, email FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($users);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["erro" => "Erro ao buscar usuários: " . $e->getMessage()]);
}
