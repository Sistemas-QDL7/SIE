<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

require '../bd/Conexion.php';

// Obtener datos JSON enviados por React
$input = json_decode(file_get_contents("php://input"), true);

$username = $input['usuario'] ?? '';
$password = $input['contrasena'] ?? '';

if ($username === '' || $password === '') {
    echo json_encode(['success' => false, 'message' => 'Usuario o contraseña vacíos']);
    exit;
}

try {
    $stmt = $connect->prepare("SELECT id, username, name, email, password, rol FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
        exit;
    }

    // Comparar contraseñas (MD5 aquí, pero deberías migrar a password_hash más adelante)
    if (md5($password) === $user['password']) {
        unset($user['password']); // No enviar contraseña de vuelta
        echo json_encode(['success' => true, 'usuario' => $user]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Contraseña incorrecta']);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
}
