// Confirma el borrado antes de mandar la info a borrar.php

function confirmarBorrado(dni) {
  return confirm("¿Seguro que quieres borrar el cliente con DNI " + dni + "?");
}