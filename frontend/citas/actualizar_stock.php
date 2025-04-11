<?php
require_once('../../backend/bd/Conexion.php');

// Configurar encabezados para solicitudes CORS y JSON
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

try {
    // Leer los datos de entrada JSON
    $input = file_get_contents("php://input");
    $data = json_decode($input, true);

    // Log de los datos recibidos
    file_put_contents('D:/QDLTraba/Documentos/Scriot/log.txt', 'Datos recibidos: ' . json_encode($data) . PHP_EOL, FILE_APPEND);

    // Verificar que los datos sean válidos
    if ($data === null || !isset($data['codpro'], $data['cantidad'])) {
        file_put_contents('D:/QDLTraba/Documentos/Scriot/log.txt', 'Datos JSON no válidos o incompletos' . PHP_EOL, FILE_APPEND);
        echo json_encode(['success' => false, 'message' => 'Datos JSON no válidos o incompletos']);
        exit;
    }

    $codpro = $data['codpro'];
    $cantidad = (int)$data['cantidad'];

    // Verificar si el producto existe y tiene suficiente stock
    $sql = "SELECT stock FROM product WHERE codpro = :codpro";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':codpro', $codpro, PDO::PARAM_STR);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Log de la consulta para verificar el producto
    file_put_contents('D:/QDLTraba/Documentos/Scriot/log.txt', 'Resultado de consulta (producto): ' . json_encode($product) . PHP_EOL, FILE_APPEND);

    if (!$product) {
        file_put_contents('D:/QDLTraba/Documentos/Scriot/log.txt', 'Producto no encontrado: ' . $codpro . PHP_EOL, FILE_APPEND);
        echo json_encode(['success' => false, 'message' => 'Producto no encontrado']);
        exit;
    }

    if ($product['stock'] < $cantidad) {
        file_put_contents('D:/QDLTraba/Documentos/Scriot/log.txt', 'Stock insuficiente para codpro: ' . $codpro . ', solicitado: ' . $cantidad . ', disponible: ' . $product['stock'] . PHP_EOL, FILE_APPEND);
        echo json_encode(['success' => false, 'message' => 'Stock insuficiente']);
        exit;
    }

    // Actualizar el stock del producto
    $sql = "UPDATE product SET stock = stock - :cantidad WHERE codpro = :codpro";
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':cantidad', $cantidad, PDO::PARAM_INT);
    $stmt->bindParam(':codpro', $codpro, PDO::PARAM_STR);

    if ($stmt->execute()) {
        file_put_contents('D:/QDLTraba/Documentos/Scriot/log.txt', 'Stock actualizado correctamente para codpro: ' . $codpro . ', cantidad reducida: ' . $cantidad . PHP_EOL, FILE_APPEND);
        echo json_encode(['success' => true, 'message' => 'Stock actualizado']);
    } else {
        $errorInfo = $stmt->errorInfo();
        file_put_contents('D:/QDLTraba/Documentos/Scriot/log.txt', 'Error al actualizar stock: ' . json_encode($errorInfo) . PHP_EOL, FILE_APPEND);
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el stock']);
    }
} catch (Exception $e) {
    file_put_contents('D:/QDLTraba/Documentos/Scriot/log.txt', 'Error del servidor: ' . $e->getMessage() . PHP_EOL, FILE_APPEND);
    echo json_encode(['success' => false, 'message' => 'Error del servidor: ' . $e->getMessage()]);
}
?>
