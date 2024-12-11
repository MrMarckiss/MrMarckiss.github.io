<?php 
session_start();
if(!isset($_SESSION['user_data'])){
    header("Location: ./login.php");
}
$user_data = $_SESSION['user_data'];
include './php/conexion.php';

// Realizando una consulta a la base de datos para obtener estadísticas
$total_videojuegos = 0;
$generos_mas_reseñados = [];

// Obtener el total de videojuegos
$result = $conexion->query("SELECT COUNT(*) as total FROM videojuegos");
if ($result) {
    $row = $result->fetch_assoc();
    $total_videojuegos = $row['total'];
} else {
    echo "Error al obtener el total de videojuegos.";
}

// Obtener el total de usuarios registrados
$result_users = $conexion->query("SELECT COUNT(*) as total_users FROM users");
$total_users = 0;
if ($result_users) {
    $row_users = $result_users->fetch_assoc();
    $total_users = $row_users['total_users'];
}

// Obtener los géneros con más reseñas
$result_generos = $conexion->query("SELECT g.nombre_genero, COUNT(r.id_resena) as cantidad_reseñas
FROM generos g
LEFT JOIN videojuegos v ON v.genero = g.id_genero
LEFT JOIN resenas r ON r.id_videojuego = v.id_videojuego
GROUP BY g.id_genero
ORDER BY cantidad_reseñas DESC
LIMIT 5");

if ($result_generos) {
    while ($row = $result_generos->fetch_assoc()) {
        $generos_mas_reseñados[] = $row;
    }
} else {
    echo "Error al obtener los géneros con más reseñas.";
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
       
        body {
            background-color: #000;
            color: #fff;
        }

        .card {
            background-color: #1e1e1e;
            border: 1px solid #333;
        }

        .card-body {
            color: #e0e0e0;
        }

        .card label {
            color: #a5a5a5;
        }

        .card i {
            color: #0052e0;
        }

        .container {
            background-color: #000;
            color: #fff;
        }

        h1, h4 {
            color: #e0e0e0;
        }
    </style>
</head>
<body class="d-flex">
    <!-- SIDEBAR -->
    <?php include "./layouts/aside.php"; ?>
    <!-- END SIDEBAR -->
    
    <!-- MAIN CONTENT -->
    <main class="flex-grow-1">
        <?php include "./layouts/header.php"; ?>
        <section class="container mt-4 p-4">
            <!-- Título centralizado -->
            <h1 class="d-flex justify-content-center" style="height: 6vh;">Bienvenido de nuevo</h1>

            <!-- STATS -->
            <div class="row">
                <!-- Total de videojuegos -->
                <div class="col-6 mb-4">
                    <div class="card" style="height: 100px;">
                        <div class="card-body">
                            <label class="d-block">
                                <i class="bi bi-controller"></i>
                                TOTAL VIDEOJUEGOS
                            </label>
                            <h5 class="h2 text-center"><?php echo $total_videojuegos; ?></h5>
                        </div>
                    </div>
                </div>

                <!-- Usuarios registrados -->
                <div class="col-6 mb-4">
                    <div class="card" style="height: 100px;">
                        <div class="card-body">
                            <label class="d-block">
                                <i class="bi bi-person-check"></i>
                                USUARIOS REGISTRADOS
                            </label>
                            <h5 class="h2 text-center"><?php echo $total_users; ?></h5>
                        </div>
                    </div>
                </div>
            </div>

        
            <div class="col-12 mb-4">
                <h4 class="text-center">Reseñas</h4>
            </div>

            <div class="container px-4 text-center">
                <div class="row gx-5">
                    <?php foreach ($generos_mas_reseñados as $genero): ?>
                    <div class="col">
                        <div class="card" style="height: 100px;">
                            <div class="card-body">
                                <label class="d-block">
                                    <i class="bi bi-tags"></i>
                                    <?php echo $genero['nombre_genero']; ?>
                                </label>
                                <h5 class="h2 text-center"><?php echo $genero['cantidad_reseñas']; ?> Reseñas</h5>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</body>
</html>
