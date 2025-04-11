<?php
// Conexión a la base de datos
require_once '../../backend/bd/Conexion.php';

$data = json_decode(file_get_contents('php://input'), true);
$codpro = $data['codpro'];
$cantidad = $data['cantidad'];

if (isset($codpro) && isset($cantidad)) {
    // Verificar el stock actual
    $query = $connect->prepare("SELECT stock FROM product WHERE codpro = :codpro");
    $query->execute(['codpro' => $codpro]);
    $producto = $query->fetch(PDO::FETCH_ASSOC);

    if ($producto && $producto['stock'] >= $cantidad) {
        // Actualizar el stock
        $update = $connect->prepare("UPDATE product SET stock = stock - :cantidad WHERE codpro = :codpro");
        $update->execute(['cantidad' => $cantidad, 'codpro' => $codpro]);

        echo json_encode(['status' => 'success', 'message' => 'Stock actualizado correctamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Stock insuficiente o producto no encontrado.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Datos inválidos.']);
}
?>
