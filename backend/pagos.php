<?php
require_once 'config.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $amount = $data['amount'] ?? 0;
    $method = $data['method'] ?? '';
    $details = $data['details'] ?? '';

    // Simulación de pago exitoso
    $response = [
        'status' => 'approved',
        'paymentId' => 'PYMT-' . time(),
        'amount' => $amount,
        'method' => $method,
        'processedAt' => date('c'),
        'message' => 'Pago simulado exitoso. Integra pasarela real en producción.'
    ];
    echo json_encode($response);
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
}
?>
