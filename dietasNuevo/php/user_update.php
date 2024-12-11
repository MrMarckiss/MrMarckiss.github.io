<?php
session_start();
include './conexion.php';

if (isset($_POST['user_id'], $_POST['txtName'], $_POST['txtLast'], $_POST['txtAge'], $_POST['txtEmail'])) {
    $user_id = intval($_POST['user_id']);
    $name = trim($_POST['txtName']);
    $last = trim($_POST['txtLast']);
    $age = intval($_POST['txtAge']);
    $email = trim($_POST['txtEmail']);

  
    $sql = "UPDATE users SET name = '$name', last_name = '$last', age = $age, email = '$email' WHERE id = $user_id"; 
    echo $user_id;
    echo $name;
    echo $last;
    echo $age;
    echo $email;
    $stmt = $conexion->query($sql);

header("Location: ../users.php");
}
?>
