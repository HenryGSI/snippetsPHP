<?php 

include '../conexion.php';

foreach ($_POST as $campo => $valor) { //inicializar todas las variable de POST con su valor
    $var = '$'.$campo."='".$valor."';"; //escribimos la inicializacion de la variable
    eval($var); //valida y executa el codigo anterior
}

$up = $con->prepare("UPDATE snippets SET titulo=?, codigo=?, descripcion=?, categoria=? WHERE id = ? ");
$up->bind_param("ssssi",$titulo,$codigo,$descripcion,$categoria,$id);

if ($up->execute()) {
    echo 'success';
} else {
    echo 'fail';
}

$up->close();
$con->close();



?>