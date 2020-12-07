<?php 

include '../conexion.php';

$id = $con->real_escape_string(htmlentities($_GET['id'])); //obtenemos por get el id ya que esta en la url
$temporal = array();
$resultado = array();

$sel = $con->query("SELECT * FROM snippets WHERE id = '$id'");


if($f = $sel->fetch_assoc()){//fetch_assoc() saca la siguiente fila de la salida de un query, en este caso sera solo 1 fila
    $temporal = $f;
    array_push($resultado,$temporal); //vamos añadiendo cada fila al array
}

echo json_encode($resultado[0]); //codificamos en json nuestro post con todos sus campos

$sel->close();
$con->close();




?>