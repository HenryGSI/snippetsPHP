<?php 
include '../conexion.php';

$temporal = array();
$resultado = array();

$sel = $con->query("SELECT * FROM snippets ORDER BY id DESC");

while($f = $sel->fetch_assoc()){//fetch_assoc() saca la siguiente fila de la salida de un query
    $temporal = $f;
    array_push($resultado,$temporal); //vamos añadiendo cada fila al array
}

echo json_encode($resultado); //codificamos en json nuestro array con todas la filas del sql

$sel->close();
$con->close();
?>