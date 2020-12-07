<?php 

include '../conexion.php';

$token = $con->real_escape_string(htmlentities($_GET['token']));

$sel = $con->query("SELECT id FROM usuarios WHERE token = '$token'");

if($f = $sel->fetch_assoc()){
    $id = $f['id'];
}

$up = $con->query("UPDATE usuarios SET token = NULL WHERE id = '$id'");

if($up){
    echo 'success';
}else{
    echo 'fail';
}

?>