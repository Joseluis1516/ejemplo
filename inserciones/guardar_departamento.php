<?php
require '../conexion/conexion.php';

$nombre_departamento = $_POST['nombre_departamento'];


$insertar = "INSERT INTO departamentos VALUES(NULL,'$nombre_departamento',1)";

$guardardepa = mysqli_query($conexion, $insertar);

if ($guardardepa ) {


    echo "<script> alert('Correcto');</script>";
    header('location:../registro_departamentos.php');

}else{
    echo "<script> alert('Incorrecto');</script>";

}

?>