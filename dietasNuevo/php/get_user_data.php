<?php
include './conexion.php';

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);

    $sql = "SELECT id, name, last_name, age, email FROM users WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
        echo json_encode($userData); 
    } else {
        echo json_encode(["error" => "Usuario no encontrado."]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "ID de usuario no proporcionado."]);
}

$conexion->close();
?>
