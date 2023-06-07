<?php
require '../conexion/conexion.php';

$pk_categoria_atencion = $_POST['pk_categoria_atencion'];
$nom_categoria_atencion = $_POST['nom_categoria_atencion'];

$insertar = "UPDATE categorias_atencion SET nom_categoria_atencion='$nom_categoria_atencion	',estatus=1 WHERE pk_categoria_atencion=$pk_categoria_atencion";

$guardarcategoriaatencion=mysqli_query($conexion, $insertar);

if ($guardarcategoriaatencion) {
    header('location:../lista_categoria_atencion.php');
}else{
    echo "<script> alert('Incorrecto');</script>";
}

?>