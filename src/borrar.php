<?php
require("conexion.php");

$dni = $_POST["dni"];

// Borra un cliente con un determinado DNI
// DELETE FROM cliente WHERE dni="12345"

$borrado = "DELETE FROM cliente WHERE dni='$dni'";
mysqli_query($conexion, $borrado);

header('Location: index.php');
