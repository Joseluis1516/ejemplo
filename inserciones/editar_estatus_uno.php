<?php 
require '../conexion/conexion.php';

$pk_solicitud = $_POST['pk_solicitud'];
$comentario = $_POST['comentario'];
$usuario = $_POST['usuario'];


$inser = "UPDATE solicitud SET estatus=1 WHERE pk_solicitud=$pk_solicitud";

$guardar = mysqli_query($conexion, $inser);

if ($comentario) {
    $insertar = "INSERT INTO comentarios VALUES (NULL,'$comentario',$pk_solicitud,'$usuario',now())";
    mysqli_query($conexion, $insertar);
}


if ($guardar) {
    echo "true";
} else {
    echo "false";
}




?>