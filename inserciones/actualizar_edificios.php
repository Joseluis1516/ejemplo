<?php
require '../conexion/conexion.php';

$pk_edificios = $_POST['pk_edificios'];
$nom_edificio = $_POST['nom_edificio'];

$insertar = "UPDATE edificios SET nom_edificio='$nom_edificio',estatus=1 WHERE pk_edificios=$pk_edificios";

$guardaredificio = mysqli_query($conexion, $insertar);

if ($guardaredificio ) {
    header('location:../lista_edificio.php');
}else{
    echo "<script> alert('Incorrecto');</script>";
}

?>