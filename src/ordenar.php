<?php
require("conexion.php");

$order = "dni";

if (isset($_POST[$order])) {
  $order = $_POST[$order];

}


