<?php 

include '../conexion.php';

$token = $con->real_escape_string(htmlentities($_GET['token']));

$sel = $con->query("SELECT user FROM usuarios WHERE token = '$token'");

if($f = $sel->fetch_assoc()){
    $user = $f['user'];
}

echo json_encode($user);



?>