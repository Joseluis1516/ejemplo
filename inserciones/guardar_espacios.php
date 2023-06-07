<?php
require '../conexion/conexion.php';

$nom_edificio = $_POST['nom_edificio'];
$fk_edificios = $_POST['fk_edificios'];


$insertar = "INSERT INTO espacios VALUES(NULL,'$nom_edificio','$fk_edificios',1)";

$guardarespacios = mysqli_query($conexion, $insertar);

if ($guardarespacios ) {


    echo "<script> alert('Correcto');</script>";
    header('location:../registro_espacios.php');

}else{
    echo "<script> alert('Incorrecto');</script>";

}

?>