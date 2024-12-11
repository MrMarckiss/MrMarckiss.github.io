<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

   
    $conexion->query("DELETE FROM resenas WHERE id_videojuego = $id");

  
    if ($conexion->query("DELETE FROM videojuegos WHERE id_videojuego = $id")) {
        echo "<p>Videojuego eliminado con éxito.</p>";
        echo "<a href='./dietas.php'>Regresar a la lista</a>";
    } else {
        echo "<p>Error al eliminar el videojuego.</p>";
        echo "<a href='./dietas.php'>Regresar a la lista</a>";
    }
} else {
    echo "<p>ID de videojuego no proporcionado.</p>";
}
header("Location: ../dietas.php");
exit;

?>
