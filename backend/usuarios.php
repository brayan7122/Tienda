<?php
require_once 'config.php';
header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        // Obtener datos del usuario autenticado (ejemplo básico)
        // Aquí deberías validar sesión/token
        echo json_encode(['message' => 'GET usuario']);
        break;
    case 'POST':
        // Registrar nuevo usuario
        $data = json_decode(file_get_contents('php://input'), true);
        $sql = 'INSERT INTO users (email, password, name) VALUES (?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $data['email'], password_hash($data['password'], PASSWORD_DEFAULT), $data['name']
        ]);
        echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
}
?>
