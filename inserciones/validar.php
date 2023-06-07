<?php
require_once '../conexion/conexion.php';

$reUsuario = '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ@.]+$/';
$rePass = '/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]/';

$nom_usuario = $_POST['nom_usuario'];
$contrasena =$_POST['contrasena'];

$consulta = "SELECT * FROM usuario WHERE nom_usuario='$nom_usuario'";

$ejecutar_consulta = mysqli_query($conexion, $consulta);
$num = mysqli_num_rows($ejecutar_consulta);

// $ejecutar = mysqli_num_rows($consulta);

if ( preg_match($reUsuario,$_POST['nom_usuario']) 
&& preg_match($rePass, $_POST['contrasena'])){
  
if($num == 1){ 
    while($datos = mysqli_fetch_assoc($ejecutar_consulta)){
        if(password_verify($contrasena, $datos['contrasena'])){
            
            session_start();
            $_SESSION['pk_usuario']=$datos['pk_usuario'];
            $_SESSION['fk_tipo_usuario']=$datos['fk_tipo_usuario'];
            $_SESSION['nom_usuario']=$_REQUEST['nom_usuario'];
            if ($datos['fk_tipo_usuario'] == 1){
                // echo "admin";
                header('location: ../principal_admin.php');
               } else if ($datos['fk_tipo_usuario'] == 2){

                header('location: ../comun/principal.php');
               }else if ($datos['fk_tipo_usuario'] == 3){
                header('location: ../trabajador/principal_trabajador.php');
               }
        } else {

            echo 'La contraseña o correo esta mal';
            header('location:../inicio_sesion.php?error=contraseña_incorrecta');
        }
    }
    } else {
        echo 'error';
    }
}else{
    echo"Caracteres no validos";
}

?>