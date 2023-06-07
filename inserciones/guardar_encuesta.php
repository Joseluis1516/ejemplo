<?php
require '../conexion/conexion.php';

$pregunta1 = $_POST['pregunta1'];
$pregunta2 = $_POST['pregunta2'];
$pregunta3 = $_POST['pregunta3'];
$solicitud = $_POST['solicitud'];


$insertar = "INSERT INTO encuesta VALUES(NULL,'$pregunta1','$pregunta2','$pregunta3','$solicitud')";

$guardarencuesta = mysqli_query($conexion, $insertar);

if ($guardarencuesta ) {


    echo "<script> alert('Correcto');</script>";
    header('location:../comun/principal.php');

}else{
    echo "<script> alert('Incorrecto');</script>";

}

?>