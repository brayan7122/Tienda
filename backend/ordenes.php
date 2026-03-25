<?php
require_once 'config.php';
header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        // Obtener órdenes del usuario (ejemplo básico)
        echo json_encode(['message' => 'GET órdenes']);
        break;
    case 'POST':
        // Crear nueva orden
        $data = json_decode(file_get_contents('php://input'), true);
        $sql = 'INSERT INTO orders (userId, total, items, status, createdAt) VALUES (?, ?, ?, ?, NOW())';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $data['userId'], $data['total'], json_encode($data['items']), 'paid'
        ]);
        echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
}
?>
