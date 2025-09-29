<?php
$host = "db";
$user = "root";
$password = "test";
$bbdd = "banco";

$conexion = mysqli_connect($host, $user, $password, $bbdd);

if (!$conexion) {
    die("Error al conectar con la base de datos");
}
