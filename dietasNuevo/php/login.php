<?php
session_start();
include "./conexion.php";

$email = $_POST['txtEmail'];
$password = $_POST['txtPassword'];

/
$stmt = $conexion->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    $fila = $res->fetch_assoc();
    
    if (password_verify($password, $fila['password'])) {
       
        $_SESSION['user_data'] = [
            'id' => $fila['id'],
            'name' => $fila['name'],
            'last_name' => $fila['last_name'],
            'age' => $fila['age'],
            'email' => $fila['email']
        ];
        header('Location: ../admin.php');
        exit();
    } else {
        
        header("Location: ../login.php?error=1");
        exit();
    }
} else {
  
    header("Location: ../login.php?error=2");
    exit();
}
?>
