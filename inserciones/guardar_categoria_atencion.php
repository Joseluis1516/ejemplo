<?php
require '../conexion/conexion.php';


$nom_categoria_atencion = $_POST['nom_categoria_atencion'];


$insertar = "INSERT INTO categorias_atencion VALUES(NULL,'$nom_categoria_atencion',1)";

$guardarcat_a = mysqli_query($conexion, $insertar);

if ($guardarcat_a ) {


    echo "<script> alert('Correcto');</script>";
    header('location:../registro_categoria_atencion.php');

}else{
    echo "<script> alert('Incorrecto');</script>";

}

?>