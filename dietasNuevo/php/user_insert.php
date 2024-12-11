<?php
include "./conexion.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['txtName'];
    $last = $_POST['txtLast'];
    $age = $_POST['txtAge'];
    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];
    $passwordConfirm = $_POST['txtPasswordConfirm'];

    if ($password !== $passwordConfirm) {
        exit;
    }

    $servername = "localhost";
    $username = "root";
    $password_db = "";
    $dbname = "videojuegos";

    $conn = new mysqli($servername, $username, $password_db, $dbname);

    if ($conn->connect_error) {
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, last_name, age, email, password) 
            VALUES ('$name', '$last', '$age', '$email', '$hashedPassword')";

    if ($conn->query($sql) !== TRUE) {
        exit;
    }
    header("Location: ../users.php?error=1");
}
?>
