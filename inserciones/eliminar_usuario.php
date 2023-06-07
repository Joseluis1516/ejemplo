<?php
require '../conexion/conexion.php';

$pk_usuario = $_POST['pk_usuario'];

if ($pk_usuario) {
        
    $insertar = "UPDATE usuario SET estatus=0 WHERE pk_usuario=$pk_usuario";

    $guardarusuario = mysqli_query($conexion, $insertar);

    if ($guardarusuario ) {
        echo "true";
    }else{
        echo "false";
    } 
}
