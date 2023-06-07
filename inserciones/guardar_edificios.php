<?php
require '../conexion/conexion.php';

$nom_edificio = $_POST['nom_edificio'];


$insertar = "INSERT INTO edificios VALUES(NULL,'$nom_edificio',1)";

$guardaredificio = mysqli_query($conexion, $insertar);

if ($guardaredificio ) {


    echo "<script> alert('Correcto');</script>";
    header('location:../registro_edificios.php');

}else{
    echo "<script> alert('Incorrecto');</script>";

}

?>