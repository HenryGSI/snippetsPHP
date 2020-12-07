<?php 

include '../conexion.php';

$correo = $con->real_escape_string(htmlentities($_POST['correo']));

$sel = $con->query("SELECT email FROM usuarios WHERE email = '$correo'");

$num = mysqli_num_rows($sel);//nos da el numero de filas, que en nuestro caso queremos que sea 0

if ($num == 0) {
    echo 'success';
} else {
    echo 'fail';
}

$con->close();


?>