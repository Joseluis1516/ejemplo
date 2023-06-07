<?php
require '../conexion/conexion.php';

$pk_espacios = $_GET['pk_espacios'];
$nom_espacio = $_POST['nom_espacio'];
$confirmacion=$_POST['confirmacion'];

if ($confirmacion==1) {
    
$insertar = "UPDATE espacios SET nom_espacio='$nom_espacio',estatus=0 WHERE pk_espacios=$pk_espacios";

$guardarespacios = mysqli_query($conexion, $insertar);

if ($guardarespacios ) {
    header('location:../lista_espacios.php');
}else{
    echo "<script> alert('Incorrecto');</script>";
}
}else{
    header('location:../lista_espacios.php');
}
?>