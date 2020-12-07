<?php 

include '../conexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){ //comprobamos quue el request method sea por POST
    $usuario = $con->real_escape_string(htmlentities($_POST['usuario']));
    $pass = $con->real_escape_string(htmlentities($_POST['pass']));
    $email = $con->real_escape_string(htmlentities($_POST['email']));

    $extension = '';
    $ruta = 'http://snippetwebpack.test/api/LoginRegistro/foto_perfil'; //configuramos la ruta de la carpeta de las fotos de perfil
    $archivo = $_FILES['foto']['tmp_name']; //obtenemos el fichero con el nombre del input y el temporal name del fichero
    $nombreArchivo = $_FILES['foto']['name']; //el nombre del fichero
    $info = pathinfo($nombreArchivo);
    if ($archivo != '') { //si el usuario elije una foto
        $extension = $info['extension'];
        
        if($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg' 
        || $extension == 'PNG' || $extension == 'JPG' || $extension == 'JPEG'){
            $nombreFile = $usuario.rand(0000,9999).'.'.$extension; //el nuevo nombre de la imagen sera el usuario y un numero aleatorio entre 0 y 9999
            move_uploaded_file($archivo,'foto_perfil/'.$nombreFile); //movemos el fichero $archivo a la nueva carpeta con el nuevo nombre
            $ruta = $ruta.'/'.$nombreFile; //la ruta general que ponemos en la base de datos

        }else{//en caso que use extensión incorrecta
            echo "fail"; //devuelve una respuesta fail
            exit; // sale
        }
    } else { //ruta por defecto en caso de no subir imagen
        $ruta = 'http://snippetwebpack.test/api/LoginRegistro/foto_perfil/perfil.png';
    }

    $passEncryptada = password_hash($pass, PASSWORD_BCRYPT); //encriptamos la contraseña
    $ins = $con->query("INSERT INTO usuarios VALUES (DEFAULT,'$usuario','$email', '$passEncryptada','$ruta',null)");

    if ($ins) {
        echo "success";
    } else {
        echo "fail";
    }
    
    $con->close();

}else{
    header("location:../../index.php"); //en caso de no usar POST lo enviamos al index.php
}



?>