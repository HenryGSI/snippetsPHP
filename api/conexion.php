<?php

header('Access-Control-Allow-Origin: *'); //permite que el origen puede acceder al recurso

$con = new mysqli('localhost','root','','webpack');

if($con->connect_errno){//si hay un error en la conexión que mate el programa
    die("La conexión no pudo establecerse.");
}

?>