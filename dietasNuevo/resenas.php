<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseñas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #000; /* Fondo negro */
            color: #fff; /* Texto blanco */
        }
        .card {
            background-color: #222; /* Fondo oscuro para las tarjetas */
            color: #fff;
        }
        .btn-primary {
            background-color: #4a90e2; /* Azul más claro */
            border-color: #4a90e2;
        }
        .btn-danger {
            background-color: #e94e4e; /* Rojo suave */
            border-color: #e94e4e;
        }
        .modal-content {
            background-color: #333; /* Fondo oscuro para el modal */
            color: #fff;
        }
        select, input, textarea {
            background-color: #222; /* Fondo oscuro para formularios */
            color: #fff;
            border: 1px solid #444;
        }
        
    </style>
</head>
<body class="d-flex">
    <!-- SIDEBAR -->
    <?php include "./layouts/aside.php"; ?>
    <!-- END SIDEBAR -->
    <main class="flex-grow-1">
    <!-- HEADER -->
    <?php include "./layouts/header.php"; ?>
    <!-- END HEADER -->
     
<div class="container mt-4">
    <h1 class="h4 mb-4">Reseñas de Videojuegos</h1>
    <button class="btn btn-dark mb-4" data-bs-toggle="modal" data-bs-target="#modalAddResena">Agregar Reseña</button>
    
    <div class="row g-4">
        <?php
        include './php/conexion.php';
        $resenas = $conexion->query("
            SELECT r.*, v.titulo, CONCAT(u.name, ' ', u.last_name) AS nombre_usuario
            FROM resenas r
            JOIN videojuegos v ON r.id_videojuego = v.id_videojuego
            JOIN users u ON r.id_usuario = u.id
        ");

        while ($resena = $resenas->fetch_assoc()) {
            echo "
            <div class='col-md-6 col-lg-4'>
                <div class='card shadow-sm h-100'>
                    <div class='card-body'>
                        <h5 class='card-title text-primary'>{$resena['titulo']}</h5>
                        <h6 class='card-subtitle mb-2 text-white'>Usuario: {$resena['nombre_usuario']}</h6>
                        <p class='card-text'><strong>Calificación:</strong> {$resena['calificacion']}/5</p>
                        <p class='card-text'><strong>Comentario:</strong> {$resena['comentario']}</p>
                        <p class='card-text text-white'><small>Publicado el: {$resena['fecha_publicacion']}</small></p>
                        <div class='d-flex justify-content-between'>
                            <button class='btn btn-sm btn-primary'>Editar</button>
                            <form action='./php/delete-resenas.php' method='POST' style='display:inline;'>
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
</div>
    </main>
<!-- Modal Agregar Reseña -->
<div class="modal fade" id="modalAddResena" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #343a40; color: black;">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel" style="color: black;">Agregar Reseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="./php/add-resenas.php" method="post">
                <div class="modal-body" style="background-color: #444;">
                    <div class="mb-3 d-none">
                        <label for="id_usuario" class="form-label" style="color: black;">Usuario</label>
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
                        <label for="idVideojuego" class="form-label" style="color: black;">Videojuego</label>
                        <select name="idVideojuego" id="idVideojuego" class="form-control" required>
                            <?php
                            $videojuegos = $conexion->query("SELECT * FROM videojuegos");
                            while ($videojuego = $videojuegos->fetch_assoc()) {
                                echo "<option value='{$videojuego['id_videojuego']}'>{$videojuego['titulo']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="calificacion" class="form-label" style="color: black;">Calificación (1-5)</label>
                        <input type="number" name="calificacion" id="calificacion" class="form-control" min="1" max="5" required>
                    </div>
                    <div class="mb-3">
                        <label for="comentario" class="form-label" style="color: black;">Comentario</label>
                        <textarea name="comentario" id="comentario" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer" style="background-color: #343a40;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="color: black;">Cerrar</button>
                    <button type="submit" class="btn btn-dark" style="color: black;">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
