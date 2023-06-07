<?php
require '../conexion/conexion.php';

$pk_espacios = $_POST['pk_espacios'];
$nom_espacio = $_POST['nom_espacio'];

$insertar = "UPDATE espacios SET nom_espacio='$nom_espacio',estatus=1 WHERE pk_espacios=$pk_espacios";

$guardaredificio = mysqli_query($conexion, $insertar);

if ($guardaredificio ) {
    header('location:../lista_espacios.php');
}else{
    echo "<script> alert('Incorrecto');</script>";
}

?>