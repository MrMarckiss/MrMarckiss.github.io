<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $resultado = $conexion->query("SELECT v.*, g.nombre_genero 
                                   FROM videojuegos v 
                                   JOIN generos g 
                                   ON v.genero = g.id_genero 
                                   WHERE v.id_videojuego = $id");

    if ($resultado->num_rows > 0) {
        $videojuego = $resultado->fetch_assoc();
        echo "
        <div class='container mt-5'>
            <div class='card bg-dark text-white shadow-lg border-0 rounded'>
               <img src='../img/{$videojuego['img_videojuego']}' style='height: 400px; object-fit: cover; width: 100%;' class='card-img-top' alt='{$videojuego['titulo']}'>
                <div class='card-body'>
                    <h3 class='card-title text-center mb-4'>{$videojuego['titulo']}</h3>
                    <p class='card-text'><strong>Género:</strong> {$videojuego['nombre_genero']}</p>
                    <p class='card-text'><strong>Desarrollador:</strong> {$videojuego['desarrollador']}</p>
                    <p class='card-text'><strong>Fecha de lanzamiento:</strong> {$videojuego['fecha_lanzamiento']}</p>
                    <div class='d-flex justify-content-between mt-4'>
                        <a href='./eliminar-videogame.php?id={$videojuego['id_videojuego']}' class='btn btn-dark btn-lg px-4 py-2'>Eliminar</a>
                        <a href='../dietas.php' class='btn btn-light btn-lg px-4 py-2'>Regresar</a>
                        <button class='btn btn-dark mb-4' data-bs-toggle='modal' data-bs-target='#modalAddResena'>Agregar Reseña</button>
                    </div>
                </div>
            </div>
        </div>";
    } else {
        echo "<p>No se encontró el videojuego.</p>";
    }
} else {
    echo "<p>ID de videojuego no proporcionado.</p>";
}
?>

<style>
    body {
        background-color: #000000;
        font-family: 'Arial', sans-serif;
        color: #fff;
    }
    
    .container {
        max-width: 900px;
        margin: 0 auto;
    }

    .card {
        border-radius: 15px;
        background-color: #222;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .card-title {
        font-size: 2.5em;
        font-weight: bold;
        color: #ffdd57;
    }

    .card-text {
        font-size: 1.2em;
        margin: 15px 0;
        color: #ccc;
    }

    .btn {
        font-size: 1.1em;
        padding: 12px 24px;
        border-radius: 8px;
        transition: all 0.3s ease;
        text-decoration: none; 
    }

    .btn-dark {
        background-color: #000;
        border-color: #000;
        color: #fff;
    }

    .btn-dark:hover {
        background-color: #444;
        border-color: #444;
    }

    .btn-light {
        background-color: #ecf0f1;
        border-color: #ecf0f1;
        color: #000;
    }

    .btn-light:hover {
        background-color: #bdc3c7;
        border-color: #bdc3c7;
    }

    .card-img-top {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .card-body {
        padding: 30px;
    }

    .card-body p {
        line-height: 1.6;
    }
    #colorModal{
        background-color:black;
    }
</style>
<div class="row g-4">
        <?php
      
        $resenas = $conexion->query("
            SELECT r.*, v.titulo, CONCAT(u.name, ' ', u.last_name) AS nombre_usuario
            FROM resenas r
            JOIN videojuegos v ON r.id_videojuego = v.id_videojuego
            JOIN users u ON r.id_usuario = u.id where r.id_videojuego=".$id);

        while ($resena = $resenas->fetch_assoc()) {
            echo "
            <div class='col-md-6 col-lg-4'>
                <div class='card shadow-sm h-100'>
                    <div class='card-body'>
                        <h5 class='card-title text-primary'>{$resena['titulo']}</h5>
                        <h6 class='card-subtitle mb-2 text-muted'>Usuario: {$resena['nombre_usuario']}</h6>
                        <p class='card-text'><strong>Calificación:</strong> {$resena['calificacion']}/5</p>
                        <p class='card-text'><strong>Comentario:</strong> {$resena['comentario']}</p>
                        <p class='card-text text-muted'><small>Publicado el: {$resena['fecha_publicacion']}</small></p>
                        <div class='d-flex justify-content-between'>
                            <button class='btn btn-sm btn-primary'>Editar</button>
                            <form action='delete-resena.php' method='POST' style='display:inline;'>
                                <input type='hidden' name='id_resena' value='{$resena['id_resena']}'>
                                <button type='submit' class='btn btn-sm btn-danger' onclick='return confirm(\"¿Estás seguro de eliminar esta reseña?\")'>
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>";
        }
        ?>
    </div>
<div class="modal fade" id="modalAddResena" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" id="colorModal">
                <h5 class="modal-title" id="modalLabel">Agregar Reseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="./add-resenas.php" method="post">
                <div class="modal-body">
                    <div class="mb-3 d-none">
                        <label for="id_usuario" class="form-label">Usuario</label>
                        <select name="id_usuario" id="id_usuario" class="form-control" required>
                            <?php
                            $usuarios = $conexion->query("SELECT id, CONCAT(name, ' ', last_name) AS full_name FROM users");
                            while ($usuario = $usuarios->fetch_assoc()) {
                                echo "<option value='{$usuario['id']}'>{$usuario['full_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" value="<?php echo $id ?>" name="idVideojuego" >
                       
                    </div>
                    <div class="mb-3">
                        <label for="calificacion" class="form-label">Calificación (1-5)</label>
                        <input type="number" name="calificacion" id="calificacion" class="form-control" min="1" max="5" required>
                    </div>
                    <div class="mb-3">
                        <label for="comentario" class="form-label">Comentario</label>
                        <textarea name="comentario" id="comentario" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-dark">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>