<?php
require '../conexion/conexion.php';

$pk_edificios = $_POST['pk_edificios'];

if ($pk_edificios) {
        
    $insertar = "UPDATE edificios SET estatus=0 WHERE pk_edificios=$pk_edificios";
    $guardar = mysqli_query($conexion, $insertar);
    if ($guardar ) {
        echo "true";
    }else{
        echo "false";
    } 
}
?>