<?php
require '../conexion/conexion.php';

$comentario = $_POST['comentario'];
$pk_solicitud = $_POST['pk_solicitud'];
$usuario = $_POST['usuario'];


$insertar = "INSERT INTO comentarios VALUES (NULL,'$comentario',$pk_solicitud,'$usuario',now())";
mysqli_query($conexion, $insertar);

?>