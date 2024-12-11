<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
</head>
<style>
  body {
            background-color: #000;
            color: #fff;
        }
  .card-img-top {
    height: 150px;
    object-fit: cover; 
    width: 100%; 

}

</style>
     
<body>
    <div class="d-flex">
        <!-- SIDEBAR -->
        <?php include "./layouts/aside.php"; ?>
        <!--END  SIDEBAR -->
        <main class="flex-grow-1">
            <!-- HEADER -->
            <?php include "./layouts/header.php"; ?>
            <!-- END HEADER -->
            <!-- TITLE SECTION -->
            <div class="mx-4 d-flex justify-content-between">
                <h1 class="h4">Videojuegos</h1>
                <div>
                    <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalAdd">Agregar</button>
                </div>
            </div>
            <!-- END TITLE SECTION -->
            <section class="p-4 container">
                <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
                    <?php
                    include './php/conexion.php';
                    $videojuegos = $conexion->query("SELECT v.*, g.nombre_genero FROM videojuegos v JOIN generos g ON v.genero = g.id_genero");
                    while ($videojuego = $videojuegos->fetch_assoc()) {
                        echo "
                        <div class='col'>
                            <div class='card bg-secondary text-white'>
                                <img src='./img/{$videojuego['img_videojuego']}' style='height: 150px; object-fit: cover; width: 100%;' class='card-img-top' alt='{$videojuego['titulo']}'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$videojuego['titulo']}</h5>
                                    <p class='card-text'>Género: {$videojuego['nombre_genero']}</p>
                                    <p class='card-text'>Desarrollador: {$videojuego['desarrollador']}</p>
                                    <a href='./php/detalles.php?id={$videojuego['id_videojuego']}' class='btn btn-light w-100'>Ver más</a>

                                </div>
                            </div>
                        </div>
                        ";
                    }
                    
                    ?>
                </div>
            </section>
        </main>
    </div>

    <!-- Modal Videojuego -->
    <div class="modal fade modal-lg" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Videojuego</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./php/add-product.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate id="form">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="txtTitulo">Título:</label>
                                <input name="txtTitulo" id="txtTitulo" required type="text" class="form-control" placeholder="Título del videojuego">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Dato no válido</div>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="txtDesarrollador">Desarrollador:</label>
                                <input name="txtDesarrollador" id="txtDesarrollador" required type="text" class="form-control" placeholder="Nombre del desarrollador">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Dato no válido</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="txtFechaLanzamiento">Fecha de lanzamiento:</label>
                                <input name="txtFechaLanzamiento" id="txtFechaLanzamiento" required type="date" class="form-control">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Dato no válido</div>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="txtGenero">Género:</label>
                                <select name="txtGenero" id="txtGenero" class="form-control" required>
                                    <?php 
                                    include './conexion.php';
                                    $generos = $conexion->query("SELECT * FROM generos");
                                    while ($genero = $generos->fetch_assoc()) {
                                        echo "<option value='{$genero['id_genero']}'>{$genero['nombre_genero']}</option>";
                                    }
                                    ?>
                                </select>
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Dato no válido</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-2">
                                <label for="txtFile">Imagen:</label>
                                <input name="txtFile" id="txtFile" required type="file" class="form-control">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Dato no válido</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-dark" id="btnSave">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script  src="./js/users.js"></script>
</body>
</html>