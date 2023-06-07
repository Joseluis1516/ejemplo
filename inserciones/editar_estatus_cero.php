<?php 
session_start();
require '../conexion/conexion.php';

$pk_solicitud = $_POST['pk_solicitud'];

$inser = "UPDATE solicitud SET estatus=0, f_solucion=NOW() WHERE pk_solicitud=$pk_solicitud";

$guardar = mysqli_query($conexion, $inser);

if ($guardar) {
    echo "true";
} else {
    echo "false";
}




?>