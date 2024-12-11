<?php
session_start();

if (!isset($_SESSION['user_data'])) {
    header("./php/login.php");
    exit();
}

include "./conexion.php";

if (isset($_POST['user_id']) && is_numeric($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);

    try {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $conexion->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $conexion->error);
        }

        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['message'] = "Usuario eliminado correctamente.";
        } else {
            $_SESSION['message'] = "No se encontró el usuario o no se pudo eliminar.";
        }

        $stmt->close();
    } catch (Exception $e) {
        error_log("Error al eliminar usuario: " . $e->getMessage());
        $_SESSION['message'] = "Ocurrió un error al intentar eliminar el usuario.";
    }
} else {
    $_SESSION['message'] = "ID de usuario no proporcionado o inválido.";
}

header("Location: ../users.php?error=1");
exit();

$conexion->close();
?>

