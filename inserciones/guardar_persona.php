<?php
require('../conexion/conexion.php');

//tabla 1
$nombres = $_POST['nombres'];
$apaterno = $_POST['apaterno'];
$amaterno = $_POST['amaterno'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$nom_usuario = $_POST['nom_usuario'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT, ['cost' => 12]);
$fk_tipo_usuario = $_POST['fk_tipo_usuario'];

$correo = ("SELECT * FROM usuario WHERE nom_usuario='$nom_usuario'");
$eje = mysqli_query($conexion, $correo);
$row = mysqli_fetch_array($eje);

if (!empty($row)) {
    echo "<script> alert('Ya existe ese correo');</script>";
    header('location:../registro_persona.php?error=correo_duplicado');
    return;
}

if ($nom_usuario) {
    $insertar = "CALL ins_persona ('$nombres','$apaterno','$amaterno','$telefono','$direccion','$nom_usuario', '$contrasena', '$fk_tipo_usuario')";
    $ejecutado = mysqli_query($conexion, $insertar);
}
if ($ejecutado) {
    if ($ejecutado2) {
        echo "<script> alert('Correcto usuario');</script>";
    } else {
        echo "<script> alert('Incorrecto usuario');</script>";
    }
    echo "<script> alert('Correcto');</script>";
    header('location:../principal_admin.php');
} else {
    echo "<script> alert('Incorrecto persona');</script>";
}
