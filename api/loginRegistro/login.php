<?php 

include '../conexion.php';

$email = $con->real_escape_string(htmlentities($_POST['email']));
$pass = $con->real_escape_string(htmlentities($_POST['pass']));

$sel = $con->query("SELECT id, user, foto, email, pass FROM usuarios WHERE email = '$email'");

if ($f = $sel->fetch_assoc() ) {
    $correo = $f['email'];
    $password = $f['pass'];
    $user = $f['user'];
    $foto = $f['foto'];
    $id = $f['id'];
}

$passEncriptada = password_verify($pass,$password); //comprueba si coinciden la password encriptada y la que esta por encriptar
if ($email == $correo && $passEncriptada == true) {// $email == $correo lo ponemos para evitar SQL injection, ya que como tendria que poner caracteres especiales en $correo este no coincidiria con el email
    //en lugar de las variable de sesión usaremos un token en la BD mientras el usuario este logeado
    $token = sha1(rand(0000,9999)); //generamos un token con SHA1 sobre un valor aleatorio entre 0 y 9999
    $up = $con->query("UPDATE usuarios SET token = '$token' WHERE id = '$id'"); //actualizamos el token en la base de datos

    if($up){
        $respuesta = array('token' => $token, 'res' => 'success'); 
        echo json_encode($respuesta); //enviamos el token y el res como confirmación
    } 

    
} else {
    $respuesta = array('token' => '', 'res' => 'fail'); 
    echo json_encode($respuesta);
}

$con->close();

?>