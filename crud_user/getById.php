<?php
header("Content-Type: application/json");

require_once "../db.php"; 
require_once "../index.php"; 

if (!isset($_GET['id'])) {
    http_response_code(400); 
    echo json_encode(["erro" => "User ID is required"]);
    exit();
}

$id = $_GET['id']; 

try {
    $stmt = $pdo->prepare("SELECT id, name, email FROM users WHERE id = :id");
    $stmt->execute([":id" => $id]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode($user);
    } else {
        http_response_code(404); 
        echo json_encode(["erro" => "User not found"]);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["erro" => "Error when searching for user: " . $e->getMessage()]);
}
?>
