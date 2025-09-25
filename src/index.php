<?php
session_start();
require("conexion.php");
require("ordenar.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/confirmar-borrado.js"></script>
</head>

<body>

  <div id="principal">

    <div class="card">

      <div id="titulo">
        <h1 class="text-center">Banca Turing</h1>
      </div>

      <img src="./img/banco-turing.jpg" alt="turing-cars">
      <?php
      $accion = $_POST["accion"] ?? "";
      $dni = $_POST["dni"] ?? "";
      $nombre = $_POST["nombre"] ?? "";
      $direccion = $_POST["direccion"] ?? "";
      $telefono = $_POST["telefono"] ?? "";
      $dniAntiguo = $_POST["dniAntiguo"] ?? "";

      if (!empty($_SESSION["error"])) {
        $error = $_SESSION["error"]; // Guardamos el valor
        unset($_SESSION["error"]);
        echo '<script>alert("' . addslashes($error) . '");</script>';
      }


      // Listado de clientes //////////////////////////////////////////////////
      $consulta = mysqli_query($conexion, "SELECT dni, nombre, direccion, telefono FROM cliente ORDER BY $order");
      ?>

      <table class="table table-striped">
        <tr>
          <th><a href="?orderby=dni">DNI ⬆</a></th>
          <th><a href="?orderby=nombre">Nombre ⬆</a></th>
          <th><a href="?orderby=direccion">Dirección ⬆</a></th>
          <th><a href="?orderby=dni">Teléfono ⬆</a></th>
          <th></th>
          <th></th>
        </tr>
        <?php

        while ($registro = mysqli_fetch_array($consulta)) {

          if (($accion == "modificar") && ($dni == $registro["dni"])) {
            // Fila que queremos modificar
        ?>
            <tr class="fila-modificable">
              <form action="modificar.php" method="post">
                <td><input type="text" name="dni" value="<?= $registro["dni"] ?>"></td>
                <td><input type="text" name="nombre" value="<?= $registro["nombre"] ?>"></td>
                <td><input type="text" name="direccion" value="<?= $registro["direccion"] ?>"></td>
                <td><input type="text" name="telefono" value="<?= $registro["telefono"] ?>"></td>
                <td>
                  <input type="hidden" name="dniAntiguo" value="<?= $registro["dni"] ?>">
                  <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-lg"></i>
                    Aceptar
                  </button>
                </td>
              </form>
              <td>
                <form action="#" method="post"> <!-- Cancelar no envía nada por post, de modo que php recarga la página -->
                  <button type="submit" class="btn btn-danger">
                    <i class="bi bi-x-lg"></i>
                    Cancelar
                  </button>
                </form>
              </td>
            </tr>
          <?php
          } else {
            // Fila normal
          ?>
            <tr>
              <td><?= $registro["dni"] ?></td>
              <td><?= $registro["nombre"] ?></td>
              <td><?= $registro["direccion"] ?></td>
              <td><?= $registro["telefono"] ?></td>
              <td>
                <!-- Formulario para borrar: redirige la acción a borrar.php -->
                <form action="borrar.php" method="post">
                  <input type="hidden" name="dni" value="<?= $registro["dni"] ?>">
                  <button  onclick="return confirmarBorrado('<?= $registro['dni'] ?>')"
                    type="submit"
                    class="btn btn-danger"
                    <?= $accion == "modificar" ? "disabled" : "" ?>>
                    <i class="bi bi-trash"></i>
                    Borrar
                  </button>
                </form>
              </td>
              <td>
                <form action="#" method="post">
                  <input type="hidden" name="accion" value="modificar">
                  <input type="hidden" name="dni" value="<?= $registro["dni"] ?>">
                  <button
                    type="submit"
                    class="btn btn-primary"
                    <?= $accion == "modificar" ? "disabled" : "" ?>>
                    <i class="bi bi-pencil"></i>
                    Modificar
                  </button>
                </form>
              </td>
            </tr>
          <?php
          } // Termina if
        } // Termina while

        if ($accion != "modificar") { // Si no estamos modificando un campo se muestra la fila para añadir un cliente (lo normal)
          ?>
          <!-- tr>td*4>input -->
          <tr>
            <form action="agregar.php" method="post">
              <td><input type="text" name="dni" required></td>
              <td><input type="text" name="nombre" required></td>
              <td><input type="text" name="direccion" required></td>
              <td><input type="text" name="telefono" required></td>
              <td>
                <button type="submit" class="btn btn-success">
                  <i class="bi bi-plus"></i>
                  Añadir
                </button>
              </td>
            </form>
          <?php
        }
          ?>
          </tr>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</script>

</html>