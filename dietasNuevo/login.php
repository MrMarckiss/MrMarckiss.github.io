<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

</head>
<body class="d-flex justify-content-center">
    <div class="card" style="margin-top: 100px; width: 600px;">
        <div class="card-body">
            <form action="./php/login.php" method="POST"  class="row" >
                <div class="col-12 mb-2 text-center">
                    <label for="">Email</label>
                    <input name="txtEmail" required type="email" class="form-control" placeholder="Inserta el email" >
                </div>
                <div class="col-12 mb-2 text-center">
                    <label for="">Password</label>
                    <input name="txtPassword" required type="password" class="form-control" placeholder="Inserta el email" >
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-dark" id="btnSave">Ingresar</button>
                </div>
        
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php 
        if(isset($_GET['error'])){
    ?>
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Datos no validos",
                    });
                </script>
    <?php  } ?>

   
</body>
</html>