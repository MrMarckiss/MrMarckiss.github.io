<?php session_start();
include './conexion.php';

$idUsuario = $_SESSION['user_data']['id'];
$idVideojuego = $_POST['idVideojuego'];
$calificacion = $_POST['calificacion'];
$comentario = $_POST['comentario'];
$fecha = date('Y-m-d'); 


$consulta = "INSERT INTO resenas (id_usuario, id_videojuego, calificacion, comentario, fecha_publicacion) 
             VALUES ('$idUsuario', '$idVideojuego', '$calificacion', '$comentario', '$fecha')";


if ($conexion->query($consulta)) {
    header("Location: ./detalles.php?id=".$idVideojuego);
} else {
    echo "Error al agregar la reseña: " . $conexion->error;
}
?>
