<?php
require_once('../../backend/bd/Conexion.php');

$id = $_POST['id'];
$estado = $_POST['estado'];

// Actualizar el estado del colaborador en la base de datos
$sql = "UPDATE product SET state = :estado WHERE idprcd = :id";
$stmt = $connect->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':estado', $estado);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo 'ok';
} else {
    echo 'error';
}
?>