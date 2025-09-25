<?php
session_start();
require("conexion.php");

$dni = $_POST["dni"];
$nombre = $_POST["nombre"];
$direccion = $_POST["direccion"];
$telefono = $_POST["telefono"];
$dniAntiguo = $_POST["dniAntiguo"];

// Actualiza un cliente con un determinado DNI
// UPDATE cliente SET dni="12345", nombre="Antonio", direccion="Campanillas" WHERE dni="567"

$consulta = mysqli_query($conexion, "SELECT COUNT(*) AS dni FROM cliente WHERE dni = '$dni'");
$registro = mysqli_fetch_array($consulta);

// Si el dni coincide con el existente o si no existe, se puede modificar
if (($dni == $dniAntiguo) || ($registro["dni"] == "0")) {
  $actualizacion = "UPDATE cliente SET dni='$dni', nombre='$nombre', direccion='$direccion', telefono='$telefono' WHERE dni='$dniAntiguo'";
  mysqli_query($conexion, $actualizacion);

} else if ($registro["dni"] == "1") { // Si existe ese dni (y no es el mismo), error: ya existe otro cliente con ese dni
  $_SESSION["error"] = "Error: Ya existe un cliente con ese DNI";
}

header('Location: index.php');

