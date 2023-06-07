<?php
require '../conexion/conexion.php';

$pk_departamentos = $_POST['pk_departamentos'];

if ($pk_departamentos) {
        
    $insertar = "UPDATE departamentos SET estatus=0 WHERE pk_departamentos=$pk_departamentos";
    $guardar = mysqli_query($conexion, $insertar);
    if ($guardar ) {
        echo "true";
    }else{
        echo "false";
    } 
}
?>