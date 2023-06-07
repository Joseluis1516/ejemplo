<?php
session_start();
require '../conexion/conexion.php';

$pk_solicitud = $_POST['pk_solicitud'];
$comentario = $_POST['comentario'];
$anonima = $_POST['anonima'];
$status = 2;
if ($anonima) {
    $status = 0;
}

$inser = "UPDATE solicitud SET estatus=$status, f_solucion=NOW() 
WHERE pk_solicitud=$pk_solicitud";

$guardar = mysqli_query($conexion, $inser);
if ($comentario) {
    $usuario3 = $_SESSION['pk_usuario'];
    $insertar = "INSERT INTO comentarios VALUES (NULL,'$comentario',$pk_solicitud,'$usuario3',now())";
    mysqli_query($conexion, $insertar);
}

if ($guardar) {
    echo "true";
} else {
    echo "false";
}
