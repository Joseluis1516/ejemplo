<?php
require '../conexion/conexion.php';

$pk_departamentos = $_POST['pk_departamentos'];
$nombre_departamento = $_POST['nombre_departamento'];

$insertar = "UPDATE departamentos SET nombre_departamento='$nombre_departamento',estatus=1 WHERE pk_departamentos=$pk_departamentos";

$guardardepartamentos = mysqli_query($conexion, $insertar);

if ($guardardepartamentos) {
    header('location:../lista_departamentos.php');
}else{
    echo "<script> alert('Incorrecto');</script>";
}

?>