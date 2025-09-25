<?php
session_start();
require("conexion.php");

$dni = $_POST["dni"];
$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];

// Añade un nuevo cliente ///////////////////////////////////////////
// INSERT INTO cliente VALUES ("1234", "Pepe", "Calle Patatín", 1234567)
$consulta = mysqli_query($conexion, "SELECT COUNT(*) AS dni FROM cliente WHERE dni='$dni'");
$registro = mysqli_fetch_array($consulta);

if ($registro["dni"] == "1") {
  $_SESSION["error"] = "<b>Error: Ya existe un cliente con ese DNI</b>";
} else {
  $insercion = "INSERT INTO cliente VALUES ('$dni', '$nombre', '$direccion', '$telefono')";
  mysqli_query($conexion, $insercion);
}

header('Location: index.php');
