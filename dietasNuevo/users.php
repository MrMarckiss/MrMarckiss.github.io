<?php
session_start();
if (!isset($_SESSION['user_data'])) {
    header("Location: ./login.php");
}
$user_data = $_SESSION['user_data'];

// Cargar la conexión a la base de datos
include "./php/conexion.php";

// Verificar si se solicitó editar un usuario
if (isset($_POST['edit_user_id'])) {
    $user_id = intval($_POST['edit_user_id']);

    $sql = "SELECT id, name AS nombre, last_name AS apellido, age AS edad, email FROM users WHERE id = ?";
    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $userData = $result->fetch_assoc();
    }

    $stmt->close();
}

$sql = "SELECT * FROM users ORDER BY id DESC";
$res = $conexion->query($sql) or die($conexion->error);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

    <style>
        body {
            background-color: #000;
            color: #fff;
        }
        table {
            background-color: ;
            color: #e0e0e0;
        }
        table th, table td {
            border-color: #444;
        }
        table th {
            background-color: #333;
        }
        .btn-dark, .btn-outline-dark {
            background-color: #333;
            color: #fff;
            border: 1px solid #444;
        }
        .btn-dark:hover, .btn-outline-dark:hover {
            background-color: #555;
            color: #fff;
        }
        .btn-outline-warning {
            color: #fff;
            border: 1px solid #444;
        }
        .btn-outline-warning:hover {
            background-color: #555;
        }
        .modal-content {
            background-color: #333;
            color: #fff;
        }
        .modal-header {
            background-color: #444;
        }
        .modal-footer {
            background-color: #444;
        }
    </style>
</head>
<body>

    <div class="d-flex">
        <!-- SIDEBAR -->
        <?php include "./layouts/aside.php"; ?>
        <!-- END SIDEBAR -->

        <main class="flex-grow-1">
            <!-- HEADER -->
            <?php include "./layouts/header.php"; ?>
            <!-- END HEADER -->

            <!-- TITLE SECTION -->
            <div class="mx-4 d-flex justify-content-between">
                <h1 class="h4">Usuarios</h1>
                <div>
                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalAdd">Agregar</button>
                </div>
            </div>
            <!-- END TITLE SECTION -->

            <section class="mt-4 p-4">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">APELLIDOS</th>
                            <th scope="col">EDAD</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">PASSWORD</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php   
                            while($fila = mysqli_fetch_array($res)){
                        ?>
                            <tr>
                                <td><?php echo $fila['id']  ?></td>
                                <td><?php echo $fila['name']  ?></td>
                                <td><?php echo $fila['last_name'] ?></td>
                                <td><?php echo $fila['age'] ?></td>
                                <td><?php echo $fila['email'] ?></td>
                                <td>**********</td>
                                <td class="text-end">
                                    <form action="./php/user_delete.php" method="POST" style="display:inline;">
                                      <input type="hidden" name="user_id" value="<?php echo $fila['id']; ?>">
                                      <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                      <i class="bi bi-trash2"></i>
                                      </button>
                                    </form>

                                    <form action="./php/user_edit.php" method="post" style="display: inline;">
                                     <input type="hidden" name="edit_user_id" value="<?php echo $fila['id']; ?>">
                                     <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpdate">
                                     <i class="bi bi-pencil"></i>
                                     </button>
                                    </form>


                                </td>
                            </tr>
                        <?php }  ?>
                    </tbody>
                </table>
            </section>
            
        </main>

    </div>
  
    <!-- Modal -->
    <div class="modal fade modal-lg" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./php/user_insert.php" method="post" class="needs-validation" novalidate id="form">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="">Nombre:</label>
                                <input name="txtName" id="" required type="text" class="form-control" placeholder="Inserta el nombre">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">Apellido:</label>
                                <input name="txtLast" required type="text" class="form-control" placeholder="Inserta el apellido">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 mb-2">
                                <label for="">Edad</label>
                                <input name="txtAge" required min="18" type="number" class="form-control" placeholder="Inserta la edad" >
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-2">
                                <label for="">Email</label>
                                <input name="txtEmail" required type="email" class="form-control" placeholder="Inserta el email" >
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="">Password</label>
                                <input name="txtPassword" required type="password" class="form-control" placeholder="Inserta la Contraseña" >
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">Confirmar Password</label>
                                <input name="txtPasswordConfirm" required type="password" class="form-control" placeholder="Inserta la Contraseña" >
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark" id="btnSave">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para actualizar usuario -->
    <div class="modal fade modal-lg" id="modalUpdate" tabindex="-1" aria-labelledby="modalUpdateLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalUpdateLabel">Actualizar Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="./php/user_update.php" method="post" class="needs-validation" novalidate>
                    <div class="modal-body">
                        <input type="hidden" id="txtEditId" name="txtEditId">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label for="">Nombre:</label>
                                <input name="txtEditName" id="txtEditName" required type="text" class="form-control">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                            <div class="col-6 mb-2">
                                <label for="">Apellido:</label>
                                <input name="txtEditLast" id="txtEditLast" required type="text" class="form-control">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 mb-2">
                                <label for="">Edad</label>
                                <input name="txtEditAge" id="txtEditAge" required type="number" class="form-control">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-2">
                                <label for="">Email</label>
                                <input name="txtEditEmail" id="txtEditEmail" required type="email" class="form-control">
                                <div class="valid-feedback">Correcto</div>
                                <div class="invalid-feedback">Datos no validos</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark" id="btnUpdate">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
