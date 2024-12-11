<?php 
    $server ="localhost";
    $user="root";
    $pass="";
    $db="videojuegos";
    $conexion = new mysqli($server,$user,$pass,$db);
    if($conexion->connect_error){
        die("No se pudo conectar a MySQL PRENDE EL MYSQL");
    }

?>