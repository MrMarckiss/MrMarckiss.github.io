<?php
session_start();

if (!isset($_SESSION['user_data'])) {
    header("Location: ./php/login.php");
    exit();
}

include './conexion.php';

if (isset($_POST['id_resena']) && is_numeric($_POST['id_resena'])) {
    $id_resena = intval($_POST['id_resena']);
    
    try {
        
        $sql = "DELETE FROM resenas WHERE id_resena = ?";
        $stmt = $conexion->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $conexion->error);
        }

        $stmt->bind_param("i", $id_resena);
        $stmt->execute();

      
        if ($stmt->affected_rows > 0) {
            $_SESSION['message'] = "Reseña eliminada correctamente.";
        } else {
            $_SESSION['message'] = "No se encontró la reseña o no se pudo eliminar.";
        }

        $stmt->close();
    } catch (Exception $e) {
        error_log("Error al eliminar reseña: " . $e->getMessage());
        $_SESSION['message'] = "Ocurrió un error al intentar eliminar la reseña.";
    }
} else {
    $_SESSION['message'] = "ID de reseña no proporcionado o inválido.";
}

header("Location: ../resenas.php"); 
exit();

$conexion->close();
?>
