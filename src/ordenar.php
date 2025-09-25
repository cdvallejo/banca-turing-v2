<?php

// por defecto ordena por dni
$order = 'dni';

if (isset($_GET['orderby'])) {
    $order = $_GET['orderby'];
}

return $order;