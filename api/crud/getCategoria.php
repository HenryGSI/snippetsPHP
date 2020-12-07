<?php 
include '../conexion.php';

$categoria = $con->real_escape_string(htmlentities($_GET['cat']));
$temporal = array();
$resultado = array();

$sel = $con->query("SELECT * FROM snippets WHERE categoria = '$categoria'");

while($f = $sel->fetch_assoc()){//fetch_assoc() saca la siguiente fila de la salida de un query
    $temporal = $f;
    array_push($resultado,$temporal); //vamos añadiendo cada fila al array
}

echo json_encode($resultado); //codificamos en json nuestro array con todas la filas del sql

$sel->close();
$con->close();

?>