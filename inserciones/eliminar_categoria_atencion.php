<?php
require '../conexion/conexion.php';

$pk_categoria_atencion = $_POST['pk']; 
if ($pk_categoria_atencion) {
    $insertar = "UPDATE categorias_atencion SET estatus=0 WHERE pk_categoria_atencion=$pk_categoria_atencion";
    $guardarcategoria_atencion = mysqli_query($conexion, $insertar);
    if ($guardarcategoria_atencion ) {
        echo "true";
    }else{
        echo "false";
    } 
}
?>