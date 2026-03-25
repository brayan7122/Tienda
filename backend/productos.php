<?php
require_once 'config.php';
header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        // Obtener todos los productos
        $stmt = $pdo->query('SELECT * FROM products');
        $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($productos);
        break;
    case 'POST':
        // Crear un nuevo producto (ejemplo básico)
        $data = json_decode(file_get_contents('php://input'), true);
        $sql = 'INSERT INTO products (name, description, category, price, image, stock) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $data['name'], $data['description'], $data['category'], $data['price'], $data['image'], $data['stock']
        ]);
        echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
        break;
    // Puedes agregar PUT y DELETE aquí
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
}
?>
