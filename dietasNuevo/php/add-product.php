<?php
include "./conexion.php";

$titulo = $_POST['txtTitulo'];
$desarrollador = $_POST['txtDesarrollador'];
$fecha_lanzamiento = $_POST['txtFechaLanzamiento'];
$genero = $_POST['txtGenero'];
$imagen = "default.jpg";

if (isset($_FILES['txtFile']) && $_FILES['txtFile']['error'] === 0) {
    $ruta = "../img/"; 
    $nombreArchivo = time() . "_" . basename($_FILES['txtFile']['name']);
    $rutaCompleta = $ruta . $nombreArchivo;

    $tipoArchivo = pathinfo($rutaCompleta, PATHINFO_EXTENSION);
    $tiposPermitidos = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array(strtolower($tipoArchivo), $tiposPermitidos)) {
        if (move_uploaded_file($_FILES['txtFile']['tmp_name'], $rutaCompleta)) {
            $imagen = $nombreArchivo;
        } else {
            echo "Error al mover el archivo.";
        }
    } else {
        echo "Tipo de archivo no permitido.";
    }
}

$consulta = "INSERT INTO videojuegos (titulo, genero, fecha_lanzamiento, desarrollador, img_videojuego) 
             VALUES ('$titulo', '$genero', '$fecha_lanzamiento', '$desarrollador', '$imagen')";

if ($conexion->query($consulta)) {
    echo "Videojuego registrado correctamente.";
    header("Location: ../dietas.php");  
} else {
    echo "Error al registrar: " . $conexion->error;
}
?>
