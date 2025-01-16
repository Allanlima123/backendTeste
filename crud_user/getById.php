<?php
header("Content-Type: application/json");

require_once "../db.php"; 
require_once "../index.php"; 

if (!isset($_GET['id'])) {
    http_response_code(400); // Retorna erro 400 se o ID não for fornecido
    echo json_encode(["erro" => "ID do usuário é necessário"]);
    exit();
}

$id = $_GET['id']; // Obtém o ID do usuário da URL

try {
    // Prepare a consulta para pegar o usuário pelo ID
    $stmt = $pdo->prepare("SELECT id, name, email FROM users WHERE id = :id");
    $stmt->execute([":id" => $id]);

    // Verifica se o usuário foi encontrado
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Retorna os dados do usuário em formato JSON
        echo json_encode($user);
    } else {
        // Retorna erro se o usuário não for encontrado
        http_response_code(404); // Não encontrado
        echo json_encode(["erro" => "Usuário não encontrado"]);
    }

} catch (PDOException $e) {
    // Se ocorrer um erro na consulta, retorna erro 500
    http_response_code(500);
    echo json_encode(["erro" => "Erro ao buscar o usuário: " . $e->getMessage()]);
}
?>
